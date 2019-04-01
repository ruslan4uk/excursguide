import Vue from 'vue'
import Vuex from 'vuex'

// profile store
import profile from './modules/profile'
// geolocation
import geo from './modules/geo'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'


export const store = new Vuex.Store({
    modules: {
        profile,
        geo,
    },

    getters: {},

    mutations: {},

    strict: debug,
})