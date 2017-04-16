@extends('layouts.app')

@section('content-class', 'single')

@section('content')
    <h2 class="section-title">{{ $book->name }}</h2>

    <p>{{ $book->description }}</p>

    <ul>
        <li>
            <strong>{{ trans('book.author') }}:</strong>
            @foreach($book->authors as $author)
                <a href="{{ route('author.show', ['slug' => $author->slug]) }}">{{ $author->name .' '. $author->surname }}</a>
            @endforeach
        </li>
        <li>
            <strong>{{ trans('book.isbn') }}:</strong>
            {{ $book->isbn }}
        </li>
        <li>
            <strong>{{ trans('book.year') }}:</strong>
            {{ $book->year }}
        </li>
        <li>
            <strong>{{ trans('book.medium') }}:</strong>
            <a href="{{ route('medium.show', ['slug' => $book->medium->slug]) }}">{{ $book->medium->name }}</a>
        </li>
        <li>
            <strong>{{ trans('book.shelf') }}:</strong>
            @foreach($book->shelves as $shelf)
                <a href="{{  route('shelf.show', ['slug' => $shelf->slug]) }}">{{ $shelf->name }}</a>
            @endforeach
        </li>
    </ul>

    <h3>{{ trans('book.tags') }}:</h3>
    @foreach($book->tags as $tag)
        <a href="{{ route('tag.show', ['slug' => $tag->slug]) }}" class="tag">{{ $tag->name }}</a>
    @endforeach
@endsection