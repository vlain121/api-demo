import Router from 'vue-router'

import DashboardView from './views/Dashboard/DashboardView'
import TaskView from './views/Task/TaskView'
import TaskDetailView from './views/Task/TaskDetailView'
import UserView from './views/User/UserView'
import ProjectView from './views/Project/ProjectView'
import ProjectDetailView from './views/Project/ProjectDetailView'
import LoginView from './views/Auth/LoginView'

export default new Router({
    mode: 'history',
    routes: [
        {
            name: 'dashboard',
            path: '/',
            component: DashboardView,
        },
        {
            name: 'projects',
            path: '/projects',
            component: ProjectView,
        },
        {
            name: 'project_detail',
            path: '/projects/:slug',
            component: ProjectDetailView,
        },
        {
            name: 'project_create',
            path: '/projects/create',
            component: ProjectDetailView,
        },
        {
            name: 'users',
            path: '/users',
            component: UserView,
        },
        {
            name: 'tasks',
            path: '/tasks',
            component: TaskView,
        },
        {
            name: 'task_create',
            path: '/tasks/create',
            component: TaskDetailView,
        },
        {
            name: 'login',
            path: '/login',
            component: LoginView,
        },

    ],
})
