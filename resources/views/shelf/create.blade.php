@extends('layouts.app')

@section('content')
    <form action="{{ route('shelf.store') }}" role="form" method="post">
        {{ csrf_field() }}

        <h1>{{ trans('shelf.create-title') }}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="shelf-name">{{ trans('shelf.name') }}</label>
            <input type="text" id="shelf-name" name="name" placeholder="Required" required autofocus>
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('shelf.create-button') }}
        </button>
    </form>
@endsection