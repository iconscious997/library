<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Shelf
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Book[] $book
 * @method static \Illuminate\Database\Query\Builder|\App\Shelf whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Shelf whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Shelf whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Shelf whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Shelf whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Shelf extends Model
{
    /**
     * Table which belongs to the model.
     *
     * @var string
     */
    protected $table = 'shelves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Retrive books which are present in this shelf.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function book()
    {
        return $this->belongsToMany('App\Book', 'book_shelf', 'shelf_id', 'book_id');
    }
}
