@extends('layouts.app')

@section('content')
    <form action="{{ route('tag.update', ['id' => $tag->id]) }}" role="form" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <h1>{!! trans('tag.edit-title', ['tag' => $tag->name]) !!}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="tag-name">{{ trans('tag.name') }}</label>
            <input type="text" id="tag-name" name="name" required autofocus value="{{ $tag->name }}">
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="tag-description">{{ trans('tag.description') }}</label>
            <textarea name="description" id="tag-description" cols="30" rows="10">{{ $tag->description }}</textarea>
            @if ($errors->has('description'))
                <div class="error-text">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>

        <button>
            {{ trans('tag.edit-button') }}
        </button>
    </form>
@endsection