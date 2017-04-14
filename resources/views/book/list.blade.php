@extends('layouts.app')

@section('content-class', 'list')

@section('content')
    <table>
        <thead>
            <tr>
                <th>{{ trans('book.name') }}</th>
                <th>{{ trans('book.author') }}</th>
                <th>{{ trans('book.publisher') }}</th>
                <th>{{ trans('book.medium') }}</th>
                <th>{{ trans('book.shelf') }}</th>
                <th>{{ trans('book.tag') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>
                        @foreach($book->authors as $author)
                            {{ $author->name .' '. $author->surname }}
                        @endforeach
                    </td>
                    <td>{{ $book->publisher->name }}</td>
                    <td>{{ $book->medium->name }}</td>
                    <td>
                        @foreach($book->shelves as $shelf)
                            {{ $shelf->name }}
                        @endforeach
                    </td>
                    <td>
                        @foreach($book->tags as $tag)
                            {{ $tag->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection