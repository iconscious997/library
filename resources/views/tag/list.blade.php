@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($tag->name))
        <header>
            <h2 class="section-title">{{ $tag->name }}</h2>
            @if(Auth::check() && Auth::user()->verified)
                <a href="{{ route('tag.edit', ['id' => $tag->id]) }}">{{ trans('tag.edit-link') }}</a>
            @endif
            <p>{{ $tag->description or ' ' }}</p>
        </header>
    @endif

    @include('book.partials.list')
@endsection