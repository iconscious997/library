<?php

namespace App\Repositories\Medium;


interface MediumInterface
{
    /**
     * Create new medium row.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\App\Medium
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
     * @return bool|\App\Medium|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, int $id);

    /**
     * List all stored mediums.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]|\App\Medium
     */
    public function all();
}