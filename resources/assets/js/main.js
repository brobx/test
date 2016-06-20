import Vue from 'vue';
import VueResource from 'vue-resource';
import QuickSearch from './components/QuickSearch.vue';
import SearchHelp from './components/SearchHelp.vue';
import BudgetCalculator from './components/BudgetCalculator.vue';
import ComparisonSlider from './components/ComparisonSlider.vue';

Vue.use(VueResource);
Vue.use(require('./directives'));

// Config
Vue.config.debug = process.env.NODE_ENV !== 'production';
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.headers.common['Access-Control-Allow-Origin'] = '*';
Vue.http.headers.common['Access-Control-Allow-Methods'] = '*';
Vue.http.headers.common['Access-Control-Allow-Headers'] = 'Content-Type, Content-Range, Content-Disposition, Content-Description';

// Root App.
new Vue({
    el: 'body',
    components: {
        QuickSearch,
        SearchHelp,
        BudgetCalculator,
        ComparisonSlider
    }
});
