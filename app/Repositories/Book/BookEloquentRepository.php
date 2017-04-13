<?php

namespace App\Repositories\Book;

use App\Book;

class BookEloquentRepository implements BookInterface
{
    /**
     * Save Book model and return it's instance.
     *
     * @param array $data
     * @return Book|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        return Book::create($data);
    }

    /**
     * Find book by it's primary key.
     *
     * @param int $id
     * @return \App\Book|\Illuminate\Database\Eloquent\Model
     */
    public function find(int $id)
    {
        return Book::find($id);
    }

    /**
     * Update book model in database.
     *
     * @param array $data
     * @param int $id
     * @return Book|\Illuminate\Database\Eloquent\Model|bool
     */
    public function update(array $data, int $id)
    {
        $book = $this->find($id);
        $book->update($data);

        return $book;
    }
}