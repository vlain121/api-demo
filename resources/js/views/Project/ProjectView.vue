<template>
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <el-button type="primary" @click="addProject">
                        <i class="el-icon-plus"></i>
                        <span>Add</span>
                    </el-button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4"
                    v-for="(project, index) in projects"
                    :key="`project_${index}`">
                    <div class="white-box">
                        <a class="h3" href="javascript:void(0)" @click="viewProjectDetail(project.slug)">
                            {{ project.name }}
                        </a>
                        <p>{{ project.description }}</p>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import {mapActions} from 'vuex'
import ProjectApi from '../../api/project'
export default {
    data() {
        return {
            projects: [],
        }
    },
    mounted() {
        this.setShowBack(false)
        this.getProjects()
    },
    methods: {
        ...mapActions(['setShowBack', 'setLoading']),
        getProjects(params) {
            this.setLoading(true)
            ProjectApi.getAll(params, (data) => {
                this.projects = data.data
                this.setLoading(false)
            }, (error) => {
                console.log(error)
                this.setLoading(false)
            })
        },
        viewProjectDetail(slug) {
            this.$router.push({
                name: 'project_detail',
                params: {
                    slug,
                },
            })
        },
        addProject() {
            this.$router.push({
                name: 'project_create',
            })
        },
    },
}

</script>
