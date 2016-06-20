<template>
    <div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Upload Images</h3>
                <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <dropzone :name="name" :url="url"></dropzone>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Uploaded Slides</h3>
                <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div v-for="slide in slides" class="col-md-3">
                    <img class="img-responsive" :src="'/uploads/' + slide.image" height="150" alt="">
                    <br>
                    <input name="slides[{{ $index }}][image]" type="hidden" :value="slide.image">
                    <div class="form-group" v-if="hasTitle">
                        <input name="slides[{{ $index }}][title]" type="text" placeholder="Title (English)" class="form-control">
                    </div>
                    <div class="form-group" v-if="hasTitle">
                        <input name="slides[{{ $index }}][title_ar]" dir="auto" type="text" placeholder="Title (Arabic)" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="slides[{{ $index }}][description]" rows="2" placeholder="Description (English)" class="form-control"></textarea>
                    </div>
                    <div class="form group">
                        <textarea name="slides[{{ $index }}][description_ar]" dir="auto" rows="2" placeholder="Description (Arabic)" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" class="btn btn-success" value="Save">
                <label v-if="message">{{ message }}</label>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import Dropzone from './dropzone.vue';

    export default Vue.extend({
        props: ['name', 'url', 'hasTitle', 'message'],

        data() {
            return {
                slides: []
            }
        },

        events: {
            imageUploaded(sliderItem) {
                this.slides.push(sliderItem);
            }
        },

        components: {
            Dropzone
        }
    });
</script>