<?php

namespace App\Repositories\Author;

use App\Author;

class AuthorEloquentRepository implements AuthorInterface
{
    /**
     * @var Author
     */
    protected $author;

    /**
     * AuthorEloquentRepository constructor.
     *
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

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
     * Update author row in DB.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id)
    {
        $data['slug'] = str_slug($data['name'].' '.$data['surname']);

        return $this->find($id)->update($data);
    }
}