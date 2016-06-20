<style>
    .compare-slider .expand {
        will-change: transform;
        transition: transform 0.3s ease;
    }
    .expand-enter {
        transform: translateY(100%);
    }
    .expand-leave {
        transform: translateY(0%);
    }
</style>

<template>
    <div class="compare-slider expand" transition="expand" v-show="shown">
        <button id="compareClose" @click="shown = false" data-toggle="tooltip" data-placement="bottom" title="Hide"><i class="fa fa-times fa-2x" aria-hidden="true"></i></button>
        <div class="container">
            <div v-el:slider v-show="false" class="compare-wrapper">
                <div v-for="listing in listings" class="compare-item">
                    <button class="remove-comparison-item"
                            type="button" data-listing-id="{{ listing.id }}"
                    >Remove
                    </button>
                    <img :src="listing.image">
                    <a :href="listingUrl(listing)" class="btn btn-trans">{{ listing.name }}</a>
                </div>
            </div>
        </div>
        <a :href="compareLink" type="button" class="btn btn-trans" id="compareGo">Go</a>
    </div>
</template>

<script>
    export default {
        owl: null,
        props: {
            listings: {
                type: Array,
                default: () => []
            },
            compareLink: {
                type: String
            }
        },

        data() {
            return {
                locale: window.location.pathname.split('/')[1],
                shown: false
            }
        },

        methods: {
            removeListing(id) {
                this.$http.delete(`/${this.locale}/listings/${id}/remove`);
                const index = this.listings.findIndex((item) => item.id == id);
                this.listings.splice(index, 1);
                this.owl.data('owlCarousel').removeItem(index);
            },

            init() {
                this.cloned = this.$els.slider.cloneNode(true);
                this.cloned.id = 'owlSlider';
                this.cloned.style.display = null;
                this.cloned.style.opacity = null;
                this.$els.slider.parentElement.appendChild(this.cloned);

                this.owl = $('#owlSlider').owlCarousel({
                    items : 5,
                    itemsMobile : false,
                    rtl : true,
                    pagination : false,
                    navigation : true,
                    loop : true,
                    margin : 10,
                    callbacks : true,
                    navigationText: [
                        "<img src='/assets/img/arrow-left-white.png' class='img-responsive'>",
                        "<img src='/assets/img/arrow-right-white.png' class='img-responsive'>"
                    ],
                    responsive:{
                        0:{
                            items:1,
                            pagination : false,
                            navigation : true
                        },
                        600:{
                            items:3,
                            pagination : false,
                            navigation : true
                        },
                        1000:{
                            items:5,
                            pagination : false,
                            navigation : true
                        }
                    }
                });
                var self = this;
                this.owl.find('.compare-item').find('.remove-comparison-item').each(function () {
                    const id = $(this).data('listing-id');
                    this.addEventListener('click', function () {
                        self.removeListing(id);
                    });
                });
            },

            destroy() {
                this.owl.data('owlCarousel').destroy();
                this.owl.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
                this.owl.find('.owl-stage-outer').children().unwrap();
                this.owl.remove();
            },

            reinit() {
                this.destroy();
                this.init();
            },

            listingUrl(listing) {
                return `/${this.locale}/listings/${listing.id}`;
            }
        },

        events: {
            addedListing(id, name, image) {
                if(this.listings.filter(item => item.id === id).length > 0) {
                    this.shown = true;
                    return;
                }

                this.listings.push({name, image, id});
                this.shown = true;
                this.$http.post(`/${this.locale}/listings/${id}/compare`, () => {
                    this.reinit();
                });
            }
        },

        ready() {
            this.init();
        }
    }
</script>
