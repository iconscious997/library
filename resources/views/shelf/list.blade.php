@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($shelf->name))
        <header>
            <h2 class="section-title">{{ $shelf->name }}</h2>
            <a href="{{ route('shelf.edit', ['id' => $shelf->id]) }}">{{ trans('shelf.edit-link') }}</a>
        </header>
    @endif

    @include('book.partials.list')
@endsection