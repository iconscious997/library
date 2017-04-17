@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($publisher->name))
        <header>
            <h2 class="section-title">{{ $publisher->name }}</h2>
            <a href="{{ route('publisher.edit', ['id' => $publisher->id]) }}">{{ trans('publisher.edit-link') }}</a>
        </header>
    @endif

    @include('book.partials.list')
@endsection