<?php

namespace App\Repositories\Tag;

interface TagInterface
{
    /**
     * Create new shelf row.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\App\Tag
     */
    public function store(array $data);

    /**
     * Retrieve shelf by Id.
     *
     * @param int $id
     * @return \App\Tag
     */
    public function find(int $id);

    /**
     * Find tag by it's slug.
     *
     * @param string $slug
     * @return \App\Tag|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug);

    /**
     * Update shelf row in db.
     *
     * @param array $data
     * @param int $id
     * @return bool|\App\Tag|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, int $id);

    /**
     * Get tag by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]|\App\Tag
     */
    public function getByName(string $name);

    /**
     * Create new tag and store it in databse.
     *
     * @param array $tags
     * @return int|array
     */
    public function create(array $tags);
}