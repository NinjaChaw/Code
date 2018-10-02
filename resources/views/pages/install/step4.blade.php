@extends('layouts.install')

@section('title')
    Completed
@endsection

@section('content')
    <div class="column">
        <p>Congratulations! Installation is completed and <b>{{ __('app.app_name') }}</b> is now up and running.</p>
        <p>
            In order to have necessary application services (such as market data refresh) run automatically in background
            please set up the following cron job:
        </p>
        <div class="ui teal message">
            <pre>* * * * * php {{ base_path() }}/artisan schedule:run >> /dev/null 2>&1</pre>
        </div>
        <div class="ui hidden divider"></div>
        <a href="{{ route('frontend.index') }}" class="ui teal button" target="_blank">Front page</a>
        <a href="{{ route('login') }}" class="ui teal button" target="_blank">Log in</a>
    </div>
@endsection