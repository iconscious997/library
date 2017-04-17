@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($medium->name))
        <header>
            <h2 class="section-title">{{ $medium->name }}</h2>
        </header>
    @endif

    @include('book.partials.list')
@endsection