<?php

namespace App\Repositories\Tag;

use App\Tag;

class TagEloquentRepository implements TagInterface
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
}