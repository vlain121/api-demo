<template>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <el-button type="primary" @click="addNewTask">
                        <i class="el-icon-plus"></i>
                        <span>Add</span>
                    </el-button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box" v-loading="loading">

                    <div class="table-responsive">
                        <el-table style="width: 100%"
                            :data="tasks"
                            :row-class-name="tableRowClassName"
                            :lazy="true"
                        >
                            <el-table-column prop="id" label="ID" width="50px">
                                <template slot-scope="scope">
                                    <a href="javascript:void(0)"
                                        @click="viewTaskDetail(scope.row.id)">#{{ scope.row.id }}
                                    </a>
                                </template>
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
    </div>
</template>
<script>
import {mapActions} from 'vuex'
import TaskApi from '../../api/task'
export default {
    data() {
        return {
            loading: false,
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
                    type: 'string',
                    required: false,
                    message: 'Please pick a date',
                    trigger: 'change',
                }],
                spent_time: [{
                    type: 'string',
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
        this.setShowBack(false)
    },
    methods: {
        ...mapActions(['setShowBack']),
        handleClick(tab, event) {
            console.log(tab, event)
        },
        addTaskToChecklist() {
            this.sub_tasks.push({
                id: null,
                status: false,
                title: null,
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
                        // this.dialogVisible = false
                        this.resetFormFields()
                        this.$notify({
                            title: 'Success',
                            message: 'Your changes have been saved',
                            position: 'bottom-right',
                            type: 'success',
                        })
                    }, (error) => {
                        this.$notify({
                            title: 'Success',
                            message: 'Your changes have been saved',
                            position: 'bottom-right',
                            type: 'error',

                        })
                        console.error(error)
                    })
                } else {
                    return false
                }
            })
        },
        resetFormFields() {
            if (this.$refs['task_form']) {
                this.$refs['task_form'].resetFields()
            }
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
        // selecRow(row, column, event) {
        //     this.form = row
        //     this.dialogVisible = true
        // },
        addNewTask() {
            this.$router.push({
                name: 'task_create',
            })
        },
        viewTaskDetail(id) {
            this.dialogVisible = true
            TaskApi.getDetail(id, (data) => {
                this.form = data.data
                this.sub_tasks = data.data.sub_tasks
            }, (error) => {
                console.error(error)
            })
        },
    },
}

</script>
<style>
    label {
        margin-bottom: 0rem;
    }

</style>
