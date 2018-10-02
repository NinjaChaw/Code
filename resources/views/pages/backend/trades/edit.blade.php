@extends('layouts.backend')

@section('title')
    {{ __('app.trade') }} {{ $trade->id }} :: {{ __('app.edit') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form">
                    <div class="field">
                        <label>{{ __('app.competition') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->competition->title }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.asset') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->asset->symbol }} &mdash; {{ $trade->asset->name }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.currency') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->currency->code }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.buy_sell') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ __('app.trade_direction_' . $trade->direction) }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.lot_size') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->lot_size }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.volume') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->volume }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.open_price') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->price_open }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.close_price') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->price_close }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.margin') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->margin }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.pnl') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->pnl }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.created_at') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->created_at }} ({{ $trade->created_at->diffForHumans() }})" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.closed_at') }}</label>
                        <div class="ui input">
                            <input type="text" value="{{ $trade->closed_at ? $trade->closed_at . '(' . $trade->closed_at->diffForHumans() . ')' : '' }}" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.created_by') }}</label>
                        <div class="ui input">
                            <input value="{{ $trade->user->name }}" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="{{ route('backend.trades.index') }}"><i class="left arrow icon"></i> {{ __('app.back_all_trades') }}</a>
        </div>
    </div>
@endsection