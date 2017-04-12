@extends('layouts.app')

@section('content')
    <form action="{{ route('medium.update', ['id' => $medium->id]) }}" role="form" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <h1>{!! trans('medium.edit-title', ['medium' => $medium->name]) !!}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="medium-name">{{ trans('medium.name') }}</label>
            <input type="text" id="medium-name" name="name" required autofocus value="{{ $medium->name }}">
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('medium.edit-button') }}
        </button>
    </form>
@endsection