<script>
    module.exports = {
        props: ['user', 'competition', 'asset'],
        data: function() {
            return {
                selectedAsset: {}, // currently selected asset symbol
                assets: {}, // assets in open trades
                error: null,
                input: {
                    volume: null
                },
                loading: {
                    openTrade: false,
                    closeTrades: []
                },
                openTrades: [],
                participants: [],
                participantsRefreshIntervalId: null
            }
        },
        computed: {
            // assets in open trades + currently selected asset
            subscriptionAssetsIds: function() {
                return _.union(_.map(this.openTrades, 'asset.id'), [this.selectedAsset.id]);
            },
            margin: function () {
                var volume = parseFloat(this.input.volume);
                return !isNaN(volume) && volume > 0
                        ? this.competition.lot_size * volume * this.assets[this.selectedAsset.symbol].price / this.competition.leverage
                        : -1;
            },
            _margin: function () {
                return this.margin.decimal();
            },
            balance: function () {
                if (this.participants.length) {
                    var participant = _.find(this.participants, (participant) => participant.user.id == this.user.id);
                    return participant.current_balance;
                }
                return 0;
            },
            _balance: function () {
                return this.balance.decimal();
            },
            totalMargin: function () {
                return this.openTrades.length ? _.sumBy(this.openTrades, 'margin') : 0;
            },
            _totalMargin: function () {
                return this.totalMargin.decimal();
            },
            freeMargin: function () {
                return this.equity - this.totalMargin;
            },
            _freeMargin: function () {
                return this.freeMargin.decimal();
            },
            marginLevel: function () {
                return this.equity / this.totalMargin * 100;
            },
            _marginLevel: function () {
                return this.marginLevel.percentage();
            },
            totalUnrealizedPnl: function () {
                return this.openTrades.length ? _.sumBy(this.openTrades, (trade) => this.unrealizedPnl(trade)) : 0;
            },
            _totalUnrealizedPnl: function () {
                return this.totalUnrealizedPnl.decimal();
            },
            equity: function () {
                return this.balance + this.totalUnrealizedPnl;
            },
            _equity: function() {
                return this.equity.decimal();
            }
        },
        methods: {
            getOpenTrades: function () {
                axios.get('/competitions/' + this.competition.id + '/trades')
                        .then((response) => {
                            if (response.status == 200) {
                                this.assets = _.assign(this.assets, _.fromPairs(_.map(response.data, (trade) => { return [trade.asset.symbol, trade.asset] })));
                                this.openTrades = response.data;
                            }
                        });
            },
            getParticipants: function () {
                axios.get('/competitions/' + this.competition.id + '/participants')
                        .then((response) => {
                            if (response.status == 200) {
                                this.participants = response.data;
                                // refresh data in 30 seconds
                                this.participantsRefreshIntervalId = setTimeout(() => this.getParticipants(), 30000);
                            }
                        });
            },
            unrealizedPnl: function(trade) {
                return trade.direction_sign * (this.assets[trade.asset.symbol].price - trade.price_open) * trade.lot_size * trade.volume;
            },
            openTrade: function (event) {
                this.loading.openTrade = true;
                var tradeDirection = parseInt(event.target.dataset.direction, 10);

                axios.post('/competitions/' + this.competition.id + '/assets/' + this.assets[this.selectedAsset.symbol].id + '/trade', {
                            direction:  tradeDirection,
                            volume:     this.input.volume
                        })
                        .then((response) => {
                            this.error = null;
                            this.loading.openTrade = false;
                            this.input.volume = null;
                            this.assets[response.data.asset.symbol] = response.data.asset;
                            // display new trade in the Open trades list
                            this.openTrades.unshift(response.data);
                        })
                        .catch((error) => {
                            this.error = typeof error.response.data.errors.volume != 'undefined' ? error.response.data.errors.volume.join(' | ') : error.response.data.message;
                            this.loading.openTrade = false;
                        });
            },
            closeTrade: function (event) {
                var tradeId = parseInt(event.target.dataset.id, 10);
                var tradeIndex = parseInt(event.target.dataset.index, 10);
                this.loading.closeTrades.push(tradeId);

                axios.post('/competitions/' + this.competition.id + '/trades/' + tradeId + '/close')
                        .then((response) => {
                            this.assets[response.data.asset.symbol] = response.data.asset;
                            // on success remove the trade from the list of open trades
                            this.openTrades.splice(tradeIndex, 1);
                            this.loading.closeTrades.splice(this.loading.closeTrades.indexOf(tradeId), 1);
                            clearTimeout(this.participantsRefreshIntervalId);
                            this.getParticipants();
                        })
                        .catch(function (error) {
                            this.loading.closeTrades.splice(this.loading.closeTrades.indexOf(tradeId), 1);
                        });
            }
        },
        watch: {
            subscriptionAssetsIds: function(ids) {
                if (config('settings.assets_quotes_api') == 'REST') {
                    this.$eventBus.$emit('market-data-subscription', ids);
                }
            }
        },
        created: function () {
            this.getOpenTrades();
            this.getParticipants();
        },
        mounted: function () {
            // save default (currenctly selected) asset
            this.selectedAsset = this.asset;
            this.assets[this.selectedAsset.symbol] = this.asset;

            // subscribe to new quotes
            this.$eventBus.$on('quote', (quote) => {
//                console.log(quote);
                if (typeof this.assets[quote.symbol] != 'undefined') {
                    this.assets[quote.symbol].price = quote.price;
                    if (this.selectedAsset.symbol == quote.symbol)
                        this.selectedAsset.price = quote.price;
                }
            });

            $('#asset-search')
                .search({
                    type: 'assets',
                    minCharacters: 2,
                    apiSettings: {
                        url: '/assets/search/{query}'
                    },
                    showNoResults: false, // hide no results message if nothing found
                    templates: {
                        assets: function (response) {
                            var html = '<div class="ui divided items">';
                            if (typeof response.results != 'undefined' && response.results.length) {
                                for (var i = 0; i < response.results.length; i++) {
                                    var asset = response.results[i];
                                    html +=
                                        '<div class="item">' +
                                        '   <img class="ui image" src="'+asset.logo_url+'">' +
                                        '   <div class="middle aligned content">' +
                                            // it's important to use .title class, so Semantic UI can take the value from there when specific asset is selected
                                        '       <div class="header symbol name title">' + asset.symbol + '</div>' +
                                        '       <div class="meta">' + asset.name + '</div>' +
                                        '   </div>' +
                                        '</div>';
                                }
                            }
                            html += '</div>';
                            return html;
                        }
                    },
                    onSelect: (asset, response) => {
                        this.selectedAsset = asset;
                        this.assets[this.selectedAsset.symbol] = asset;
                        // remember current symbol in session
                        axios.post('/assets/' + asset.id + '/remember');
                    },
                    selector: {
                        result: '.item'
                    }
                });
        }
    }
</script>