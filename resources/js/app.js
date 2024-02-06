import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

//vuetify

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives
})

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Views/**/*.vue', {eager: true})
        return pages[`./Views/${name}.vue`]
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(vuetify)
            .mount(el)
    },
});
