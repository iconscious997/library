<?php

namespace App\Repositories\Publisher;

interface PublisherInterface
{
    /**
     * Create new publisher record in database.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\MessageBag
     */
    public function store(array $data);

    /**
     * Retrive publisher by given id.
     *
     * @param int $id
     * @return \App\Publisher
     */
    public function find(int $id);

    /**
     * Update publisher record in database.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data);
}
