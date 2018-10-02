<template>
    <div class="ui top right pointing dropdown">
        <div class="text">
            <i :class="[locale.flag, 'flag']"></i>{{ locale.name }}
        </div>
        <div class="menu">
            <div v-for="(locale, code) in locales" class="item" @click="changeLocale(code)">
                <i :class="[locale.flag, 'flag']"></i>{{ locale.name }}
            </div>
        </div>
    </div>
</template>
<script>
    module.exports = {
        props: ['locales', 'locale'],
        methods: {
            changeLocale: function (code) {
                axios.post('/locale/' + code + '/remember').then(() => { location.reload(true) });
            }
        }
    }
</script>