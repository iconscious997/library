<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Book\BookInterface;

class SearchController extends Controller
{
    /**
     * @var BookInterface
     */
    protected $book;

    /**
     * Default commands and it's routes.
     *
     * @var array
     */
    protected $commands = [
        'create' => '/book/create',
        'tag'    => '/tag/create',
        'shelf'  => '/shelf/create',
        'medium' => '/medium/create',
        'author' => '/author/create'
    ];

    /**
     * BookController constructor.
     *
     * @param BookInterface $book
     */
    public function __construct(BookInterface $book)
    {
        // $this->middleware('auth')->except('index');
        $this->book = $book;
    }

    /**
     * Search for books in db and return index.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        if ($request->input('query') == null) {
            return redirect()->route('home');
        }

        $isCommand = $this->resolveCommands($request->input('query'));

        if (isset($isCommand['command'])) {
            return redirect($isCommand['command']);
        }

        $books = $this->book->findName($request->input('query'), $this->limit);

        return view('book.list', compact('books'));
    }

    /**
     * Resolve search commands and return them.
     *
     * @param string $query
     * @return array|string
     */
    protected function resolveCommands(string $query)
    {
        if (substr($query, 0, 1) == ':') {
            $command = substr($query, 1);

            if (array_key_exists($command, $this->commands)) {
                return [
                    'query' => $query,
                    'command' => $this->commands[$command]
                ];
            }
        }

        return $query;
    }
}
