<?php

namespace App\Repositories\Medium;


interface MediumInterface
{
    /**
     * Create new medium row.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data);

    /**
     * Retrieve medium by Id.
     *
     * @param int $id
     * @return \App\Medium
     */
    public function find(int $id);

    /**
     * Update medium row in db.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id);
}