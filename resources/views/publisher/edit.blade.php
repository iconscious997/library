@extends('layouts.app')

@section('content')
    <form action="{{ route('publisher.update', ['id' => $publisher->id]) }}" role="form" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <h1>{!! trans('publisher.edit-title', ['publisher' => $publisher->name]) !!}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="publisher-name">{{ trans('publisher.name') }}</label>
            <input type="text" id="publisher-name" name="name" required autofocus value="{{ $publisher->name }}">
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="publisher-location">{{ trans('publisher.location') }}</label>
            <input type="text" id="publisher-location" name="location" value="{{ $publisher->location }}">
            @if ($errors->has('location'))
                {{ $errors->first('location') }}
            @endif
        </div>

        <button>
            {{ trans('publisher.edit-button') }}
        </button>
    </form>
@endsection