@extends('layouts.backend')

@section('title')
    {{ $user->name }} :: {{ __('users.delete') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form  class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.users.destroy', $user) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="ui large red submit icon button">
                        <i class="trash icon"></i>
                        {{ __('users.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection