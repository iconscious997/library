<table>
    <thead>
    <tr>
        <th class="book-name">
            <i class="fa fa-sort{{ sortingIconDir('name') }}" aria-hidden="true"></i>
            <a href="{{ sortingLink('name', 'desc') }}">
                {{ trans('book.name') }}
            </a>
        </th>
        <th class="book-author">
            <i class="fa fa-sort{{ sortingIconDir('author') }}" aria-hidden="true"></i>
            <a href="{{ sortingLink('author', 'asc') }}">
                {{ trans('book.author') }}
            </a>
        </th>
        <th class="book-publisher">
            <i class="fa fa-sort{{ sortingIconDir('publisher') }}" aria-hidden="true"></i>
            <a href="{{ sortingLink('publisher', 'asc') }}">
                {{ trans('book.publisher') }}
            </a>
        </th>
        @if(Auth::check() && Auth::user()->verified)
            <th class="book-medium">
                <i class="fa fa-sort{{ sortingIconDir('medium') }}" aria-hidden="true"></i>
                <a href="{{ sortingLink('medium', 'asc') }}">
                    {{ trans('book.medium') }}
                </a>
            </th>
            <th class="book-shelf">
                <i class="fa fa-sort{{ sortingIconDir('shelf') }}" aria-hidden="true"></i>
                <a href="{{ sortingLink('shelf', 'asc') }}">
                    {{ trans('book.shelf') }}
                </a>
            </th>
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