import {createApp, h} from "vue";
import {app, plugin} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from '@inertiajs/progress';
import VueMeta from 'vue-meta'

InertiaProgress.init({
    // The color of the progress bar.
    color: '#1E3A8A',
})

window.baguetteBox = require('baguettebox.js');

window.initLightBox = function(id) {
    window.baguetteBox.run(id);
}

const el = document.getElementById("app");

createApp({
    render: () =>
        h(app, {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
        }),
})
    .use(plugin)
    .use(VueMeta)
    .mount(el);
