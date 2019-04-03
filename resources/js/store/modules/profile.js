export default {
    namespaced: true,
 
    state: {
        profile: {},
        user_data: {
            about: '',
            languages: {},
            locations: {},
            contacts: [],
        },
        success: {},
        errors: {},

    },

    actions: {
        async getProfile(store) {
            await axios.get('/api/profile').then(r => r.data)
                .then(response => {
                    store.commit('setProfile', response)
                    store.commit('setUserData', response.user_data)
                })
        },
        saveProfile(store) {            
            let object = store.state.profile 
            object.user_data = store.state.user_data
            
            axios.post('/api/profile', object)
                .then(response => {
                    store.commit('deleteErrors')
                    store.commit('setSuccess', response.data)
                })
                .catch(errors => {
                    store.commit('setErrors', errors.response.data.errors)
                    store.commit('deleteSuccess')
                })
        },
    },

    mutations: {
        setProfile (state, payload) {
            state.profile = payload
        },
        setUserData (state, payload) {
            state.user_data = payload
        },
        setName (state, payload) {
            state.profile.name = payload.target.value
        },
        setServices (state, payload) {            
            state.user_data.services = payload
        },
        // Language
        addLang (state, payload) {
            state.user_data.languages == null 
                    ? state.user_data.languages = [] 
                    : state.user_data.languages
            state.user_data.languages.push(payload);
        },
        deleteLang (state, payload) {
            state.user_data.languages.splice(state.user_data.languages.indexOf(payload), 1);
        },
        // City
        addCity (state, payload) {
            state.user_data.locations == null 
                    ? state.user_data.locations = [] 
                    : state.user_data.locations
            state.user_data.locations.push(payload)
        },
        deleteCity (state, payload) {
            state.user_data.locations.splice(state.user_data.locations.indexOf(payload), 1);
        },

        // Contact
        addContacts (state, payload) {
            state.user_data.contacts == null 
                    ? state.user_data.contacts = [] 
                    : state.user_data.contacts
            if(state.user_data.contacts.length < 5) {
                state.user_data.contacts.push({type_id: '', value: ''})
            }
        },
        setItemContactInput (state, payload) {
            state.user_data.contacts[payload.index].value = payload.item      
        },
        setItemContactType (state, payload) {
            state.user_data.contacts[payload.index].type_id = payload.item            
        },
        deleteItemContact (state, payload) {
            state.user_data.contacts.splice(payload, 1);
        },

        // Avatar
        setAvatar (state, payload) {
            state.user_data.avatar = payload
        },

        setAbout (state, payload) {
            state.user_data.about = payload.target.value
        },

        // License
        setLicense (state, payload) {
            state.user_data.user_files = payload
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
        profile(state) {
            return state.profile
        },
        user_data (state) {
            return state.user_data
        },


        getItemContacts (state) {            
            return state.user_data.contacts
        },
        

        success (state) {
            return state.success
        },
        errors (state) {
            return state.errors
        },
    }
}