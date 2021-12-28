<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <el-button type="primary" @click="dialogVisible = true"><i class="el-icon-plus"></i>
                        <span>Add</span></el-button>
                    <div class="table-responsive">
                        <el-tabs v-model="activeName" @tab-click="handleClick">
                            <el-tab-pane label="Done" name="first">Done</el-tab-pane>
                            <el-tab-pane label="Incomplete" name="second">Incomplete</el-tab-pane>
                        </el-tabs>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog title="Tips" :visible.sync="dialogVisible" width="70%">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Title</label>
                        <el-input v-model="form.title"></el-input>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <el-input v-model="form.desc"></el-input>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Due date</label>
                        <br>
                        <el-date-picker v-model="form.due_date" type="datetime" placeholder="Select date and time">
                        </el-date-picker>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Spent time</label>
                        <br>
                        <el-time-picker v-model="form.spent_time" placeholder="Arbitrary time">
                        </el-time-picker>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Status</label>
                        <br>
                        <el-select v-model="form.status" placeholder="Select">
                            <el-option v-for="item in status_types" :key="item.value" :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Priority</label>
                        <br>
                        <el-select v-model="form.priority" placeholder="Select">
                            <el-option v-for="item in priorities" :key="item.value" :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="">Check list</label>
                    <br>
                    <div class="form-group" v-for="(item, index) in sub_tasks" :key="index">
                        <div class="d-flex flex-row align-items-center">
                            <input type="checkbox" name="" id="" style="margin-right: 10px">
                            <el-input placeholder="Please input" v-model="item.value"></el-input>
                            <a href="javascript:void(0)" class="text-danger" @click="removeChecklistItem(index)">
                                <i class="el-icon-close" style="margin-left: 10px"></i>
                            </a>
                        </div>
                    </div>
                    <el-button size="small" @click="addTaskToChecklist"><i class="el-icon-plus"></i> Add</el-button>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">Cancel</el-button>
                <el-button type="primary" @click="dialogVisible = false">Confirm</el-button>
            </span>
        </el-dialog>
    </div>
</template>
<script>
export default {
    data() {
        return {
            activeName: 'first',
            dialogVisible: false,
            sub_tasks: [],
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

        }
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
    },
}

</script>
