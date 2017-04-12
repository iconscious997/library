<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Book\BookInterface;
use App\Repositories\Medium\MediumInterface;

class BookController extends Controller
{
    protected $book;
    protected $medium;

    public function __construct(BookInterface $book, MediumInterface $medium)
    {
        $this->middleware('auth');
        $this->book = $book;
        $this->medium = $medium;
    }

    public function create()
    {
        $mediums = $this->medium->all();

        return view('book.create', compact('mediums'));
    }
}
