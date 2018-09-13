
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import iview from 'iview';
import 'iview/dist/styles/iview.css';
Vue.use(iview);

Vue.component('home-card', require('./components/HomeCardContainer.vue'));
Vue.component('chat-room', require('./components/ChatRoom.vue'));
Vue.component('goods-form', require('./components/GoodsForm.vue'));
Vue.component('user-list', require('./components/UserList.vue'));

const app = new Vue({
    el: '#app',
    methods: {
        reload() {
            window.location.reload()
        }
    },
});
