import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';
import "vue-multiselect/dist/vue-multiselect.css";


import DefaultLayout from './Layouts/DefaultLayout.vue';

// Inertia
import { createApp } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { Link } from "@inertiajs/vue3";

// Vue toastify
import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

// Inertia Modal
import { renderApp, ModalLink, Modal, putConfig } from '@inertiaui/modal-vue'

// Vue Multiselect
import VueMultiselect from 'vue-multiselect'

// ApexCharts
import VueApexCharts from "vue3-apexcharts";

// Custom components
import DataTable from './Components/DataTable.vue';

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Vuetify icons
import '@mdi/font/css/materialdesignicons.css'

// Matice
import { __, trans, setLocale, getLocale, transChoice, locales } from "matice"

// Ziggy
import { ZiggyVue } from 'ziggy-js';

// flag icons
import FlagIcon from 'vue-flag-icon'

import DashboardLayout from './Layouts/DashboardLayout.vue';
import { Field, Form } from 'vee-validate';
import DataTableServer from './Components/DataTableServer.vue';

const vuetify = createVuetify({
    components,
    directives,
})

putConfig({
    type: 'slideover',
    navigate: true,
    modal: {
        closeButton: true,
        closeExplicitly: false,
        maxWidth: 'xl',
        panelClasses: 'bg-white rounded',
        position: 'center',
    },
    slideover: {
        closeButton: true,
        closeExplicitly: true,
        maxWidth: 'xl',
        paddingClasses: 'p-4 sm:p-6',
        panelClasses: 'bg-white min-h-screen',
        position: 'right',
    },
})


createInertiaApp({
    title: (title) => `${title} - Neak Cinema`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        if (!page) {
            page = pages[`./Pages/Error.vue`]
        }
        if (name.includes('Dashboard')) {
            page.default.layout = DashboardLayout
        } else if (name.includes('Auth')) {
            page.default.layout = null
        } else {
            page.default.layout = page.default.layout || DefaultLayout
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: renderApp(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(FlagIcon)
            .use(
                Vue3Toastify,
                {
                    autoClose: 3000,
                }
            )
            .use(vuetify);

        app.mixin({
            methods: {
                $trans: trans,
                __: __,
                $transChoice: transChoice,
                $setLocale(locale) {
                    setLocale(locale);
                    this.$forceUpdate();
                },
                $locale() {
                    return getLocale();
                },
                $locales() {
                    return locales();
                },
            },
        });

        app.component('Link', Link);
        app.component('ModalLink', ModalLink);
        app.component('Modal', Modal);
        app.component('DataTable', DataTable);
        app.component('DataTableServer', DataTableServer);
        app.component("vee-form", Form);
        app.component("vee-field", Field);
        app.component('vue-multiselect', VueMultiselect);
        app.component('apexchart', VueApexCharts);

        app.mount(el)
    },
})
