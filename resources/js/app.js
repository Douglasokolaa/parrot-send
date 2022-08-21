import './bootstrap';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {createPinia} from "pinia";
import {InertiaProgress} from '@inertiajs/progress';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import globalComponents from "./global-components";
import utils from "./utils";

import '../css/app.css';


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const app = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, app, props, plugin}) {
        const vueApp = createApp({render: () => h(app, props)})
            .use(plugin)
            .use(createPinia())
            .mixin({methods: {route}})
        globalComponents(vueApp);
        utils(vueApp);

        return vueApp.mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
