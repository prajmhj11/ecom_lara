require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'


Vue.use(VueRouter)

let routes = [
    { path: '/home', component: require('./components/Home.vue').default, name:'Home'},
    { path: '/profile', component: require('./components/Profile.vue').default, name:'Profile'},
    { path: '/dashboard', component: require('./components/Dashboard.vue').default, name:'Dashboard'},
    { path: '/users', component: require('./components/Users.vue').default, name:'Users'},
    { path: '/developer', component: require('./components/Profile.vue').default, name:'Developer'},
  ]

const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
});



