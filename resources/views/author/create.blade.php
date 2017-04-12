@extends('layouts.app')

@section('content')
    <form action="{{ route('author.store') }}" role="form" method="post">
        {{ csrf_field() }}

        <h1>{{ trans('author.create-title') }}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="author-name">{{ trans('author.name') }}</label>
            <input type="text" id="author-name" name="name" required autofocus>
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="author-surname">{{ trans('author.surname') }}</label>
            <input type="text" id="author-surname" name="surname" required>
            @if ($errors->has('surname'))
                <div class="error-text">
                    {{ $errors->first('surname') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('author.create-button') }}
        </button>
    </form>
@endsection