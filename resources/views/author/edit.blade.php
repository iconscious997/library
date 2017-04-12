@extends('layouts.app')

@section('content')
    <form action="{{ route('author.update', ['id' => $author->id]) }}" role="form" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <h1>{!! trans('author.edit-title', ['author' => $author->name.' '.$author->surname]) !!}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="author-name">{{ trans('author.name') }}</label>
            <input type="text" id="author-name" name="name" required autofocus value="{{ $author->name }}">
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="author-surname">{{ trans('author.surname') }}</label>
            <input type="text" id="author-surname" name="surname" required value="{{ $author->surname }}">
            @if ($errors->has('surname'))
                <div class="error-text">
                    {{ $errors->first('surname') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('author.edit-button') }}
        </button>
    </form>
@endsection