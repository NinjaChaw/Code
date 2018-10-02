@extends('layouts.backend')

@section('title')
    {{ $asset->name }} :: {{ __('app.delete') }}
@endsection

@section('content')
    <div class="ui one column stackable grid container">
        <div class="column">
            <div class="ui {{ $inverted }} segment">
                <form  class="ui {{ $inverted }} form" method="POST" action="{{ route('backend.assets.destroy', $asset) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="ui large red submit icon button">
                        <i class="trash icon"></i>
                        {{ __('app.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection