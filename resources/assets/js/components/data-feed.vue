<template></template>
<script>
    module.exports = {
        data: function () {
            return {
                intervalId: null,
                subscriptionAssetsIds: []
            }
        },
        methods: {
            changeAbs: function (price, changePct) {
                return price * (1 + changePct/100) - price;
            },
            pullMarketData: function() {
                axios.post('/assets/info', {
                        ids: this.subscriptionAssetsIds
                    }).then((response) => {
                        _.forEach(response.data, (asset) => {
                            this.$eventBus.$emit('quote', {
                                symbol:                     asset.symbol,
                                price:                      asset.price,
                                change_pct:                 asset.change_pct,
                                change_abs:                 asset.change_abs,
                                supply:                     asset.supply,
                                market_cap:                 asset.market_cap,
                                volume:                     asset.volume
                            });
                        });                        
                    }).catch((error) => {});
            }
        },
        mounted: function () {
            // REST API, pull quotes every X seconds
            if (config('settings.assets_quotes_api') == 'REST') {
                this.$eventBus.$on('market-data-subscription', (ids) => {
                    this.subscriptionAssetsIds = _.uniq(ids);
                });
                this.intervalId = setInterval(() => this.pullMarketData(), Math.max(1000, config('settings.assets_quotes_refresh_freq') * 1000));

            // WebSocket API => subscribe to quotes updates
            } else {
                var socket = io.connect('https://coincap.io');
                socket.on('trades', (message) => {
                    if (typeof message.msg != 'undefined') {
                        this.$eventBus.$emit('quote', {
                            symbol:                     message.msg.short,
                            price:                      message.msg.price,
                            change_pct:                 message.msg.perc,
                            change_abs:                 this.changeAbs(message.msg.price, message.msg.perc),
                            supply:                     message.msg.supply,
                            market_cap:                 message.msg.mktcap,
                            market_cap_change_pct:      message.msg.cap24hrChange,
                            volume:                     message.msg.volume
                        });
                    }
                });
            }
        }
    }
</script>