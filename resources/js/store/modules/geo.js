export default {
    namespaced: true,

    state: {
        cities: '',
        city: '',
    },

    actions: {
        async searchName (store, name) {
            await axios.get('/api/geo?q=' + name).then(r => r.data)
                .then(response => {
                    console.log(response);
                    
                    store.commit('setCities', response)
                })
        },
        async searchIds (store, locations) {
            await axios.get('/api/geo?ids=[' + locations + ']').then(r => r.data)
                .then(response => {
                    store.commit('setCity', response)                    
                })
        },
    },

    mutations: {
        setCities (state, payload) {
            state.cities = payload
        },
        setCity (state, payload) {
            state.city = payload
        },
        clearCities (state, payload) {
            state.cities = {}
        }
    },

    getters: {
        cities (state) {
            return state.cities
        },
        city (state) {
            return state.city
        },
        show (state) {
            return false
        }
    }
}