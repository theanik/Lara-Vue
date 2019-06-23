
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import { Form, HasError, AlertError } from 'vform'

import Gate from './components/gate'
Vue.prototype.$gate = new Gate(window.user);


import Swal from 'sweetalert2'
window.Swal = Swal;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Fire = new Vue();

Vue.use(VueRouter)
const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
let routes = [
    { path: '/dashbord', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/invoice', component: require('./components/Invoice.vue').default },
   { path: '*', component: require('./components/NotFound.vue').default }
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  });

  var toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  window.toast = toast;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
  'not-found',
  require('./components/NotFound.vue').default
);
Vue.filter('capitalize',function(text){
    text = text.toString();
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('mydate',function(createAt){
  return moment(createAt).format('MMMM Do YYYY, h:mm');
});

//progressBar
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data:{
      search : ''
    },
    methods:{
      searchit:_.debounce(()=>{
        Fire.$emit('searching');
      },1000),
      // Printme(){
      //   console.log('hedddaaa');
      // }
      
    }
});
