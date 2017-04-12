@extends('layouts.app')

@section('content')
    <form action="{{ route('shelf.update', ['id' => $shelf->id]) }}" role="form" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <h1>{!! trans('shelf.edit-title', ['shelf' => $shelf->name]) !!}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="shelf-name">{{ trans('shelf.name') }}</label>
            <input type="text" id="shelf-name" name="name" required autofocus value="{{ $shelf->name }}">
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('shelf.edit-button') }}
        </button>
    </form>
@endsection