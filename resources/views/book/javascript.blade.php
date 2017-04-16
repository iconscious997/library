<script>
    // Book authors
    $('#book-authors').select2({
        language: '{{ config('app.locale') }}',
        minimumInputLength: 3,
        minimumResultsForSearch: Infinity,
        allowClear: true,
        placeholder: "{{ trans('form.required') }}",
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
        tags: true,
        tokenSeparators: [','],
        language: '{{ config('app.locale') }}',
        minimumInputLength: 3,
        minimumResultsForSearch: Infinity,
        allowClear: true,
        placeholder: "{{ trans('book.tag-add-description') }}",
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
        },
        createTag: function (tag) {
            return {
                id: tag.term,
                text: tag.term,
                tag: true
            };
        }
    });

    // Book shelf
    $('#book-shelf').select2({
        language: '{{ config('app.locale') }}',
        minimumInputLength: 3,
        minimumResultsForSearch: Infinity,
        allowClear: true,
        placeholder: "{{ trans('form.required') }}",
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
        placeholder: "{{ trans('form.required') }}",
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

    $('#shelf-new').on('click', function() {
        var editor = $('#window');

        $.ajax({
            method: 'GET',
            url: "{{ route('shelf.create') }}",
            success: function(data) {
                editor.find('#window-creator').html(data);
                handleForm('shelf', "{{ route('shelf.store') }}");
            }
        });

        editor.show();
    });

    $('#author-new').on('click', function() {
        var editor = $('#window');

        $.ajax({
            method: 'GET',
            url: "{{ route('author.create') }}",
            success: function(data) {
                editor.find('#window-creator').html(data);
                handleForm('authors', "{{ route('author.store') }}");
            }
        });

        editor.show();
    });

    $('#publisher-new').on('click', function() {
        var editor = $('#window');

        $.ajax({
            method: 'GET',
            url: "{{ route('publisher.create') }}",
            success: function(data) {
                editor.find('#window-creator').html(data);
                handleForm('publisher', "{{ route('publisher.store') }}");
            }
        });

        editor.show();
    });

    /**
     * Handle form sending if is in editor window.
     *
     * @param editorName
     * @param route
     */
    function handleForm(editorName, route) {
        var button = $('#window-creator').find('button');

        button.on('click', function(e) {
            e.preventDefault();

            var data = new FormData($('#window-creator').find('form')[0]);
            var editor = $('#window');
            var formType = $('#book-' + editorName);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: route,
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data) {
                        editor.hide();
                    }

                    formType.append("<option value='"+ data.id +"' selected>"+ data.name +"</option>")
                }
            })
        });
    }
</script>