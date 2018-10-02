<template>
    <a @click.prevent="logout">
        <slot></slot>
        <form ref="form" method="POST" action="/logout">
            <input type="hidden" name="_token" :value="token">
        </form>
    </a>
</template>
<script>
    module.exports = {
        props: ['token'],
        methods: {
            logout: function () {
                this.$refs.form.submit();
            }
        }
    }
</script>