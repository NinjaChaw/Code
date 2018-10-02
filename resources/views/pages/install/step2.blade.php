@extends('layouts.install')

@section('title')
    Step 2
@endsection

@section('content')
    <div class="column">
        <p>Database is successfully set up! Please input admin user details below.</p>
        <form class="ui form" method="POST" action="{{ route('install.step3') }}">
            {{ csrf_field() }}
            <div class="six wide field">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
            </div>
            <div class="six wide field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>
            <div class="six wide field">
                <label>Password</label>
                <input type="password" name="password" placeholder="password" value="{{ old('password') }}" required>
            </div>
            <button class="ui teal submit button">Next</button>
        </form>
    </div>
@endsection