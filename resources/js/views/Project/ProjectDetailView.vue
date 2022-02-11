<template>

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="d-flex flex-row justify-content-between">
                    <el-button @click="goBack">
                        <i class="el-icon-back"></i> Back
                    </el-button>
                    <el-button type="primary" @click="saveProject">
                        <!-- <i class="el-icon-plus"></i> -->
                        <span>Save</span>
                    </el-button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="white-box">
                    <el-form :model="form" :rules="form_rules" ref="task_form">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <el-form-item label="Name" prop="name">
                                    <el-input v-model="form.name"></el-input>
                                </el-form-item>
                            </div>

                            <div class="col-12 mb-2">
                                <el-form-item label="Description" prop="description ">
                                    <el-input type="textarea" :rows="2" v-model="form.description">
                                    </el-input>
                                </el-form-item>
                            </div>

                        </div>
                    </el-form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="white-box">
                    <el-tabs v-model="activeName" @tab-click="handleClick">
                        <el-tab-pane label="User" name="first">User</el-tab-pane>
                        <el-tab-pane label="Config" name="second">Config</el-tab-pane>
                        <el-tab-pane label="Role" name="third">Role</el-tab-pane>
                        <el-tab-pane label="Task" name="fourth">Task</el-tab-pane>
                    </el-tabs>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions, mapState} from 'vuex'
import ProjectApi from '../../api/project'
export default {
    data() {
        return {
            activeName: 'first',
            form: {
                id: null,
                name: null,
                description: null,
            },
            form_rules: {
                name: [{
                    required: true,
                    message: 'Name is required',
                }],
                description: [{
                    required: true,
                    message: 'Description is required',
                }],
            },
        }
    },
    computed: {
        ...mapState({
            current_route_name: (state) => state.current_route_name,
        }),
    },
    mounted() {
        switch (this.current_route_name) {
        case 'project_create':

            break
        case 'project_detail':
            const slug = this.$route.params.slug
            console.log(slug)
            break

        default:
            break
        }

        this.setShowBack(true)
    },
    methods: {
        ...mapActions(['setShowBack', 'setCurrentRouteName']),
        getProject(slug) {

        },
        handleClick(tab, event) {
            console.log(tab, event)
        },
        saveProject() {
            ProjectApi.create(this.form, (data) => {
                console.log(data)
            }, (error) => {
                console.log(error)
            })
        },
        goBack() {
            window.Bus.$emit('go-back')
        },
    },
}

</script>
