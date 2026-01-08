/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Header from './components/Header.vue';
import TopBar from './components/TopBar.vue';
import NavBar from './components/NavBar.vue';
import Sidebar from './components/Sidebar.vue';
import Footer from './components/Footer.vue';
import AppLayout from './components/AppLayout.vue';
import Slider from './components/Slider.vue';
import TeacherMultiStepForm from './components/TeacherMultiStepForm.vue';
import StudentMultiStepForm from './components/StudentMultiStepForm.vue';
import AdminLayout from './components/admin/AdminLayout.vue';
import AdminDashboard from './components/admin/AdminDashboard.vue';
import NoticesAdmin from './components/admin/Notices.vue';
import StudentsAdmin from './components/admin/Students.vue';
import GalleryAdmin from './components/admin/Gallery.vue';


app.component('example-component', ExampleComponent);
app.component('header-component', Header);
app.component('top-bar', TopBar);
app.component('nav-bar', NavBar);
app.component('sidebar-component', Sidebar);
app.component('footer-component', Footer);
app.component('app-layout', AppLayout);
app.component('slider', Slider);
app.component('teacher-multi-step-form', TeacherMultiStepForm);
app.component('student-multi-step-form', StudentMultiStepForm);


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

// Register all components including admin components
app.component('admin-layout', AdminLayout);
app.component('admin-dashboard', AdminDashboard);
app.component('notices-admin', NoticesAdmin);
app.component('students-admin', StudentsAdmin);
app.component('gallery-admin', GalleryAdmin);

// Mount the app to the #app element
app.mount('#app');
