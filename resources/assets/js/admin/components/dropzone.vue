<style>
    .dropzone {
        border: 2px dashed #3c8dbc;
        border-radius: 5px;
        background: white;
        cursor: pointer;
    }
</style>

<template>
    <div class="dropzone">

    </div>
</template>

<script>
    export default {
        props: ['url', 'name'],

        ready() {
            var self = this;
            $(this.$el).dropzone({
                url: self.url,
                paramName: "image",
                maxFilesize: 2,
                acceptedFiles: '.png,.bmp,.jpg,.jpeg,.gif',

                headers: {
                    'X-CSRF-TOKEN': self.$http.headers.common['X-CSRF-TOKEN']
                },

                init: function () {
                    this.on("success", (file, response) => {
                        self.$dispatch('imageUploaded', response.slider);
                    });
                }
            });
        }
    }
</script>