@extends('layouts.app')

@section('content-class', 'single')

@section('content')
    <h2 class="section-title">{{ $book->name }}</h2>

    <section id="book-details">
        @if(isset($book->cover))
            <section id="book-cover">
                <img src="{{ $book->cover }}" alt="Book cover: {{ $book->name }}">
            </section>
        @endif

        <section id="book-descripton">
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
                    <strong>{{ trans('book.publisher') }}:</strong>
                    <a href="{{ route('publisher.show', ['slug' => $book->publisher->slug]) }}">
                        {{ $book->publisher->name }}
                    </a>
                </li>
                <li>
                    <strong>{{ trans('book.year') }}:</strong>
                    {{ $book->published_at or $book->year }}
                </li>
                <li>
                    <strong>{{ trans('book.pages') }}:</strong>
                    {{ $book->page_count }} s.
                </li>
                @if($book->isbn)
                <li>
                    <strong>{{ trans('book.isbn') }}:</strong>
                    {{ $book->isbn }}
                </li>
                @endif
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
                    <li class="link-section">
                        @if(isset($book->google_link))
                            <a href="{{ $book->google_link }}">{{ trans('book.read_on_google') }}</a>
                            <br>
                        @endif
                        @if(Auth::check() && Auth::user()->verified)
                            <a href="{{ route('book.edit', ['id' => $book->id]) }}">{{ trans('book.edit-link') }}</a>
                        @endif
                    </li>
            </ul>
        </section>
    </section>

    <h3>{{ trans('book.tags') }}</h3>
    @foreach($book->tags as $tag)
        <a href="{{ route('tag.show', ['slug' => $tag->slug]) }}" class="tag">{{ $tag->name }}</a>
    @endforeach
@endsection