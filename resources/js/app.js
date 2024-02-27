import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import axios from './Plugins/axios'
import vuetify from './Plugins/vuetify'
import toast from './Plugins/toast'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) }).use(plugin)
    const plugins = [axios, vuetify, toast]

    plugins.forEach((plugin) => app.use(plugin))

    return app.mount(el)
  },
  progress: {
    color: '#4CAF50',
  },
})
