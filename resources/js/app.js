import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import route from 'ziggy'
import { Ziggy } from './routes'

Vue.use(InertiaApp)
Vue.use(VueMeta)
Vue.use(PortalVue)

Vue.mixin({
  methods: {
    route: (name, params, absolute) => route(name, params, absolute, Ziggy),
  }
})

const app = document.getElementById('app')

new Vue({
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - MojeKniha` : 'MojeKniha'
  },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app)
