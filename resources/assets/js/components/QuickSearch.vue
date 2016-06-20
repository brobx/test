<style>
    .comparassion .comp-item.active i {
        background-color: #23aae1;
        color: #fff;
        border-color: #23aae1;
    }

    .comparassion .comp-item.active .comp-name {
        color: #ddd;
    }
    .filter-item:nth-child(3) { 
        clear: both; 
    }
</style>

<template>
    <div class="comparassion">
        <ul v-if="categories" class="nav nav-pills nav-justified">
            <li class="border-bottom personal-tab {{ category === selectedCategory ? 'active' : '' }}" v-for="category in categories">
                <a href="#" @click="selectCategory(category)">{{ category.title }}</a>
            </li>
        </ul>
        <div class="comp-content">
            <div>
                <div class="row">
                    <div v-for="service in servicesList" class="col-md-4 col-xs-6">
                        <button @click="selectedService = service">
                            <div class="comp-item {{ selectedService === service ? 'active' : '' }}">
                                <img class="service-icon" :src="'/assets/img/services/' + service.icon + '.png'">
                                <p class="comp-name">{{ service.name }}</p>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="filter">
                    <form v-el:form method="GET" :action="compareUrl" v-clean>
                        <div class="filter-item" v-for="field in selectedService.quickFields" v-if="selectedService.quickFields">
                            {{{ field }}}
                        </div>
                    </form>
                </div>
                <div class="actions">
                    <div class="col-md-6 no-padding">
                        <button type="button" @click="compare" class="btn btn-trans no-margin-left">{{ compareText }}</button>
                    </div>
                    <div class="col-md-6 no-padding">
                        <a :href="advancedUrl" class="btn btn-trans">{{ advancedText }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['categories', 'services', 'compareText', 'advancedText'],
        data() {
            return {
                selectedService: { quickFields: [] },
                selectedCategory: null,
                locale: location.pathname.split('/')[1]
            }
        },

        watch: {
            "selectedService.quickFields": function () {
                this.$compile(this.$els.form);
            }
        },

        computed: {
            servicesList() {
                if(this.selectedCategory) {
                    return this.selectedCategory.services;
                }

                if(this.services) {
                    return this.services;
                }

                return [];
            },

            advancedUrl() {
                if(! this.selectedService) {
                    return '';
                }

                return `/${this.locale}/services/${this.selectedService.id}/listings`;
            },

            compareUrl() {
                return `/${this.locale}/services/${this.selectedService.id }/listings`;
            }
        },

        methods: {
            initializeData() {
                if(this.categories) {
                    this.selectedCategory = this.categories.length ? this.categories[0] : null;
                    const items = this.selectedCategory.services;
                    const loans = items.filter((item) => item.name == 'Personal Loans' || item.name == 'قرض شخصي')[0];
                    const loansIndex = items.indexOf(loans);
                    const credit = items[0];
                    items[0] = loans;
                    items[loansIndex] = credit;

                    this.selectedService = items[0];
                }

                if(this.services) {
                    this.selectedService = this.services.length ? this.services[0] : null;
                }
            },

            selectCategory(category) {
                this.selectedCategory = category;
                this.selectedService = category.services[0];
            },

            compare() {
                $(this.$els.form).submit();
            }
        },

        ready() {
            this.initializeData();
        }
    }
</script>