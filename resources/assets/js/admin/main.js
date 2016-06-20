import Vue from 'vue';
import VueResource from 'vue-resource';
import ImageUpload from './components/image-upload.vue';
import SliderUpload from './components/slider-upload.vue';
import ToggledField from './components/toggled-field.vue';
import InlineSliderUpload from './components/inline-slider-upload.vue';
import Graph from './components/graph.vue';

Vue.use(VueResource);
Vue.use(require('./directives'));

// Config
Vue.config.debug = process.env.NODE_ENV !== 'production';
Dropzone.autoDiscover = false;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');


// Root App.
new Vue({
    el: 'body',
    components: {
        ImageUpload,
        SliderUpload,
        ToggledField,
        InlineSliderUpload,
        Graph
    }
});