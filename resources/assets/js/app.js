
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

// make translation function __() available like in Laravel
window.__ = (string) => _.get(window.i18n, string);
// make config() function available like in Laravel
window.config = (string) => _.get(window.cfg, string);

Vue.component('assets-table',           require('./components/assets-table.vue'));
Vue.component('competition-trade',      require('./components/competition-trade.vue'));
Vue.component('competition-form',       require('./components/competition-form.vue'));
Vue.component('data-feed',              require('./components/data-feed.vue'));
Vue.component('image-upload-input',     require('./components/image-upload-input.vue'));
Vue.component('locale-select',          require('./components/locale-select.vue'));
Vue.component('log-out-button',         require('./components/log-out-button.vue'));
Vue.component('message',                require('./components/message.vue'));
Vue.component('loading-form',           require('./components/loading-form.vue'));

Vue.prototype.$eventBus = new Vue();

// global and the only one Vue instance
const app = new Vue({
    el: '#app'
});

// custom locale settings for numeral.js
numeral.register('locale', 'custom', {
    delimiters: {
        decimal: String.fromCharCode(config('settings.number_decimal_point')),
        thousands: String.fromCharCode(config('settings.number_thousands_separator'))
    },
    abbreviations: {
        thousand: 'k',
        million: 'm',
        billion: 'b',
        trillion: 't'
    },
    ordinal : function (number) {
        return '';
    },
    currency: {
        symbol: ''
    }
});
numeral.locale('custom');

if (!Number.prototype.integer) {
    Number.prototype.integer = function () {
        return numeral(this).format('0,0');
    };
}

if (!Number.prototype.decimal) {
    Number.prototype.decimal = function () {
        var num = numeral(this);
        var formatted = num.format('0,0.00');
        return formatted!=='NaN' ? formatted : parseFloat(this).toFixed(2);
    };
}

if (!Number.prototype.variableDecimal) {
    Number.prototype.variableDecimal = function () {
        var format;
        var num = numeral(this);
        var n = Math.abs(num.value());
        if (n >= 10) {
            format = '0,0.00';
        } else if (0.1 <= n && n < 10) {
            format = '0.0000';
        } else if (n < 0.1) {
            format = '0.00000000';
        }
        // for small numbers like  9.2e-7 numeral.format() will return NaN, so need a workaround
        var formatted = num.format(format);
        return formatted!=='NaN' ? formatted : parseFloat(this).toFixed(8);
    };
}

if (!Number.prototype.percentage) {
    Number.prototype.percentage = function () {
        return this.decimal()+'%';
    };
}

// Semantic UI controls initizalization
$('.ui.dropdown').dropdown();
$('.ui.checkbox').checkbox();
$('.ui.accordion').accordion();
$('.ui.popup-trigger').popup({ on: 'click' });
