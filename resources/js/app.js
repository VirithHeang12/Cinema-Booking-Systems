import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

import DefaultLayout from './Layouts/DefaultLayout.vue';

// Inertia
import { createApp } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { Link } from "@inertiajs/vue3";

// Inertia modal
import { renderApp } from '@inertiaui/modal-vue'
import { ModalLink } from '@inertiaui/modal-vue';
import { Modal } from '@inertiaui/modal-vue';
import { putConfig } from '@inertiaui/modal-vue';


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
import { __, trans, setLocale, getLocale, transChoice, MaticeLocalizationConfig, locales } from "matice"

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
    type: 'modal',
    navigate: false,
    modal: {
        closeButton: true,
        closeExplicitly: false,
        maxWidth: '2xl',
        paddingClasses: 'p-4 sm:p-6',
        panelClasses: 'bg-white rounded',
        position: 'center',
    },
    slideover: {
        closeButton: true,
        closeExplicitly: false,
        maxWidth: 'md',
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

        app.mount(el)
    },
})
