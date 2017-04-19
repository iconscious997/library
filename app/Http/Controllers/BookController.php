<?php

namespace App\Http\Controllers;

use App\Events\BookStored;
use Illuminate\Http\Request;
use App\Repositories\Book\BookInterface;
use App\Repositories\Medium\MediumInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * @var BookInterface
     */
    protected $book;

    /**
     * @var MediumInterface
     */
    protected $medium;

    /**
     * BookController constructor.
     *
     * @param BookInterface $book
     * @param MediumInterface $medium
     */
    public function __construct(BookInterface $book, MediumInterface $medium)
    {
        $this->middleware('auth')->except('index', 'show');
        $this->book = $book;
        $this->medium = $medium;
    }

    /**
     * Show book index.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $books = $this->book->paginate($this->limit);

        return view('book.list', compact('books'));
    }

    /**
     * Show details about book on it's own page.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $book = $this->book->findSlug($slug);

        return view('book.single', compact('book'));
    }

    /**
     * Show page where user can add new book to database.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $mediums = $this->medium->all();

        return view('book.create', compact('mediums'));
    }

    /**
     * Handle application book store request.
     *
     * @param Request $request
     * @return BookController|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = $this->extendBookData($request->all());
            $book = $this->book->store($book);

            // Attach authors to book
            if ($book->id) {
                $book->authors()->sync($request->input('authors'));
            }

            // Attach tags to book
            if ($book->id) {
                $tags = resolve('App\Repositories\Tag\TagInterface');
                $tags = $tags->create($request->input('tags'));

                $book->tags()->sync($tags);
            }

            // Attach shelves to book
            if ($book->id) {
                $book->shelves()->sync($request->input('shelves'));
            }

            event(new BookStored($book));

            return redirect()->route('book.edit', ['id' => $book->id]);
        }
    }

    /**
     * Show application page, where user can edit book.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $book = $this->book->find($id);
        $mediums = $this->medium->all();

        return view('book.edit', compact('book', 'mediums'));
    }

    /**
     * Handle application book update request.
     *
     * @param Request $request
     * @param int $id
     * @return BookController|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = $this->validator($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = $this->extendBookData($request->all());
            $book = $this->book->update($book, $id);

            // Attach authors to book
            if ($book->id) {
                $book->authors()->sync($request->input('authors'));
            }

            // Attach tags to book
            if ($book->id) {
                $tags = resolve('App\Repositories\Tag\TagInterface');
                $tags = $tags->create($request->input('tags'));

                $book->tags()->sync($tags);
            }

            // Attach shelves to book
            if ($book->id) {
                $book->shelves()->sync($request->input('shelves'));
            }

            return redirect()->route('book.single', ['id' => $id]);
        }
    }

    /**
     * Validate received data.
     *
     * @param array $data
     * @param int|null $id
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data, int $id = null)
    {
        return Validator::make($data, [
            'name' => 'required|unique:books,name,'.$id,
            'year' => 'required',
            'medium' => 'required',
            'authors' => 'required',
            'tags' => 'required',
            'shelves' => 'required',
            'publisher' => 'required'
        ]);
    }

    /**
     * Extend book informations by getting some information from Google api.
     *
     * @param array $data
     * @return array
     */
    protected function extendBookData(array $data)
    {
        $book = [
            'publisher_id' => $data['publisher'],
            'medium_id' => $data['medium'],
            'name' => $data['name'],
            'description' => $data['description'],
            'isbn' => $data['isbn'],
            'year' => $data['year'],
            'slug' => str_slug($data['name']),
            'published_at' => null,
            'cover' => null,
            'page_count' => null,
            'google_link' => null
        ];

        // If is set book ISBN we can try search in Google API
        if ($book['isbn']) {
            $isbn = preg_replace("/[^A-Za-z0-9 ]/", '', $book['isbn']);

            $googleBooks = callApi("GET", "https://www.googleapis.com/books/v1/volumes", [
                "q" => "isbn:".$isbn,
                "key" => config('library.books_api_key')
            ]);

            // When google found something we can use it!
            if ($googleBooks['totalItems'] !== 0) {
                if (isset($googleBooks['items'][0]["volumeInfo"]['publishedDate'])) {
                    $book['published_at'] = $googleBooks['items'][0]["volumeInfo"]['publishedDate'];
                }

                if (isset($googleBooks['items'][0]["volumeInfo"]['pageCount'])) {
                    $book['page_count'] = $googleBooks['items'][0]["volumeInfo"]['pageCount'];
                }

                if (isset($googleBooks['items'][0]["volumeInfo"]['imageLinks']['smallThumbnail'])) {
                    $book['cover'] = $googleBooks['items'][0]["volumeInfo"]['imageLinks']['smallThumbnail'];
                }

                if (isset($googleBooks['items'][0]["volumeInfo"]['infoLink'])) {
                    $book['google_link'] = $googleBooks['items'][0]["volumeInfo"]['infoLink'];
                }

                // Only if user doesn't provide own description, which could be
                // sometimes more usefull.
                if (empty($book['description'])) {
                    if (isset($googleBooks['items'][0]["volumeInfo"]['infoLink']["description"])) {
                        $book['description'] = $googleBooks['items'][0]["volumeInfo"]['infoLink']["description"];
                    }
                }
            }
        }

        return $book;
    }
}
