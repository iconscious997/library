@extends('layouts.app')

@section('content-class', 'single')

@section('content')
    <h2 class="section-title">{{ $book->name }}</h2>

    @if(Auth::check() && Auth::user()->verified)
    <section class="edit-book">
        <a href="{{ route('book.edit', ['id' => $book->id]) }}">{{ trans('book.edit-link') }}</a>
    </section>
    @endif

    <p>{{ $book->description }}</p>

    <ul>
        <li>
            <strong>{{ trans('book.author') }}:</strong>
            @php
                $authorfSeparated = [];
                foreach($book->authors as $author) {
                    $authorfSeparated[] = '<a href="'
                    . route('author.show', ['slug' => $author->slug])
                    . '">'
                    .$author->name
                    .' '
                    . $author->surname
                    . '</a>';
                }

                echo implode(', ', $authorfSeparated);
            @endphp
        </li>
        <li>
            <strong>{{ trans('book.isbn') }}:</strong>
            {{ $book->isbn }}
        </li>
        <li>
            <strong>{{ trans('book.year') }}:</strong>
            {{ $book->year }}
        </li>
        @if(Auth::check() && Auth::user()->verified)
        <li>
            <strong>{{ trans('book.medium') }}:</strong>
            <a href="{{ route('medium.show', ['slug' => $book->medium->slug]) }}">{{ $book->medium->name }}</a>
        </li>
        <li>
            <strong>{{ trans('book.shelf') }}:</strong>
            @php
                $shelfSeparated = [];
                foreach($book->shelves as $shelf) {
                    $shelfSeparated[] = '<a href="'
                    . route('shelf.show', ['slug' => $shelf->slug])
                    . '">'
                    . $shelf->name
                    . '</a>';
                }

                echo implode(', ', $shelfSeparated);
            @endphp
        </li>
        @endif
    </ul>

    <h3>{{ trans('book.tags') }}</h3>
    @foreach($book->tags as $tag)
        <a href="{{ route('tag.show', ['slug' => $tag->slug]) }}" class="tag">{{ $tag->name }}</a>
    @endforeach
@endsection