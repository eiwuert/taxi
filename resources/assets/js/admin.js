require('./bootstrap')

// AdminLTE
require('../bower/AdminLTE/dist/js/app.min.js');

Vue.component(
    'info-box',
    require('./components/admin/InfoBox.vue')
);

Vue.component(
    'email',
    require('./components/bootstrap/Email.vue')
);

Vue.component(
    'password',
    require('./components/bootstrap/Password.vue')
);

const app = new Vue({
    el: '#admin'
});