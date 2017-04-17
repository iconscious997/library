@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($section->name))
        <h2 class="section-title">{{ $section->name }} {{ $section->surname or '' }}</h2>
        <p>{{ $section->description or ' ' }}</p>
    @endif

    <table>
        <thead>
        <tr>
            <th class="book-name">{{ trans('book.name') }}</th>
            <th class="book-author">{{ trans('book.author') }}</th>
            <th class="book-publisher">{{ trans('book.publisher') }}</th>
            @if(Auth::check() && Auth::user()->verified)
                <th class="book-medium">{{ trans('book.medium') }}</th>
                <th class="book-shelf">{{ trans('book.shelf') }}</th>
            @endif
            <th class="book-tag">{{ trans('book.tag') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>
                    <a href="{{ route('book.single', ['slug' => $book->slug]) }}" class="book-name">
                        {{ $book->name }}
                    </a>
                </td>
                <td>
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
                </td>
                <td>
                    <a href="{{ route('publisher.show', ['slug' => $book->publisher->slug]) }}">
                        {{ $book->publisher->name }}
                    </a>
                </td>
                @if(Auth::check() && Auth::user()->verified)
                <td>
                    <a href="{{ route('medium.show', ['slug' => $book->medium->slug]) }}">
                        {{ $book->medium->name }}
                    </a>
                </td>
                <td>
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
                </td>
                @endif
                <td>
                    @php
                        $tagSeparated = [];
                        foreach($book->tags as $tag) {
                            $tagSeparated[] = '<a href="'
                            . route('tag.show', ['slug' => $tag->slug])
                            . '">'
                            . $tag->name
                            . '</a>';
                        }

                        echo implode(', ', $tagSeparated);
                    @endphp
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $books->render('layouts.pagination') !!}
@endsection