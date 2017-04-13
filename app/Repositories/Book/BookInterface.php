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
     * Update book model in database.
     *
     * @param array $data
     * @param int $id
     * @return \App\Book|\Illuminate\Database\Eloquent\Model|bool
     */
    public function update(array $data, int $id);
}