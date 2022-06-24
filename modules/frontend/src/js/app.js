import Vue from 'vue'
import VueMeta from 'vue-meta'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

Vue.config.productionTip = false

Vue.use(InertiaApp)
Vue.use(VueMeta)

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 500,

    // The color of the progress bar.
    color: '#1E3A8A',
})


new Vue({
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - Craft` : 'Craft'
  },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(document.getElementById('app'))
