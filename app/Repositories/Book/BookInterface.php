<?php

namespace App\Repositories\Book;

interface BookInterface
{
    /**
     * Save Book model and return it's instance.
     *
     * @param array $data
     * @return \App\Book|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data);

    /**
     * Find book by it's primary key.
     *
     * @param int $id
     * @return \App\Book|\Illuminate\Database\Eloquent\Model
     */
    public function find(int $id);

    /**
     * Find book by it's name.
     *
     * @param string $query
     * @param int $limit
     * @return \App\Book|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findName(string $query, int $limit);

    /**
     * Find book by it's slug.
     *
     * @param string $slug
     * @return \App\Book|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug);

    /**
     * Update book model in database.
     *
     * @param array $data
     * @param int $id
     * @return \App\Book|\Illuminate\Database\Eloquent\Model|bool
     */
    public function update(array $data, int $id);

    /**
     * Paginate books from database.
     *
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $limit);
}
