<template>
    <div class="field">
        <label>
            <slot></slot>
        </label>
        <div class="ui image image-file-container">
            <label for="image-file-input">
                <img v-if="image" :src="image">
                <img v-else :src="image">
            </label>
            <label for="image-file-input" :class="[color, 'ui basic icon button']">
                <i class="image outline icon"></i>
            </label>
            <button :class="[{ disabled: image == defaultImageUrl }, 'ui basic red icon button']" @click.prevent="clearImage">
                <i class="trash icon"></i>
            </button>
            <input id="image-file-input" type="file" :name="name" value="" @change="previewImage" accept="image/*">
            <input type="hidden" name="deleted" :value="deleted">
        </div>
    </div>
</template>
<script>
    module.exports = {
        props: ['name', 'color', 'imageUrl', 'defaultImageUrl'],
        data: function() {
            return {
                image: this.imageUrl || this.defaultImageUrl,
                deleted: false
            }
        },
        methods: {
            previewImage: function(event) {
                this.deleted = false;
                var input = event.target;
                // Ensure that you have a file before attempting to read it
                if (input.files && input.files[0]) {
                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.image" refers to the image of Vue component
                        // Read image as base64 and set to imageData
                        this.image = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                }
            },
            clearImage: function () {
                this.image = this.defaultImageUrl;
                this.deleted = true;
            }
        }
    }
</script>