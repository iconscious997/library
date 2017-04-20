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
     * Find book by it's name.
     *
     * @param string $query
     * @param int $limit
     * @param array $sortParameters
     * @return Book|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findName(string $query, int $limit, array $sortParameters = [])
    {
        $sortParameters['appends']['query'] = $query;

        // Because sortBy could sometimes use joins we need to make sure that
        // search will be always in books table.
        return Book::where('books.name', 'LIKE', '%'.$query.'%')
            ->sortBy($sortParameters['property'], $sortParameters['direction'])
            ->paginate($limit)
            ->appends($sortParameters['appends']);
    }

    /**
     * Find book by it's slug.
     *
     * @param string $slug
     * @return \App\Book|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug)
    {
        return Book::where('slug', $slug)
            ->first();
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

    /**
     * Paginate books from database.
     *
     * @param int $limit
     * @param array $sortParameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $limit, array $sortParameters = [])
    {
        return Book::sortBy($sortParameters['property'], $sortParameters['direction'])
            ->paginate($limit)
            ->appends($sortParameters['appends']);
    }
}