import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

function toast(message, success = true) {
    createToast(message, {
        type: success ? 'success' : 'danger',
        timeout: 3000,
        position: 'top-right',
        showIcon: true,
        toastBackgroundColor: success ? '#0E9F6E' : '#F05252',
    });
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mixin({
                updated() {
                    if (this.$page.props?.flash?.success) {
                        toast(this.$page.props.flash.success);
                        this.$page.props.flash.success = "";
                    }
                    if (this.$page.props?.flash?.failed) {
                        toast(this.$page.props.flash.failed, false);
                        this.$page.props.flash.failed = "";
                    }
                },
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
