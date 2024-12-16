import './bootstrap';
import DefaultLayout from './Layouts/DefaultLayout.vue';

// Inertia
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Matice
import { __, trans, setLocale, getLocale, transChoice, MaticeLocalizationConfig, locales } from "matice"

// Ziggy
import { ZiggyVue } from 'ziggy-js';

const vuetify = createVuetify({
    components,
    directives,
})

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        if (!page) {
            page = pages[`./Pages/Error.vue`]
        }
        page.default.layout = page.default.layout || DefaultLayout
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
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

        app.mount(el)
    },
})
