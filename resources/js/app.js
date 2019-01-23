
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

import select2 from 'select2';

$("#datatable").DataTable();

$(".select2").select2();

var treeviewMenu = $('.app-menu');

// Toggle Sidebar
$('[data-toggle="sidebar"]').click(function(event) {
	event.preventDefault();
	$('.app').toggleClass('sidenav-toggled');
});

// Activate sidebar treeview toggle
$("[data-toggle='treeview']").click(function(event) {
	event.preventDefault();
	if(!$(this).parent().hasClass('is-expanded')) {
		treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
	}
	$(this).parent().toggleClass('is-expanded');
});

// Set initial active toggle
$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

//Activate bootstrip tooltips
$("[data-toggle='tooltip']").tooltip();
