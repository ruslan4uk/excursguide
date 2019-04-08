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
        // tourCategory: [
        //     {id: 1, title: 'Групповые экскурсии/туры'},
        //     {id: 2, title: 'Обзорные экскурсии/туры'},
        //     {id: 3, title: 'Авторские экскурсии/туры'},
        //     {id: 4, title: 'Гастрономические экскурсии/туры'},
        //     {id: 5, title: 'Экскурсии на автомобиле'},
        //     {id: 6, title: 'Пешеходные экскурсии'},
        //     {id: 7, title: 'Велотур/ велопоход'},
        //     {id: 8, title: 'Шопинг /шопинг тур'},
        //     {id: 9, title: 'Фотосессия'},
        //     {id: 10, title: 'Экскурсии по крышам'},
        //     {id: 11, title: 'Детские экскурсии/туры'},
        //     {id: 12, title: 'Паломничество'},
        //     {id: 13, title: 'Трансфер'},
        //     {id: 14, title: 'Круиз'},
        //     {id: 15, title: 'Квест'},
        //     {id: 16, title: 'Оздоровительный тур'},
        //     {id: 17, title: 'Восхождение в горы'},
        //     {id: 18, title: 'Дайвинг'},
        //     {id: 19, title: 'Джиппинг'},
        //     {id: 20, title: 'Йога тур'},
        //     {id: 21, title: 'Свадебная церемония'},
        //     {id: 22, title: 'Сноркелинг / снорклинг'},
        //     {id: 23, title: 'Экстрим'},
        //     {id: 24, title: 'Ночные экскурсии'},
        //     {id: 25, title: 'Полеты'},
        //     {id: 26, title: 'Музеи'},
        //     {id: 27, title: 'Достопримечательности'},
        //     {id: 28, title: 'Рыбалка'},
        //     {id: 29, title: 'Природа'},
        //     {id: 30, title: 'Морские/речные туры/экскурсии'},
        // ],

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