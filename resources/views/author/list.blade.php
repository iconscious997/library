@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($author->name))
        <header>
            <h2 class="section-title">{{ $author->name .' '.$author->surname }}</h2>
            @if(Auth::check() && Auth::user()->verified)
                <a href="{{ route('author.edit', ['id' => $author->id]) }}">{{ trans('author.edit-link') }}</a>
            @endif
        </header>
    @endif

    @include('book.partials.list')
@endsection