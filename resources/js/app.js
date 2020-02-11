/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Autocomplete from '@trevoreyre/autocomplete-vue'

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('region-component', require('./components/RegionComponent.vue').default);
Vue.component('region-ajax-component', require('./components/RegionAjaxComponent.vue').default);
Vue.component('autocomplete', require('./components/AutocompleteComponent.vue').default);





//
// let countries = ['agro','nice','good','iva'];
//
// new Autocomplete('#autocomplete', {
//
//
//
//
// // const app = new Vue({
// //     el: '#app'
// // });
//
//
//     search: input => {
//         if (input.length < 1) { return [] }
//         return countries.filter(country => {
//             return country.toLowerCase()
//                 .startsWith(input.toLowerCase())
//         })
//     },
//
//     autoSelect: true
// });