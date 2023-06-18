// import './bootstrap';
// import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import {router} from "@inertiajs/vue3";
import FullCalendar from "@fullcalendar/vue3";
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';
import Vue3Apexcharts from "vue3-apexcharts/src/vue3-apexcharts";
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.css'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        }
    },
})
// const app = createApp(App);
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'jhdevelopers';
router.on('navigate', () => document.getElementById('app').removeAttribute('data-page'));
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            // .use(VueSweetalert2)
            .use(vuetify)
            .use(Antd)
           // .use(VueApexCharts)
           // .use(Sortable)
            .component('apexchart', Vue3Apexcharts)
            //.component('Sortable', Sortable)
            .component('FullCalendar', FullCalendar)
            // .component('BootstrapVue', BootstrapVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
