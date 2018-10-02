@extends('layouts.install')

@section('title')
    Step 1
@endsection

@section('content')
    <div class="column">
        <p>Please input database settings below.</p>
        <form class="ui form" method="POST" action="{{ route('install.db') }}">
            {{ csrf_field() }}
            <div class="six wide field">
                <label>Database host</label>
                <input type="text" name="host" placeholder="host" value="{{ old('host', config('database.connections.mysql.host')) }}" required>
            </div>
            <div class="six wide field">
                <label>Database port</label>
                <input type="text" name="port" placeholder="port" value="{{ old('port', config('database.connections.mysql.port')) }}" required>
            </div>
            <div class="six wide field">
                <label>Database name</label>
                <input type="text" name="name" placeholder="name" value="{{ old('name', config('database.connections.mysql.database')) }}" required>
            </div>
            <div class="six wide field">
                <label>Database username</label>
                <input type="text" name="username" placeholder="username" value="{{ old('username', config('database.connections.mysql.username')) }}" required>
            </div>
            <div class="six wide field">
                <label>Database password</label>
                <input type="password" name="password" placeholder="password" value="{{ old('password', config('database.connections.mysql.password')) }}" required>
            </div>
            <button class="ui teal submit button">Next</button>
        </form>
    </div>
@endsection