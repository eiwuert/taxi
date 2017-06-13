require('./bootstrap')

// AdminLTE
require('../bower/AdminLTE/dist/js/app.min.js');
Vue.component('tag', require('./components/bootstrap/tag.vue'));
Vue.component('info-box', require('./components/admin/InfoBox.vue'));
Vue.component('email', require('./components/bootstrap/Email.vue'));
Vue.component('bs-input', require('./components/bootstrap/input.vue'));
Vue.component('password', require('./components/bootstrap/password.vue'));
Vue.component('checkbox', require('./components/bootstrap/Checkbox.vue'));
Vue.component('btn-link', require('./components/bootstrap/btn-link.vue'));
Vue.component('calculator', require('./components/admin/Calculator.vue'));
Vue.component('plate', require('./components/admin/Plate.vue'));
Vue.component('switch-state', require('./components/admin/SwitchState.vue'));
Vue.component('btn-danger', require('./components/bootstrap/btn-danger.vue'));
Vue.component('btn-primary', require('./components/bootstrap/btn-primary.vue'));
Vue.component('btn-success', require('./components/bootstrap/btn-success.vue'));
Vue.component('btn-warning', require('./components/bootstrap/btn-warning.vue'));
Vue.component('btn-default', require('./components/bootstrap/btn-default.vue'));
Vue.component('alert-success', require('./components/bootstrap/alert-success.vue'));
Vue.component('alert-danger', require('./components/bootstrap/alert-danger.vue'));
Vue.component('alert-dismissible', require('./components/admin/AlertDismissible.vue'));
Vue.component('notification-menu', require('./components/admin/NotificationsCount.vue'));
Vue.component('notification-client-count', require('./components/admin/NotificationsClientCount.vue'));
Vue.component('notification-driver-count', require('./components/admin/NotificationsDriverCount.vue'));

import persian from 'vee-validate/dist/locale/fa';

const app = new Vue({
  el: '#admin',
  computed: {
    nextLocale() {
      return this.locale === 'en' ? 'Arabic' : 'English';
    }
  },
  methods: {
    changeLocale() {
      this.locale = this.$validator.locale === 'ar' ? 'en' : 'ar';
      this.$validator.setLocale(this.locale);
    }
  },
  created() {
    this.$validator.updateDictionary({
      ar: {
        messages: persian.messages,
        attributes: {
          email: 'پست الکترونیکی',
          phone: 'تلفن',
          first_name: 'نام',
          last_name: 'نام خانوادگی',
          address: 'آدرس',
          zipcode: 'کدپستی',
          identity_code: 'شماره ملی',
          identity_number: 'شماره شناسنامه',
          credit_card: 'شماره کارت',
          country: 'کشور',
        }
      }
    });
    this.changeLocale();
  }
});
