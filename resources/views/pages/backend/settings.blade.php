@extends('layouts.backend')

@section('title')
    {{ __('settings.settings') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.settings.update') }}">
                {{ csrf_field() }}
                <div class="ui {{ $inverted ? 'inverted' : 'styled' }} fluid accordion">
                    <div class="title">
                        <i class="dropdown icon"></i>
                        {{ __('settings.main') }}
                    </div>
                    <div class="content">
                        <div class="field">
                            <label>{{ __('settings.background') }}</label>
                            <div id="background-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="BACKGROUND">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($backgrounds as $background)
                                        <div class="item" data-value="{{ $background }}">
                                            {{ __('settings.color_'.$background) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('settings.color') }}</label>
                            <div id="color-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="COLOR">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($colors as $color)
                                        <div class="item" data-value="{{ $color }}">
                                            <i class="{{ $color }} square full icon"></i>
                                            {{ __('settings.color_'.$color) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('settings.default_locale') }}</label>
                            <div id="locale-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="LOCALE">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($locales as $code => $locale)
                                        <div class="item" data-value="{{ $code }}">
                                            <i class="{{ $locale->flag }} flag"></i>
                                            {{ $locale->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('app.currency') }}</label>
                            <div id="currency-dropdown" class="ui selection search dropdown">
                                <input type="hidden" name="CURRENCY">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($currencies as $currency)
                                        <div class="item" data-value="{{ $currency->code }}">{{ $currency->code }} &mdash; {{ $currency->name }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        {{ __('settings.number_formatting') }}
                    </div>
                    <div class="content">
                        <div class="field">
                            <label>{{ __('settings.number_decimals') }}</label>
                            <div id="number-decimals-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="NUMBER_DECIMALS">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach([0,1,2,3,4,5,6,7,8] as $digit)
                                        <div class="item">
                                            {{ $digit }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('settings.number_decimal_point') }}</label>
                            <div id="number-decimal-point-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="NUMBER_DECIMAL_POINT">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($separators as $code => $separator)
                                        <div class="item" data-value="{{ $code }}">
                                            {{ $separator }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('settings.number_thousands_separator') }}</label>
                            <div id="number-thousands-separator-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="NUMBER_THOUSANDS_SEPARATOR">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($separators as $code => $separator)
                                        <div class="item" data-value="{{ $code }}">
                                            {{ $separator }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        {{ __('settings.email') }}
                    </div>
                    <div class="content">
                        <div class="field">
                            <label>{{ __('settings.mail_driver') }}</label>
                            <div id="mail-driver-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="MAIL_DRIVER">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <div class="item">smtp</div>
                                    <div class="item">sendmail</div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('settings.smtp_server') }}</label>
                            <input type="text" name="MAIL_HOST" value="{{ config('mail.host') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.smtp_port') }}</label>
                            <input type="text" name="MAIL_PORT" value="{{ config('mail.port') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.smtp_mail_from') }}</label>
                            <input type="text" name="MAIL_FROM_ADDRESS" value="{{ config('mail.from.address') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.smtp_username') }}</label>
                            <input type="text" name="MAIL_USERNAME" value="{{ config('mail.username') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.smtp_password') }}</label>
                            <input type="password" name="MAIL_PASSWORD" value="{{ config('mail.password') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.smtp_encryption') }}</label>
                            <div id="mail-encryption-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="MAIL_ENCRYPTION">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <div class="item" data-value="">{{ __('settings.none') }}</div>
                                    <div class="item" data-value="tls">TLS</div>
                                    <div class="item" data-value="ssl">SSL</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        {{ __('settings.points_system') }}
                    </div>
                    <div class="content">
                        <div class="field">
                            <label>{{ __('settings.points_type_trade_loss') }}</label>
                            <input type="text" name="POINTS_TYPE_TRADE_LOSS" value="{{ config('settings.points_type_trade_loss') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.points_type_trade_profit') }}</label>
                            <input type="text" name="POINTS_TYPE_TRADE_PROFIT" value="{{ config('settings.points_type_trade_profit') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.points_type_competition_join') }}</label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_JOIN" value="{{ config('settings.points_type_competition_join') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.points_type_competition_place1') }}</label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_PLACE1" value="{{ config('settings.points_type_competition_place1') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.points_type_competition_place2') }}</label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_PLACE2" value="{{ config('settings.points_type_competition_place2') }}">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.points_type_competition_place3') }}</label>
                            <input type="text" name="POINTS_TYPE_COMPETITION_PLACE3" value="{{ config('settings.points_type_competition_place3') }}">
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        {{ __('settings.integration') }}
                    </div>
                    <div class="content">
                        <div class="field">
                            <label>{{ __('settings.openexchangerates_api_key') }}</label>
                            <input type="text" name="OPENEXCHANGERATES_API_KEY" value="{{ config('settings.openexchangerates_api_key') }}" placeholder="8d35458771084ae391be6959d1c4d10f">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.gtm_container_id') }}</label>
                            <input type="text" name="GTM_CONTAINER_ID" value="{{ config('settings.gtm_container_id') }}" placeholder="GTM-XXXXXXX">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.adsense_client_id') }}</label>
                            <input type="text" name="ADSENSE_CLIENT_ID" value="{{ config('settings.adsense_client_id') }}" placeholder="ca-pub-1234567890">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.adsense_top_slot_id') }}</label>
                            <input type="text" name="ADSENSE_TOP_SLOT_ID" value="{{ config('settings.adsense_top_slot_id') }}" placeholder="505123456">
                        </div>
                        <div class="field">
                            <label>{{ __('settings.adsense_bottom_slot_id') }}</label>
                            <input type="text" name="ADSENSE_BOTTOM_SLOT_ID" value="{{ config('settings.adsense_bottom_slot_id') }}" placeholder="505123456">
                        </div>
                        @foreach(['facebook','google','twitter','linkedin'] as $provider)
                            <div class="field">
                                <label>{{ __('settings.social_'.$provider.'_client_id') }}</label>
                                <input type="text" name="{{ strtoupper($provider) }}_CLIENT_ID" value="{{ config('services.'.$provider.'.client_id') }}">
                            </div>
                            <div class="field">
                                <label>{{ __('settings.social_'.$provider.'_client_secret') }}</label>
                                <input type="text" name="{{ strtoupper($provider) }}_CLIENT_SECRET" value="{{ config('services.'.$provider.'.client_secret') }}">
                            </div>
                            <div class="disabled field">
                                <label>{{ __('settings.social_'.$provider.'_redirect') }}</label>
                                <input type="text" value="{{ config('services.'.$provider.'.redirect') }}">
                            </div>
                        @endforeach
                        <div class="field">
                            <label>{{ __('settings.assets_api_type') }}</label>
                            <div id="assets-api-type-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="ASSETS_QUOTES_API">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($api_types as $api_type)
                                        <div class="item" data-value="{{ $api_type }}">
                                            {{ __('settings.assets_api_type_'.$api_type) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        {{ __('settings.developer') }}
                    </div>
                    <div class="content">
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="hidden" name="APP_DEBUG" value="false">
                                <input type="checkbox" name="APP_DEBUG" {{ config('app.debug') ? 'checked="checked"' : '' }} tabindex="0" class="hidden" value="true">
                                <label>{{ __('settings.debug') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <label>{{ __('settings.log_level') }}</label>
                            <div id="log-level-dropdown" class="ui selection dropdown">
                                <input type="hidden" name="APP_LOG_LEVEL">
                                <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    @foreach($log_levels as $log_level)
                                        <div class="item">
                                            {{ $log_level }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @packageview('pages.backend.settings')

                </div>
                <div class="ui hidden divider"></div>
                <button class="ui large {{ $settings->color }} submit button">
                    <i class="save icon"></i>
                    {{ __('settings.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#background-dropdown').dropdown('set selected', '{{ config('settings.background') }}');
        $('#color-dropdown').dropdown('set selected', '{{ config('settings.color') }}');
        $('#locale-dropdown').dropdown('set selected', '{{ env('LOCALE', 'en') }}');
        $('#currency-dropdown').dropdown('set selected', '{{ config('settings.currency') }}');
        $('#mail-driver-dropdown').dropdown('set selected', '{{ config('mail.driver') }}');
        $('#mail-encryption-dropdown').dropdown('set selected', '{{ config('mail.encryption') }}');
        $('#number-decimals-dropdown').dropdown('set selected', '{{ config('settings.number_decimals') }}');
        $('#number-decimal-point-dropdown').dropdown('set selected', '{{ config('settings.number_decimal_point') }}');
        $('#number-thousands-separator-dropdown').dropdown('set selected', '{{ config('settings.number_thousands_separator') }}');
        $('#log-level-dropdown').dropdown('set selected', '{{ config('app.log_level') }}');
        $('#assets-api-type-dropdown').dropdown('set selected', '{{ config('settings.assets_quotes_api') }}');
    </script>
@endpush