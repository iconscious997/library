<?php

namespace App\Repositories\Author;

use App\Author;
use Illuminate\Support\Facades\DB;

class AuthorEloquentRepository implements AuthorInterface
{
    /**
     * Create new author in DB.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data['slug'] = str_slug($data['name'].' '.$data['surname']);

        return Author::create($data);
    }

    /**
     * Retrive author by id.
     *
     * @param int $id
     * @return Author
     */
    public function find(int $id)
    {
        return Author::find($id);
    }

    /**
     * Find author by it's slug.
     *
     * @param string $slug
     * @return \App\Author|\Illuminate\Database\Eloquent\Model
     */
    public function findSlug(string $slug)
    {
        return Author::where('slug', $slug)
            ->first();
    }

    /**
     * Update author row in DB.
     *
     * @param array $data
     * @param int $id
     * @return \App\Author
     */
    public function update(array $data, int $id)
    {
        $data['slug'] = str_slug($data['name'].' '.$data['surname']);

        $author = $this->find($id);
        $author->update($data);

        return $author;
    }

    /**
     * Get author by name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByName(string $name)
    {
        $name = strtolower($name);

        return Author::where(DB::raw('concat(name, \' \', surname)'), 'LIKE', '%'. $name .'%')
            ->limit(15)
            ->get();
    }
}