@extends('layouts.backend')

@section('title')
    {{ __('settings.addons') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        @foreach($packages as $package)
            <div class="column">
                <div class="ui {{ $package->installed ? 'green' : '' }} segment">
                    <h2 class="ui dividing header">{{ $package->name }}</h2>
                    <p>
                        {{ $package->description }}
                    </p>
                    <div>
                        @if($package->installed)
                            <button class="ui icon basic {{ $settings->color }} disabled button">
                                <i class="green checkmark icon"></i>
                                {{ __('settings.installed') }}
                            </button>
                            <span class="ui large basic label">{{ $package->version }}</span>
                        @else
                            <a href="{{ $package->purchase_url }}" class="ui {{ $settings->color }} button" target="_blank">{{ __('settings.purchase') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection