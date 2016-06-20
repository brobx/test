<template>
    <div>
        <button v-el:button type="button" @click="calculate" class="btn btn-trans btn-block">
            <slot></slot>
        </button>
        <div v-el:modal class="remodal" data-remodal-id="budget-modal">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h1>{{ title }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ locale == 'ar' ? 'تحليل الميزانية' : 'Budget Analysis' }}</h3>
                    <graph type="pie" :data-sets="chartData"></graph>
                </div>
                <div class="col-md-6">
                    <h3>{{ locale == 'ar' ? 'ترشيحات' : 'Recommendations' }}</h3>
                    <p>{{ locale == 'ar' ? 'خذ فى الاعتبار انك تقدم على' : 'you should consider applying for' }}</p>
                    <table class="table table-hover budget-table">
                        <thead>
                        <tr>
                            <th>{{ locale == 'ar' ? 'توفير' : 'Savings' }}</th>
                            <th>{{ locale == 'ar' ? 'ادخار' : 'Borrowing' }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td v-if="typeof recommendations.savings == 'string'">
                                <p>{{ recommendations.savings }}</p>
                            </td>
                            <td v-else>
                                <p>
                                    <a v-for="service in recommendations.savings" :href="service.url">
                                        {{ service.name }}{{ $index + 1 == recommendations.savings.length ? '.' : ', ' }}
                                    </a>
                                </p>
                            </td>
                            <td v-if="typeof recommendations.borrowing == 'string'">
                                <p>{{ recommendations.borrowing }}</p>
                            </td>
                            <td v-else>
                                <p>
                                    <a v-for="service in recommendations.borrowing" :href="service.url">
                                        {{ service.name }}{{ $index + 1 == recommendations.borrowing.length ? '.' : ', ' }}
                                    </a>
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        </div>
    </div>
</template>

<script>
    import Graph from './Graph.vue';

    export default {
        modalInstance: null,
        props: ['title'],
        data() {
            return {
                chartData: {},
                recommendations: [],
                locale: window.location.pathname.split('/')[1]
            }
        },
        components: {
            Graph
        },

        methods: {
            calculate() {
                this.chartReady = false;

                const payload = { expenses: {} };
                $(this.$els.button.form).serializeArray().forEach(item => {
                    if(item.name.indexOf('expenses') >= 0) {
                       payload.expenses[item.name.replace(/\[|]|expenses/g, '')] = item.value;
                       return;
                    }

                    payload[item.name] = item.value;
                });

                this.$http.post(`/${this.locale}/api/tools/budget`, payload).then(response => {
                    this.chartData = response.data.chart;
                    this.recommendations = response.data.recommendations;
                    this.modalInstance.open();
                }).then(() => {
                    this.$broadcast('reloadChart');
                });
            }
        },

        ready() {
            this.modalInstance = $(this.$els.modal).remodal();
        }
    }
</script>