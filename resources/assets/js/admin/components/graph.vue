<template>
    <div>
        <div class="nav-tabs-custom" v-if="tabs && tabs.length">
            <ul class="nav nav-tabs">
                <li :class="{ active: tab == selectedTab }" v-for="tab in tabs">
                    <a @click.prevent="selectedTab = tab" href="#">{{ tab | capitalize }}</a>
                </li>
            </ul>
        </div>
        <div>
            <canvas v-el:canvas></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        chart: null,
        props: {
            url: { type: String },
            type: {
                type: String,
                default: 'line',
                validator: value => value == 'bar' || value == 'doughnut' || value == 'line' || value == 'pie'
            },
            tabs: {
                type: Array,
                default: () => []
            },
            tabParameter: {
                type: String,
                default: ''
            },
            options: {
                default: () =>{},
                type: Object
            }
        },

        data() {
            return {
                legend: '',
                selectedTab: this.tabs[0] || ''
            }
        },

        watch: {
            selectedTab() {
                this.reload();
            }
        },

        methods: {
            load() {
                this.fetchData().then(response => {
                    this.render(response.data);
                });
            },

            reload() {
                this.chart.destroy();
                this.load();
            },

            fetchData() {
                var payload = {};
                payload[this.tabParameter] = this.selectedTab;

                return this.$http.get(this.url, payload);
            },

            render(data) {
                this.chart = new Chart(this.$els.canvas.getContext('2d'), {
                    type: this.type,
                    data: data,
                    options: this.options
                });
            }
        },

        ready() {
            this.load();
        }
    }
</script>
