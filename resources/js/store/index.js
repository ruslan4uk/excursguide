import Vue from 'vue'
import Vuex from 'vuex'

// Config
import config from './modules/config'
// geolocation
import geo from './modules/geo'
// profile store
import profile from './modules/profile'
// tour state
import tour from './modules/tour'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'


export const store = new Vuex.Store({
    modules: {
        config,
        geo,
        profile,
        tour,
    },

    getters: {},

    mutations: {},

    strict: debug,
})