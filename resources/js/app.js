import $ from "jquery";
window.$ = window.jQuery = $;

import "bootstrap";

// import Vue from "vue";
// import { library } from "@fortawesome/fontawesome-svg-core";
// import { fab } from "@fortawesome/free-brands-svg-icons";
// import { far } from "@fortawesome/free-regular-svg-icons";
// import { fas } from "@fortawesome/free-solid-svg-icons";
// import {
//   FontAwesomeIcon,
//   FontAwesomeLayers
// } from "@fortawesome/vue-fontawesome";

// library.add(fab, far, fas);

// Vue.config.productionTip = false;
// Vue.component("fa-icon", FontAwesomeIcon);
// Vue.component("fa-layers", FontAwesomeLayers);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//   "example-component",
//   require("./components/ExampleComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//   el: "#app"
// });

$(document).ready(function() {
  // Toggle sidebar
  $('#sidebar-toggle').click(() => {
    $('.wrapper').toggleClass('wrapper-toggled');
  })
});
