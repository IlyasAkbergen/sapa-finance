require('./bootstrap');

import Vue from 'vue';

import {InertiaApp} from '@inertiajs/inertia-vue';
import {InertiaForm} from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueFlashMessage from 'vue-flash-message';
import UUID from "vue-uuid";
import interceptors from './interceptors'
import 'vue-search-select/dist/VueSearchSelect.css'
import VueMask from 'v-mask'
import {VueMaskDirective} from 'v-mask'
import {VueMaskFilter} from 'v-mask'

Vue.mixin({methods: {route}});
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueFlashMessage);
Vue.use(UUID);
Vue.use(VueMask);
Vue.directive('mask', VueMaskDirective);
Vue.filter('VMask', VueMaskFilter);
interceptors();
const app = document.getElementById('app');

import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.filter('truncate', function (value, size) {
    if (!value) return '';
    value = value.toString();

    if (value.length <= size) {
        return value;
    }
    return value.substr(0, size) + '...';
});

Vue.filter('price', (value) => {
  if (!value) return '';

  return value + ' ₸';
});

Vue.filter('defaultValue', (value, defaul_value) => {
  return value ? value : defaul_value;
});

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
