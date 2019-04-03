import Axios from "axios";

export default {
    namespaced: true,

    state: {
        tour: {},

        errors: {},
        success: {},
    },

    actions: {
        async getTour(store, id) {
            await axios.get('/api/profile/tours/' + id).then(r => r.data)
                .then(response => {
                    store.commit('setTour', response)
                })
        },
        saveTour(store, id) {            
            axios.post('/api/profile/tours/' + id, store.state.tour)
                .then(response => {
                    store.commit('deleteErrors')
                    store.commit('setSuccess', response.data)
                    console.log('success' ,response.data);
                    
                })
                .catch(errors => {
                    store.commit('setErrors', errors.response.data.errors)
                    store.commit('deleteSuccess')
                    console.log('error', errors.response.data.errors);
                    //if(errors.response.data.errors.message === 'Unauthenticated') window.location.reload(true); 
                })
        },
    },

    mutations: {
        setTour (state, payload) {
            state.tour = payload
        },

        setName (state,payload) {
            state.tour.name = payload
        },

        setAvatar (state, payload) {
            state.tour.avatar = payload
        },

        setLocation (state, payload) {
            state.tour.location = payload
        },
        deleteLocation (state, payload) {
            state.tour.location = null
        },

        setRoute (state, payload) {
            state.tour.route = payload
        },

        // Language
        addLang (state, payload) {
            state.tour.languages == null 
                    ? state.tour.languages = [] 
                    : state.tour.languages
            state.tour.languages.push(payload);
        },
        deleteLang (state, payload) {
            state.tour.languages.splice(state.tour.languages.indexOf(payload), 1);
        },

        setServices (state, payload) {
            state.tour.services = payload
        },

        setOtherRate (state, payload) {
            state.tour.other_rate = payload
        },

        setOtherItem (state, payload) {
            state.tour.other_item = payload
        },

        setCategory (state, payload) {
            state.tour.category = payload            
        },
        
        setPeopleCategory (state, payload) {
            state.tour.people_category = payload
        },

        setPeopleCount (state, payload) {
            state.tour.people_count = payload
        },
        setTiming (state, payload) {
            state.tour.timing = payload
        },

        // Price
        setPrice (state, payload) {
            state.tour.price = payload
        },
        setCurrency (state, payload) {
            state.tour.currency = payload
        },
        setPriceType (state, payload) {
            state.tour.price_type = payload
        },

        // About
        setAbout (state, payload) {
            state.tour.about = payload
        },

        // Photo
        setPhoto (state, payload) {
            state.tour.photo = payload
        },

        // Success
        setSuccess (state, payload) {
            state.success = payload
        },
        deleteSuccess (state, payload) {
            state.success = {}
        },

        // Errors
        setErrors (state, payload) {
            state.errors = payload
        },
        deleteErrors (state, payload) {
            state.errors = {}
        }
    },

    getters: {
        tour (state) {
            return state.tour
        },

        errors (state) {
            return state.errors
        },
        success (state) {
            return state.success
        }
    }
}