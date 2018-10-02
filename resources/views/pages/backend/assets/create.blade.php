@extends('layouts.backend')

@section('title')
    {{ __('app.assets') }} :: {{ __('app.create') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.assets.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <image-upload-input name="logo" default-image-url="{{ asset('images/asset.png') }}" class="{{ $errors->has('logo') ? 'error' : '' }}" color="{{ $settings->color }}">
                        {{ __('app.logo') }}
                    </image-upload-input>
                    <div class="field {{ $errors->has('symbol') ? 'error' : '' }}">
                        <label>{{ __('app.symbol') }}</label>
                        <div class="ui input">
                            <input type="text" name="symbol" placeholder="{{ __('app.symbol') }}" value="{{ old('symbol') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                        <label>{{ __('app.name') }}</label>
                        <div class="ui input">
                            <input type="text" name="name" placeholder="{{ __('app.name') }}" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('price') ? 'error' : '' }}">
                        <label>{{ __('app.price') }}</label>
                        <div class="ui input">
                            <input type="text" name="price" placeholder="{{ __('app.price') }}" value="{{ old('price') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('change_abs') ? 'error' : '' }}">
                        <label>{{ __('app.change_abs') }}</label>
                        <div class="ui input">
                            <input type="text" name="change_abs" placeholder="{{ __('app.change_abs') }}" value="{{ old('change_abs') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('change_pct') ? 'error' : '' }}">
                        <label>{{ __('app.change_pct') }}</label>
                        <div class="ui input">
                            <input type="text" name="change_pct" placeholder="{{ __('app.change_pct') }}" value="{{ old('change_pct') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('volume') ? 'error' : '' }}">
                        <label>{{ __('app.volume') }}</label>
                        <div class="ui input">
                            <input type="text" name="volume" placeholder="{{ __('app.volume') }}" value="{{ old('volume') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('supply') ? 'error' : '' }}">
                        <label>{{ __('app.supply') }}</label>
                        <div class="ui input">
                            <input type="text" name="supply" placeholder="{{ __('app.supply') }}" value="{{ old('supply') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('market_cap') ? 'error' : '' }}">
                        <label>{{ __('app.market_cap') }}</label>
                        <div class="ui input">
                            <input type="text" name="market_cap" placeholder="{{ __('app.market_cap') }}" value="{{ old('market_cap') }}" required autofocus>
                        </div>
                    </div>
                    <button class="ui large {{ $settings->color }} submit button">
                        <i class="save icon"></i>
                        {{ __('app.save') }}
                    </button>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="{{ route('backend.assets.index') }}"><i class="left arrow icon"></i> {{ __('app.back_all_assets') }}</a>
        </div>
    </div>
@endsection