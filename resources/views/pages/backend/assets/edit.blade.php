@extends('layouts.backend')

@section('title')
    {{ $asset->name }} :: {{ __('app.edit') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.assets.update', $asset) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <image-upload-input name="logo" image-url="{{ $asset->logo_url }}" default-image-url="{{ asset('images/asset.png') }}" class="{{ $errors->has('logo') ? 'error' : '' }}" color="{{ $settings->color }}">
                        {{ __('app.logo') }}
                    </image-upload-input>
                    <div class="field {{ $errors->has('symbol') ? 'error' : '' }}">
                        <label>{{ __('app.symbol') }}</label>
                        <div class="ui input">
                            <input type="text" name="symbol" placeholder="{{ __('app.symbol') }}" value="{{ old('symbol', $asset->symbol) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                        <label>{{ __('app.name') }}</label>
                        <div class="ui input">
                            <input type="text" name="name" placeholder="{{ __('app.name') }}" value="{{ old('name', $asset->name) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('price') ? 'error' : '' }}">
                        <label>{{ __('app.price') }}</label>
                        <div class="ui input">
                            <input type="text" name="price" placeholder="{{ __('app.price') }}" value="{{ old('price', $asset->price) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('change_abs') ? 'error' : '' }}">
                        <label>{{ __('app.change_abs') }}</label>
                        <div class="ui input">
                            <input type="text" name="change_abs" placeholder="{{ __('app.change_abs') }}" value="{{ old('change_abs', $asset->change_abs) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('change_pct') ? 'error' : '' }}">
                        <label>{{ __('app.change_pct') }}</label>
                        <div class="ui input">
                            <input type="text" name="change_pct" placeholder="{{ __('app.change_pct') }}" value="{{ old('change_pct', $asset->change_pct) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('volume') ? 'error' : '' }}">
                        <label>{{ __('app.volume') }}</label>
                        <div class="ui input">
                            <input type="text" name="volume" placeholder="{{ __('app.volume') }}" value="{{ old('volume', $asset->volume) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('supply') ? 'error' : '' }}">
                        <label>{{ __('app.supply') }}</label>
                        <div class="ui input">
                            <input type="text" name="supply" placeholder="{{ __('app.supply') }}" value="{{ old('supply', $asset->supply) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('market_cap') ? 'error' : '' }}">
                        <label>{{ __('app.market_cap') }}</label>
                        <div class="ui input">
                            <input type="text" name="market_cap" placeholder="{{ __('app.market_cap') }}" value="{{ old('market_cap', $asset->market_cap) }}" required autofocus>
                        </div>
                    </div>
                    <div class="field {{ $errors->has('status') ? 'error' : '' }}">
                        <label>{{ __('app.status') }}</label>
                        <div id="asset-status-dropdown" class="ui selection dropdown">
                            <input type="hidden" name="status">
                            <i class="dropdown icon"></i>
                            <div class="default text"></div>
                            <div class="menu">
                                <div class="item" data-value="{{ App\Models\Asset::STATUS_ACTIVE }}"><i class="grey check icon"></i> {{ __('app.asset_status_'.App\Models\Asset::STATUS_ACTIVE) }}</div>
                                <div class="item" data-value="{{ App\Models\Asset::STATUS_BLOCKED }}"><i class="grey ban icon"></i> {{ __('app.asset_status_'.App\Models\Asset::STATUS_BLOCKED) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.created_at') }}</label>
                        <div class="ui input">
                            <input value="{{ $asset->created_at }} ({{ $asset->created_at->diffForHumans() }})" disabled>
                        </div>
                    </div>
                    <div class="field">
                        <label>{{ __('app.updated_at') }}</label>
                        <div class="ui input">
                            <input value="{{ $asset->updated_at }} ({{ $asset->updated_at->diffForHumans() }})" disabled>
                        </div>
                    </div>
                    <button class="ui large {{ $settings->color }} submit button">
                        <i class="save icon"></i>
                        {{ __('app.save') }}
                    </button>
                    <a href="{{ route('backend.assets.delete', $asset) }}" class="ui large red submit right floated icon button">
                        <i class="trash icon"></i>
                        {{ __('app.delete') }}
                    </a>
                </form>
            </div>
        </div>
        <div class="column">
            <a href="{{ route('backend.assets.index') }}"><i class="left arrow icon"></i> {{ __('app.back_all_assets') }}</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#asset-status-dropdown').dropdown('set selected', '{{ old('status', $asset->status) }}');
    </script>
@endpush