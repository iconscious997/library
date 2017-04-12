@extends('layouts.app')

@section('content')
    <form action="{{ route('medium.store') }}" role="form" method="post">
        {{ csrf_field() }}

        <h1>{{ trans('medium.create-title') }}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="medium-name">{{ trans('medium.name') }}</label>
            <input type="text" id="medium-name" name="name" required autofocus>
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('medium.create-button') }}
        </button>
    </form>
@endsection