import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'

//vuetify
import 'vuetify/styles'
import {createVuetify} from 'vuetify'
import {aliases, fa} from 'vuetify/iconsets/fa'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@fortawesome/fontawesome-free/css/all.css'

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'fa',
    aliases,
    sets: {
      fa,
    },
  },
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
