<template>
    <div>
        <div>
            <img v-show="fileName" :src="imageSource" width="100" height="100">
            <div v-show="uploading">
                <i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                <span class="sr-only">Uploading...</span>
            </div>
            <input type="hidden" :name="name" :value="fileName">
            <input v-show="false" name="file" type="file" :id="inputId" @change="onChange" accept="image/*">
            <br>
            <br>
        </div>
        <div class="btn-group">
            <a v-show="! fileName" @click="selectImage" class="btn btn-primary"><i class="fa fa-upload"></i> Select Image</a>
            <a v-show="fileName" class="btn btn-danger" @click="removeImage"><i class="fa fa-trash"></i> Remove Image</a>
        </div>
        <label v-if="message">{{ message }}</label>
    </div>
</template>

<script>
    export default {
        props: ['name', 'message', 'url', 'fileName'],
        imageInput: null,
        data() {
            return {
                uploading: false,
                imageSource: ''
            }
        },
        computed: {
            inputId() {
                return this.name + '-file';
            }
        },

        watch: {
            uploading(value) {
                this.form.find(":submit")[0].disabled = value;
            }
        },

        methods: {
            selectImage() {
                this.imageInput.click();
            },

            removeImage() {
                this.fileName = '';
                this.imageInput.val('');
            },

            onChange(event) {
                this.imageSource = URL.createObjectURL(event.target.files[0]);
                var formData = new FormData();
                formData.append('image', event.target.files[0]);
                this.uploading = true;
                this.$http.post(this.url, formData)
                .then(response => {
                    this.fileName = response.data.name;
                }, () => console.log('Failed to upload image'))

                .then(() => this.uploading = false);
            }
        },

        ready() {
            if(this.fileName) {
                this.imageSource = `/uploads/${this.fileName}`;
            }

            this.imageInput = $('#' + this.inputId);
            this.form = $($(this.imageInput)[0].form);
        }
    }
</script>
