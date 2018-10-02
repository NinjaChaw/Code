@extends('layouts.backend')

@section('title')
    {{ __('maintenance.maintenance') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui divided items">
                <div class="item">
                    <div class="content">
                        <span class="header">{{ __('maintenance.cache') }}</span>
                        <div class="description">
                            <p>{{ __('maintenance.cache_description') }}</p>
                        </div>
                        <div class="extra">
                            <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.maintenance.cache') }}">
                                {{ csrf_field() }}
                                <button class="ui {{ $settings->color }} submit button">{{ __('maintenance.clear_cache') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <span class="header">{{ __('maintenance.db_updates') }}</span>
                        <div class="description">
                            <p>{{ __('maintenance.db_updates_description') }}</p>
                        </div>
                        <div class="extra">
                            <form class="ui form" method="POST" action="{{ route('backend.maintenance.migrate') }}">
                                {{ csrf_field() }}
                                <button class="ui {{ $settings->color }} submit button">{{ __('maintenance.migrate') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <span class="header">{{ __('maintenance.cron') }}</span>
                        <div class="description">
                            <p>{{ __('maintenance.cron_description') }}</p>
                            <div class="ui {{ $settings->color }} message">
                                <pre>* * * * * php {{ base_path() }}/artisan schedule:run >> /dev/null 2>&1</pre>
                            </div>
                            <p>{{ __('maintenance.cron_description2') }}</p>
                        </div>
                        <div class="extra">
                            <form class="ui inline form" method="POST" action="{{ route('backend.maintenance.cron') }}">
                                {{ csrf_field() }}
                                <button class="ui {{ $settings->color }} submit button">{{ __('maintenance.run_cron') }}</button>
                            </form>
                            <form class="ui inline form" method="POST" action="{{ route('backend.maintenance.cron_assets_market_data') }}">
                                {{ csrf_field() }}
                                <button class="ui {{ $settings->color }} basic submit button">{{ __('maintenance.update_assets_market_data') }}</button>
                            </form>
                            <form class="ui inline form" method="POST" action="{{ route('backend.maintenance.cron_currencies_market_data') }}">
                                {{ csrf_field() }}
                                <button class="ui {{ $settings->color }} basic submit button">{{ __('maintenance.update_currencies_market_data') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection