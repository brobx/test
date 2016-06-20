<template>
    <div>
        <canvas v-el:canvas></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        chart: null,
        props: {
            type: {
                type: String,
                default: 'line',
                validator: value => value == 'bar' || value == 'doughnut' || value == 'line' || value == 'pie'
            },
            options: {
                default: () => {},
                type: Object
            },

            dataSets: {
                type: Object,
                default: () => {}
            }
        },

        methods: {
            load() {
                this.render(this.dataSets);
            },

            reload() {
                this.chart.destroy();
                this.load();
            },

            render(data) {
                this.chart = new Chart(this.$els.canvas.getContext('2d'), {
                    type: this.type,
                    data: data,
                    options: this.options
                });
            }
        },

        events: {
            reloadChart() {
                if(this.chart) {
                    this.reload();

                    return;
                }

                this.load();
            }
        }
    }
</script>
