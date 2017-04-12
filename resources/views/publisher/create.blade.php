@extends('layouts.app')

@section('content')
    <form action="{{ route('publisher.store') }}" role="form" method="post">
        {{ csrf_field() }}

        <h1>{{ trans('publisher.create-title') }}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="publisher-name">{{ trans('publisher.name') }}</label>
            <input type="text" id="publisher-name" name="name" placeholder="Required" required autofocus>
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="publisher-location">{{ trans('publisher.location') }}</label>
            <input type="text" id="publisher-location" name="location">
            @if ($errors->has('location'))
                <div class="error-text">
                    {{ $errors->first('location') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('publisher.create-button') }}
        </button>
    </form>
@endsection