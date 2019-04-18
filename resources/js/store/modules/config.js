import Axios from "axios";

export default {
    namespaced: true,

    state: {
        services: [],
        // services: [
        //     {id: 1, title: 'Частный гид'},
        //     {id: 2, title: 'Туристическая компания/агентство'},
        //     {id: 3, title: 'Туроператор'},
        //     {id: 4, title: 'Шоппер'},
        //     {id: 5, title: 'Услуги перевода'},
        //     {id: 6, title: 'Фотограф'},
        //     {id: 7, title: 'Видео оператор'},
        //     {id: 8, title: 'Услуги трансфера'},
        //     {id: 9, title: 'Аренда авто'},
        //     {id: 10, title: 'Аренда яхты '},
        //     {id: 11, title: 'Организация торжеств'},
        //     {id: 12, title: 'Гастрономический гид'},
        //     {id: 13, title: 'Инструктор'},
        // ],

        languages: [
            {uid: 'ru', title: 'Русский'},
            {uid: 'en', title: 'Английский'},
            {uid: 'es', title: 'Испанский'},
            {uid: 'pt', title: 'Португальский'},
            {uid: 'ch', title: 'Чешский'},
        ],

        contactType: [
            {id: 1, title: 'Домашний'},
            {id: 2, title: 'Рабочий'},
            {id: 3, title: 'Skype'},
            {id: 4, title: 'Telegram'},
            {id: 5, title: 'Viber'},
            {id: 6, title: 'WhatsApp'}
        ],

        // tour
        tourCategory: [],

        // People category
        peopleCategory: [
            {id: 1, title: 'Для детей'},
            {id: 2, title: 'МГН'},
            {id: 3, title: 'Пожилые люди'},
        ],

        tourTiming: [
            {id: 1, title: 'менее 1 часа'},
            {id: 2, title: '1-3 часа'},
            {id: 3, title: '3-5 часов'},
            {id: 4, title: '5-7 часов'},
            {id: 5, title: '7-9 часов'},
            {id: 6, title: '9-12 часов'},
            {id: 7, title: 'более 12 часов'},
        ],

        tourCurrency: [
            {id: 643, title: 'RUB'},
            {id: 840, title: 'USD'},
            {id: 978, title: 'EUR'},
        ],

        tourPriceType: [
            {id: 1, title: 'С человека'},
            {id: 2, title: 'С группы'}
        ],

    },

    actions: {
        // Get category
        async apiCategory(store) {
            await axios.get('/api/category/list').then(r => r.data)
                .then(response => {
                    store.commit('setCategory', response)
                })
        },
        // Get service
        async apiService(store) {
            await axios.get('/api/service/list').then(r => r.data)
                .then(response => {
                    store.commit('setService', response)
                })             
            },
    },

    mutations: {
        setCategory(state, payload) {
            state.tourCategory = payload
        },
        setService(state, payload) {
            state.services = payload
        }
    },

    getters: {
        services (state) {
            return state.services
        },
        languages (state) {
            return state.languages
        },
        contactType (state) {
            return state.contactType
        },
        tourCategory (state) {
            return state.tourCategory
        },
        peopleCategory (state) {
            return state.peopleCategory
        },
        tourTiming (state) {
            return state.tourTiming
        },
        tourCurrency (state) {
            return state.tourCurrency
        },
        tourPriceType (state) {
            return state.tourPriceType
        }
    },

}