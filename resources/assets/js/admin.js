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

Vue.component(
    'checkbox',
    require('./components/bootstrap/checkbox.vue')
);

Vue.component(
    'btn-primary',
    require('./components/bootstrap/btn-primary.vue')
);

Vue.component(
    'btn-link',
    require('./components/bootstrap/btn-link.vue')
);

Vue.component(
    'alert-success',
    require('./components/bootstrap/alert-success.vue')
);

Vue.component(
    'alert-danger',
    require('./components/bootstrap/alert-danger.vue')
);

const app = new Vue({
    el: '#admin'
});