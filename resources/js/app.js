/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import Swal from 'sweetalert2';
window.Swal = Swal


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast = Toast
 
  
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import login from './components/login.vue';
import add_new_model from './components/add_new_model.vue';
import edit_model from './components/edit_model.vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import search_model from './components/search_model.vue';
import purchase_record from './components/purchase_record.vue';
import comment from './components/comment.vue';

app.component('example-component', ExampleComponent);
app.component('vue-login', login);
app.component('add-new-model', add_new_model);
app.component('edit-model', edit_model);
app.component('Bootstrap5Pagination', Bootstrap5Pagination);
app.component('search-model', search_model);
app.component('purchase-record', purchase_record);
app.component('comment', comment);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
