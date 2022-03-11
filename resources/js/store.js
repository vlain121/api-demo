import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        breadcrumb: null,
        auth_user: null,
        show_back: false,
        current_route_name: null,
        loading: false,
    },
    mutations: {
        setLoading(state, data) {
            state.loading = data
        },
        setShowBack(state, data) {
            state.show_back = data
        },
        setBreadcrumb(state, data) {
            state.breadcrumb = data
        },
        setCurrentRouteName(state, data) {
            state.current_route_name = data
        },
    },
    actions: {
        setLoading({commit}, data) {
            commit('setLoading', data)
        },
        setBreadcrumb({commit}, data) {
            commit('setBreadcrumb', data)
        },
        setShowBack({commit}, data) {
            commit('setShowBack', data)
        },
        setCurrentRouteName({commit}, data) {
            commit('setCurrentRouteName', data)
        },
    },
})
