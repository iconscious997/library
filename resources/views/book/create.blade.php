@extends('layouts.app')

@section('content')
    <form action="{{ route('book.store') }}" role="form" method="post">
        {{ csrf_field() }}

        <h1>{{ trans('book.create-title') }}</h1>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="book-name">{{ trans('book.name') }}</label>
            <input type="text" id="book-name" name="name" placeholder="{{ trans('form.required') }}" required autofocus>
            @if ($errors->has('name'))
                <div class="error-text">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
            <label for="book-year">{{ trans('book.year') }}</label>
            <input type="number" id="book-year" name="year" placeholder="{{ trans('form.required') }}" max="{{ date('Y') }}" required>
            @if ($errors->has('year'))
                <div class="error-text">
                    {{ $errors->first('year') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('isbn') ? ' has-error' : '' }}">
            <label for="book-isbn">{{ trans('book.isbn') }}</label>
            <input type="text" id="book-isbn" name="isbn" placeholder="{{ trans('form.required') }}" required>
            @if ($errors->has('isbn'))
                <div class="error-text">
                    {{ $errors->first('isbn') }}
                </div>
            @endif
        </div>

        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="book-description">{{ trans('book.description') }}</label>
            <textarea name="description" id="book-description" cols="30" rows="10"></textarea>
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
                    <input type="checkbox" value="{{ $medium->id }}" id="book-medium-{{ $medium->id }}" name="medium[]">
                </label>
            @endforeach
        </div>

        <div class="form-group select-group {{ $errors->has('medium') ? ' has-error' : '' }}">
            <label for="book-authors">{{ trans('book.author') }}</label>
            <select multiple name="authors[]" id="book-authors" style="width: 100%">
                <!-- will be generated -->
            </select>
        </div>

        <div class="form-group select-group {{ $errors->has('medium') ? ' has-error' : '' }}">
            <label for="book-tags">{{ trans('book.tag') }}</label>
            <select multiple name="tags[]" id="book-tags" style="width: 100%">
                <!-- will be generated -->
            </select>
        </div>

        <button>
            {{ trans('book.create-button') }}
        </button>
    </form>
@endsection

@section('javascript')
    <script>
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
    </script>
@endsection