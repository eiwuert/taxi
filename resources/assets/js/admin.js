require('./bootstrap')

// AdminLTE
require('../bower/AdminLTE/dist/js/app.min.js');
Vue.component('info-box', require('./components/admin/InfoBox.vue'));
Vue.component('email', require('./components/bootstrap/Email.vue'));
Vue.component('password', require('./components/bootstrap/password.vue'));
Vue.component('checkbox', require('./components/bootstrap/Checkbox.vue'));
Vue.component('btn-primary', require('./components/bootstrap/btn-primary.vue'));
Vue.component('btn-danger', require('./components/bootstrap/btn-danger.vue'));
Vue.component('btn-success', require('./components/bootstrap/btn-success.vue'));
Vue.component('btn-link', require('./components/bootstrap/btn-link.vue'));
Vue.component('btn-warning', require('./components/bootstrap/btn-warning.vue'));
Vue.component('btn-default', require('./components/bootstrap/btn-default.vue'));
Vue.component('alert-success', require('./components/bootstrap/alert-success.vue'));
Vue.component('alert-danger', require('./components/bootstrap/alert-danger.vue'));
Vue.component('tag', require('./components/bootstrap/tag.vue'));
Vue.component('bs-input', require('./components/bootstrap/input.vue'));
Vue.component('notification-menu', require('./components/admin/NotificationsCount.vue'));
Vue.component('notification-client-count', require('./components/admin/NotificationsClientCount.vue'));
Vue.component('notification-driver-count', require('./components/admin/NotificationsDriverCount.vue'));
Vue.component('alert-dismissible', require('./components/admin/AlertDismissible.vue'));
Vue.component('switch-state', require('./components/admin/SwitchState.vue'));
Vue.component('calculator', require('./components/admin/Calculator.vue'));

const app = new Vue({
    el: '#admin',
});
