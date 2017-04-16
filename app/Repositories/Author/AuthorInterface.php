<?php

namespace App\Repositories\Author;


interface AuthorInterface
{
    /**
     * Create new author in DB.
     *
     * @param array $data
     * @return \App\Author|\Illuminate\Database\Eloquent\Model
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
     * Find author by it's slug.
     *
     * @param string $slug
     * @return \App\Author|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug);

    /**
     * Update author row in DB.
     *
     * @param array $data
     * @param int $id
     * @return bool|\App\Author|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, int $id);

    /**
     * Get author by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]|\App\Author
     */
    public function getByName(string $name);
}