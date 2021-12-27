import Router from 'vue-router'

import DashboardView from './views/DashboardView'
import TaskView from './views/TaskView'
import LoginView from './views/LoginView'

export default new Router({
    routes: [
        {
            name: 'dashboard',
            path: '/',
            component: DashboardView
        },
        {
            name: 'tasks',
            path: '/tasks',
            component: TaskView
        },
        {
            name: 'login',
            path: '/login',
            component: LoginView
        }

    ]
})