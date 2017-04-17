@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($publisher->name))
        <header>
            <h2 class="section-title">{{ $publisher->name }}</h2>
            @if(Auth::check() && Auth::user()->verified)
                <a href="{{ route('publisher.edit', ['id' => $publisher->id]) }}">{{ trans('publisher.edit-link') }}</a>
            @endif
        </header>
    @endif

    @include('book.partials.list')
@endsection