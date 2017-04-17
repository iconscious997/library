<?php

namespace App\Repositories\Shelf;


use App\Shelf;

class ShelfEloquentRepository implements ShelfInterface
{
    /**
     * Create new medium row.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['slug'] = str_slug($data['name']);

        return Shelf::create($data);
    }

    /**
     * Retrieve medium by Id.
     *
     * @param int $id
     * @return Shelf
     */
    public function find(int $id)
    {
        return Shelf::find($id);
    }

    /**
     * Find tag by it's slug.
     *
     * @param string $slug
     * @return \App\Shelf|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug)
    {
        return Shelf::where('slug', $slug)
            ->first();
    }

    /**
     * Update medium row in db.
     *
     * @param array $data
     * @param int $id
     * @return \App\Shelf
     */
    public function update(array $data, int $id)
    {
        $data['slug'] = str_slug($data['name']);

        $shelf = $this->find($id);
        $shelf->update($data);

        return $shelf;
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

        return Shelf::where('slug', 'LIKE', '%'. $name .'%')
            ->limit(15)
            ->get();
    }
}