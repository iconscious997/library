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
     * Find tag by it's slug.
     *
     * @param string $slug
     * @return \App\Publisher|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug)
    {
        return Publisher::where('slug', $slug)
            ->first();
    }

    /**
     * Update publisher record in database.
     *
     * @param int $id
     * @param array $data
     * @return \App\Publisher
     */
    public function update(int $id, array $data)
    {
        $publisher = $this->find($id);
        $publisher->update($data);

        return $publisher;
    }

    /**
     * Get shelf by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByName(string $name)
    {
        $name = str_slug($name);

        return Publisher::where('slug', 'LIKE', '%'. $name .'%')
            ->limit(15)
            ->get();
    }

}
