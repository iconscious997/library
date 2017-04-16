@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    @if(isset($section->name))
        <h2 class="section-title">{{ $section->name }}</h2>
        <p>{{ $section->description or ' ' }}</p>
    @endif

    <table>
        <thead>
        <tr>
            <th class="book-name">{{ trans('book.name') }}</th>
            <th class="book-author">{{ trans('book.author') }}</th>
            <th class="book-publisher">{{ trans('book.publisher') }}</th>
            <th class="book-medium">{{ trans('book.medium') }}</th>
            <th class="book-shelf">{{ trans('book.shelf') }}</th>
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
                    @foreach($book->authors as $author)
                        <a href="#{{ $author->slug }}">{{ $author->name .' '. $author->surname }}</a>
                    @endforeach
                </td>
                <td><a href="{{ route('publisher.show', ['slug' => $book->publisher->slug]) }}">{{ $book->publisher->name }}</a></td>
                <td><a href="{{ $book->medium->slug }}">{{ $book->medium->name }}</a></td>
                <td>
                    @foreach($book->shelves as $shelf)
                        <a href="{{ $shelf->slug }}">{{ $shelf->name }}</a>
                    @endforeach
                </td>
                <td>
                    @foreach($book->tags as $tag)
                        <a href="{{ $tag->slug }}">{{ $tag->name }}</a>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $books->render('layouts.pagination') !!}
@endsection