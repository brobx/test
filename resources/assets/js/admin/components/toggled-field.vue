<template>
    <div>
        <div class="form-group" v-if="! hidden">
            <slot>Your Content</slot>
        </div>

        <button type="button" class="btn btn-{{ hidden ? 'primary' : 'danger' }}"
                @click="hidden = ! hidden"
        > {{ hidden ? showText : hideText }}</button>
    </div>
</template>

<script>
    export default {
        props: {
            hidden: {
                type: Boolean,
                default: true
            },

            showText: {
                type: String,
                default: 'Show'
            },

            hideText: {
                type: String,
                default: 'Hide'
            }
        }
    }
</script>