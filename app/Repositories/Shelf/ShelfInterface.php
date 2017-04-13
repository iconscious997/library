<?php

namespace App\Repositories\Shelf;


interface ShelfInterface
{
    /**
     * Create new shelf row.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\App\Shelf
     */
    public function store(array $data);

    /**
     * Retrieve shelf by Id.
     *
     * @param int $id
     * @return \App\Shelf
     */
    public function find(int $id);

    /**
     * Update shelf row in db.
     *
     * @param array $data
     * @param int $id
     * @return bool|\App\Shelf|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, int $id);

    /**
     * Get shelf by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]|\App\Shelf
     */
    public function getByName(string $name);
}
