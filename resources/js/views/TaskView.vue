<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <el-button type="primary" @click="addNewTask"><i class="el-icon-plus"></i>
                        <span>Add</span></el-button>
                    <div class="table-responsive">
                        <el-table style="width: 100%" :data="tasks" :row-class-name="tableRowClassName"
                        @row-click="selecRow"
                                    :lazy="true">
                                    <el-table-column prop="id" label="ID" width="50px">
                                    </el-table-column>
                                    <el-table-column prop="title" label="Title">
                                    </el-table-column>
                                    <el-table-column prop="desc" label="Description">
                                        <template slot-scope="scope">
                                            {{ scope.row.desc ? scope.row.desc.substring(0, 20) + '...' : '' }}
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="status_label" label="Status"
                                    :filters="[
                                        { text: 'New', value: 0 },
                                        { text: 'Pending', value: 1 },
                                        { text: 'Canceled', value: 2 },
                                        { text: 'Done', value: 3 },
                                    ]"
                                    :filter-method="filterStatus"
                                    filter-placement="bottom-end">
                                    </el-table-column>
                                    <el-table-column prop="priority_label" label="Priority"
                                    :filters="[
                                        { text: 'Low', value: 0 },
                                        { text: 'Medium', value: 1 },
                                        { text: 'High', value: 2 },
                                        { text: 'Urgent', value: 3 },
                                    ]"
                                    :filter-method="filterPriority"
                                    filter-placement="bottom-end">
                                    </el-table-column>
                                </el-table>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog title="Tips" :visible.sync="dialogVisible" :fullscreen="true" :before-close="beforeCloseModal">
            <el-form :model="form" :rules="form_rules" ref="task_form">
                <div class="row">
                    <div class="col-12 mb-2">
                        <el-form-item label="Title" prop="title">
                            <el-input v-model="form.title"></el-input>
                        </el-form-item>
                    </div>

                    <div class="col-12 mb-2">
                        <el-form-item label="Description" prop="desc">
                            <el-input type="textarea" :rows="2" v-model="form.desc">
                            </el-input>
                        </el-form-item>
                    </div>

                    <div class="col-12 mb-2 col-md-6">
                        <el-form-item label="Due date" prop="due_date">
                            <el-date-picker v-model="form.due_date" format="yyyy-MM-dd HH:mm:ss" type="datetime">
                            </el-date-picker>
                        </el-form-item>
                    </div>
                    <div class="col-12 mb-2 col-md-6">
                        <el-form-item label="Spent time" prop="spent_time">
                            <el-time-picker v-model="form.spent_time">
                            </el-time-picker>
                        </el-form-item>
                    </div>
                    <div class="col-12 mb-2 col-md-6">
                        <el-form-item label="Status" prop="status">
                            <el-select v-model="form.status">
                                <el-option v-for="item in status_types" :key="item.value" :label="item.label"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div class="col-12 mb-2 col-md-6">
                        <el-form-item label="Priority" prop="priority">
                            <el-select v-model="form.priority">
                                <el-option v-for="item in priorities" :key="item.value" :label="item.label"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="">Check list</label>
                        <br>
                        <div class="form-group" v-for="(item, index) in sub_tasks" :key="index">
                            <div class="d-flex flex-row align-items-center">
                                <input type="checkbox" name="" id="" style="margin-right: 10px">
                                <el-input v-model="item.value"></el-input>
                                <a href="javascript:void(0)" class="text-danger" @click="removeChecklistItem(index)">
                                    <i class="el-icon-close" style="margin-left: 10px"></i>
                                </a>
                            </div>
                        </div>
                        <el-button size="small" @click="addTaskToChecklist"><i class="el-icon-plus"></i> Add</el-button>
                    </div>
                </div>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="submit">Confirm</el-button>
            </span>
        </el-dialog>
    </div>
</template>
<script>
import TaskApi from '../api/task'
export default {
    data() {
        return {
            activeName: 'all',
            dialogVisible: false,
            sub_tasks: [],
            tasks: [],
            priorities: [{
                label: 'Low',
                value: 0,
            },
            {
                label: 'Medium',
                value: 1,
            },
            {
                label: 'High',
                value: 2,
            },
            {
                label: 'Urgent',
                value: 3,
            },

            ],
            status_types: [{
                label: 'New',
                value: 0,
            },
            {
                label: 'Pending',
                value: 1,
            },
            {
                label: 'Canceled',
                value: 2,
            },
            {
                label: 'Done',
                value: 3,
            },
            ],
            form: {
                title: null,
                desc: null,
                due_date: null,
                spent_time: null,
                status: null,
            },
            form_rules: {
                title: [{
                    required: true,
                    message: 'Title is required',
                }],
                desc: [{
                    required: true,
                    message: 'Description is required',
                }],
                due_date: [{
                    type: 'date',
                    required: false,
                    message: 'Please pick a date',
                    trigger: 'change',
                }],
                spent_time: [{
                    type: 'date',
                    required: false,
                    message: 'Please pick time',
                    trigger: 'change',
                }],
                status: [{
                    required: true,
                    message: 'Status is required',
                }],
                priority: [{
                    required: true,
                    message: 'Priority is required',
                }],
            },

        }
    },
    mounted() {
        this.getAllTasks()
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event)
        },
        addTaskToChecklist() {
            this.sub_tasks.push({
                status: false,
                value: null,
            })
        },
        removeChecklistItem(index) {
            this.sub_tasks.splice(index, 1)
        },
        getAllTasks() {
            TaskApi.getAll({}, (data) => {
                this.tasks = data.data
            }, (error) => {
                console.log(error)
            })
        },
        submit() {
            this.$refs['task_form'].validate((valid) => {
                if (valid) {
                    this.form = {
                        ...this.form,
                        sub_tasks: this.sub_tasks.filter((e) => e.value != '' && e.value != null),
                    }
                    TaskApi.create(this.form, (data) => {
                        this.dialogVisible = false
                        console.log(data)
                    }, (error) => {
                        console.error(error)
                    })
                } else {
                    return false
                }
            })
        },
        resetFormFields() {
            this.$refs['task_form'].resetFields()
        },
        resetForm() {
            this.form = {
                title: null,
                desc: null,
                due_date: null,
                spent_time: null,
                status: null,
            }
            this.sub_tasks = []
        },
        beforeCloseModal() {
            this.resetFormFields()
            // this.resetForm()
            this.dialogVisible = false
        },
        tableRowClassName({row, rowIndex}) {
            if (row.priority == 3) {
                return 'danger-row'
            } else if (row.priority == 2) {
                return 'warning-row'
            }
            return
        },
        filterPriority(value, row) {
            return row.priority === value
        },
        filterHandler(value, row, column) {
            const property = column['property']
            return row[property] === value
        },
        filterStatus(value, row) {
            return row.status === value
        },
        selecRow(row, column, event) {
            this.form = row
            this.dialogVisible = true
        },
        addNewTask() {
            this.dialogVisible = true
            this.resetForm()
            this.resetFormFields()
        },
    },
}

</script>
<style>
    label {
        margin-bottom: 0rem;
    }

</style>
