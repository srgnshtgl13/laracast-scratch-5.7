/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Vue router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// errors.js module - error handling - if we wanna use inside any vue component
// import Errors from './errors';
// window.Errors = Errors;

// form.js module - form event handling
import Form from './form';
window.Form = Form;

// get the current logged in user from laravel blade and make proptotype and use this inside any vue component this.$auth_user inside script and in v-if="$auth_user"
// Vue.prototype.$auth_user=window.user // but instead of doing this lets create a new class and return the user infos
import UserInfo from './userinfo'
Vue.prototype.$userinfo = new UserInfo(window.user)
// and we can define a prototype for role
import Gate from './gate'
Vue.prototype.$role = new Gate(window.user)



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//projects components
Vue.component('index-component', require('./components/projects/IndexComponent.vue').default);
Vue.component('show-component', require('./components/projects/ShowComponent.vue').default);
//user profile
Vue.component('profile-component', require('./components/user/Profile.vue').default);

Vue.component('flights-component', require('./components/flights/Flights.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data(){
    	return{
    		
    	}
    }
});
