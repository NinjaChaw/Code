@extends('layouts.install')

@section('title')
    Step 3
@endsection

@section('content')
    <div class="column">
        <p>
            Admin user is successfully created. Current market data will not be retrieved from CoinCap API.
            Please be patient, it might take some time.
        </p>
        <form class="ui form" method="POST" action="{{ route('install.step4') }}">
            {{ csrf_field() }}
            <button class="ui teal submit button">Next</button>
        </form>
    </div>
@endsection