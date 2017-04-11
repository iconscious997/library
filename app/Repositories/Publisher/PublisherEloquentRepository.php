<?php

namespace App\Repositories\Publisher;

use App\Publisher;

class PublisherEloquentRepository implements PublisherInterface
{
    /**
     * Create new publisher record in database.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\MessageBag
     */
    public function store(array $data)
    {
        $data['slug'] = str_slug($data['name']);

        return Publisher::create($data);
    }

    /**
     * Retrive publisher by given id.
     *
     * @param int $id
     * @return Publisher
     */
    public function find(int $id)
    {
        return Publisher::find($id);
    }

    /**
     * Update publisher record in database.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        return Publisher::find($id)
            ->update($data);
    }

}
