<?php

namespace App\Repositories\Medium;

use App\Medium;

class MediumEloquentRepository implements MediumInterface
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

        return Medium::create($data);
    }

    /**
     * Retrieve medium by Id.
     *
     * @param int $id
     * @return Medium
     */
    public function find(int $id)
    {
        return Medium::find($id);
    }

    /**
     * Find medium by it's slug.
     *
     * @param string $slug
     * @return \App\Medium|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug)
    {
        return Medium::where('slug', $slug)
            ->first();
    }

    /**
     * Update medium row in db.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id)
    {
        $data['slug'] = str_slug($data['name']);

        return $this->find($id)->update($data);
    }

    /**
     * List all stored mediums.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Medium::all();
    }
}