/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
window.EventBus = new Vue({})
window.flash = message => EventBus.$emit('flash', message)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('player', require('./components/Player.vue'))
Vue.component('manager', require('./components/VisualsManager.vue'))
Vue.component('modal', require('./components/Modal.vue'))
Vue.component('comment', require('./components/Comment.vue'))
Vue.component('flash', require('./components/Flash.vue'))
Vue.component('delete-modal', require('./components/DeleteModal.vue'))
Vue.component('Rating', require('vue-bulma-rating'))
