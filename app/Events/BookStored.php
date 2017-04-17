<?php

namespace App\Events;

use App\Book;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class BookStored
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Book
     */
    public $book;

    /**
     * @var \App\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
        $this->user = Auth::user();
    }
}
