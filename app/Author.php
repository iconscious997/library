<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Author
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Book[] $book
 * @method static \Illuminate\Database\Query\Builder|\App\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Author whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Author whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Author whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Author whereSurname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Author whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    /**
     * Table which belongs to the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'slug'
    ];

    /**
     * Retrive books which were written by this author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function book()
    {
        return $this->belongsToMany('App\Book', 'book_author', 'author_id', 'book_id');
    }
}
