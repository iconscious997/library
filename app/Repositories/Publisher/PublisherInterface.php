<?php

namespace App\Repositories\Publisher;

interface PublisherInterface
{
    /**
     * Create new publisher record in database.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\MessageBag|\App\Publisher
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
     * Find tag by it's slug.
     *
     * @param string $slug
     * @return \App\Publisher|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug);

    /**
     * Update publisher record in database.
     *
     * @param int $id
     * @param array $data
     * @return bool|\App\Publisher|\Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data);

    /**
     * Get publisher by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]|\App\Publisher
     */
    public function getByName(string $name);
}
