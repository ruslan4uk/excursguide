
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Js function required
require('./function.jquery');

/**
 * Bootstrap tooltip
 */
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

window.Vue = require('vue');

import { store } from './store'

// Import Owl.carousel 2
require('../../node_modules/owl.carousel2/dist/owl.carousel');
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        items: 1,
        //loop: true,
        nav: true,
        navText : ["<div class='tour__slider-navs tour__slider-navs--prev'><i class='fa fa-chevron-left'></i></div>",
                    "<div class='tour__slider-navs tour__slider-navs--next'><i class='fa fa-chevron-right'></i></div>"]
    });
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('user-profile', require('./components/profile/UserProfile.vue').default);
Vue.component('user-tour', require('./components/profile/UserTour.vue').default);
Vue.component('main-search', require('./components/frontend/MainSearch.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});
