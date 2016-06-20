<template>
    <div>
        <dropzone :name="name" :url="url"></dropzone>
        <br>
        <br>
        <div v-for="slide in slides" class="col-md-3">
            <img class="img-responsive" :src="'/uploads/' + slide.image" height="150" alt="">
            <br>
            <input name="slides[{{ $index }}][image]" type="hidden" :value="slide.image">
            <div class="form-group">
                <textarea name="slides[{{ $index }}][description]" rows="2" placeholder="Description (English)" class="form-control"></textarea>
            </div>
            <div class="form group">
                <textarea name="slides[{{ $index }}][description_ar]" dir="auto" rows="2" placeholder="Description (Arabic)" class="form-control"></textarea>
            </div>
        </div>
        <label v-if="message">{{ message }}</label>
    </div>
</template>

<script>
    import SliderUpload from './slider-upload.vue';

    export default SliderUpload.extend({});
</script>