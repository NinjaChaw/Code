<template>
    <div v-show="!hidden" class="ui message">
        <i class="close icon" @click="hide"></i>
        <div class="header">
            <slot></slot>
        </div>
        <ul v-if="messages" v-for="item in messages" class="list">
            <li>{{ item }}</li>
        </ul>
        <p v-if="message">
            {{ message }}
        </p>
    </div>
</template>
<script>
    module.exports = {
        props: ['message','messages'],
        data: function () {
            return {
                hidden: false
            }
        },
        methods: {
            hide: function () {
                this.hidden = true;
            }
        }
    }
</script>