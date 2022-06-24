import Vue from 'vue'
import VueMeta from 'vue-meta'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'

import '../css/app.css'

Vue.config.productionTip = false

Vue.use(InertiaApp)
Vue.use(VueMeta)

InertiaProgress.init({

    // The color of the progress bar.
    color: '#1E3A8A',
})

window.baguetteBox = require('baguettebox.js');

window.initLightBox = function(id) {
    window.baguetteBox.run(id);
}

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
