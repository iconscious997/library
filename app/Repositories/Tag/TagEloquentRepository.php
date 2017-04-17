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

        $tag = $this->find($id);
        $tag->update($data);

        return $tag;
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

    /**
     * Create new tag and store it in databse.
     *
     * @param array $tags
     * @return int|array
     */
    public function create(array $tags)
    {
        foreach ($tags as $tag) {
            // Check if tag is numeric and can be found.
            if (! (is_numeric($tag) && $this->find($tag))) {
                // Unset tag if it's not an existing ID.
                if (($key = array_search($tag, $tags)) !== false) {
                    unset($tags[$key]);
                }

                // Find tag by slug or ID.
                $tags[] = $this->findOrCreate($tag);
            }
        }

        return $tags;
    }

    /**
     * Resolve if tag exists, otherwise create new.
     *
     * @param string|int $tag
     * @return int
     */
    protected function findOrCreate($tag)
    {
        $slug = str_slug($tag);
        $existing = $this->findSlug($slug);

        if (isset($existing->slug)) {
            return $existing->id;
        } else {
            return $this->store(['name' => $tag])->id;
        }
    }
}