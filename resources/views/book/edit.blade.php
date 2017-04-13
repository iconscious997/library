@extends('layouts.app')

@section('content')
    <form action="{{ route('book.update', ['id' => $book->id]) }}" role="form" method="post">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <h1>{!! trans('book.edit-title', ['book' => $book->name]) !!}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="book-name">{{ trans('book.name') }}</label>
            <input type="text" id="book-name" name="name"
                   placeholder="{{ trans('form.required') }}"
                   value="{{ $book->name }}"
                   required>
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
            <label for="book-year">{{ trans('book.year') }}</label>
            <input type="number" id="book-year" name="year"
                   placeholder="{{ trans('form.required') }}"
                   max="{{ date('Y') }}"
                   value="{{ $book->year }}"
                   required>
            @if ($errors->has('year'))
                <div class="error-text">
                    {{ $errors->first('year') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('isbn') ? ' has-error' : '' }}">
            <label for="book-isbn">{{ trans('book.isbn') }}</label>
            <input type="text" id="book-isbn" name="isbn"
                    value="{{ $book->isbn }}">
            @if ($errors->has('isbn'))
                <div class="error-text">
                    {{ $errors->first('isbn') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="book-description">{{ trans('book.description') }}</label>
            <textarea name="description" id="book-description" cols="30" rows="10">{{ $book->description }}</textarea>
            @if ($errors->has('description'))
                <div class="error-text">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>

        <div class="form-group checkbox-group {{ $errors->has('medium') ? ' has-error' : '' }}">
            <label for="">{{ trans('book.medium') }}</label>
            @foreach($mediums as $medium)
                <label for="book-medium-{{ $medium->id }}" class="checkbox">
                    {{ $medium->name }}
                    <input type="radio" value="{{ $medium->id }}"
                           id="book-medium-{{ $medium->id }}"
                           @if($medium->id == $book->medium_id)
                           checked
                           @endif
                           name="medium">
                </label>
            @endforeach
        </div>

        <div class="form-group select-group {{ $errors->has('medium') ? ' has-error' : '' }}">
            <label for="book-authors">{{ trans('book.author') }}</label>
            <select multiple name="authors[]" id="book-authors" style="width: 100%" required>
                @foreach($book->authors as $author)
                    <option value="{{ $author->id }}" selected>{{ $author->name .' '. $author->surname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group select-group {{ $errors->has('medium') ? ' has-error' : '' }}">
            <label for="book-tags">{{ trans('book.tag') }}</label>
            <select multiple name="tags[]" id="book-tags" style="width: 100%" required>
                @foreach($book->tags as $tag)
                    <option value="{{ $tag->id }}" selected>{{ $tag->name .' '. $tag->surname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group select-group {{ $errors->has('shelf') ? ' has-error' : '' }}" >
            <label for="book-shelf">{{ trans('book.shelf') }}</label>
            <select multiple name="shelves[]" id="book-shelf" style="width: 100%" required>
                @foreach($book->shelves as $shelf)
                    <option value="{{ $shelf->id }}" selected>{{ $shelf->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group select-group {{ $errors->has('publisher') ? ' has-error' : '' }}">
            <label for="book-publisher">{{ trans('book.publisher') }}</label>
            <select name="publisher" id="book-publisher" style="width: 100%" required>
                <option value="{{ $book->id }}" selected>{{ $book->publisher->name }}</option>
            </select>
        </div>

        <button>
            {{ trans('book.edit-button') }}
        </button>
    </form>
@endsection

@section('javascript')
    <script>
        // Book authors
        $('#book-authors').select2({
            language: '{{ config('app.locale') }}',
            minimumInputLength: 3,
            minimumResultsForSearch: Infinity,
            allowClear: true,
            placeholder: " ",
            ajax: {
                url: "{{ route('author.select') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        author: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.authors
                    };
                },
                cache: true,
            }
        });

        // Book tags
        $('#book-tags').select2({
            language: '{{ config('app.locale') }}',
            minimumInputLength: 3,
            minimumResultsForSearch: Infinity,
            allowClear: true,
            placeholder: " ",
            ajax: {
                url: "{{ route('tag.select') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        tag: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.authors
                    };
                },
                cache: true,
            }
        });

        // Book shelf
        $('#book-shelf').select2({
            language: '{{ config('app.locale') }}',
            minimumInputLength: 3,
            minimumResultsForSearch: Infinity,
            allowClear: true,
            placeholder: " ",
            ajax: {
                url: "{{ route('shelf.select') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        shelf: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.shelves
                    };
                },
                cache: true,
            }
        });

        // Book publisher
        $('#book-publisher').select2({
            language: '{{ config('app.locale') }}',
            minimumInputLength: 3,
            minimumResultsForSearch: Infinity,
            allowClear: true,
            placeholder: " ",
            ajax: {
                url: "{{ route('publisher.select') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        publisher: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.publishers
                    };
                },
                cache: true,
            }
        });
    </script>
@endsection