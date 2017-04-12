<?php

namespace App\Repositories\Author;


interface AuthorInterface
{
    /**
     * Create new author in DB.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data);

    /**
     * Retrive author by id.
     *
     * @param int $id
     * @return \App\Author
     */
    public function find(int $id);

    /**
     * Update author row in DB.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id);
}