<?php

namespace App\Repositories\Tag;

use App\Tag;

class TagEloquentRepository implements TagInterface
{
    /**
     * Create new medium row.
     *
     * @param array $data
     * @return \App\Tag|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['slug'] = str_slug($data['name']);

        return Tag::create($data);
    }

    /**
     * Retrieve medium by Id.
     *
     * @param int $id
     * @return Tag
     */
    public function find(int $id)
    {
        return Tag::find($id);
    }

    /**
     * Find tag by it's slug.
     *
     * @param string $slug
     * @return \App\Tag|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug)
    {
        return Tag::where('slug', $slug)
            ->first();
    }

    /**
     * Update medium row in db.
     *
     * @param array $data
     * @param int $id
     * @return bool|\App\Tag|\Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, int $id)
    {
        $data['slug'] = str_slug($data['name']);

        return $this->find($id)->update($data);
    }

    /**
     * Get tag by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByName(string $name)
    {
        return Tag::where('name', 'LIKE', '%'. $name .'%')
            ->limit(15)
            ->get();
    }
}