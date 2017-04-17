@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($author->name))
        <header>
            <h2 class="section-title">{{ $author->name .' '.$author->surname }}</h2>
            <a href="{{ route('author.edit', ['id' => $author->id]) }}">{{ trans('author.edit-link') }}</a>
        </header>
    @endif

    @include('book.partials.list')
@endsection