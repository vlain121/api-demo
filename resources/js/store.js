import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        breadcrumb: null,
        auth_user: null,

    },
    mutations: {
        setBreadcrumb(state, data) {
            state.breadcrumb = data
        },
    },
    actions: {
        setBreadcrumb({commit}, data) {
            commit('setBreadcrumb', data)
        },
    },
})
