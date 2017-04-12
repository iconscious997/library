<?php

namespace App\Repositories\Tag;

interface TagInterface
{
    /**
     * Create new shelf row.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
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
     * Update shelf row in db.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id);
}