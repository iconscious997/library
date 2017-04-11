<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Book
 *
 * @property int $id
 * @property int $publisher_id
 * @property int $medium_id
 * @property string $name
 * @property string $description
 * @property string $year
 * @property int $isbn
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Author[] $author
 * @property-read \App\Medium $medium
 * @property-read \App\Publisher $publisher
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Shelf[] $shelf
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tag
 * @method static \Illuminate\Database\Query\Builder|\App\Book whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book whereIsbn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book whereMediumId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book wherePublisherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book whereYear($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    /**
     * Table which belongs to the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'year', 'isbn'
    ];

    /**
     * Retrive publisher which produced this book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo('App\Publisher', 'publisher_id', 'id');
    }

    /**
     * Retrive medium which owns this book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medium()
    {
        return $this->belongsTo('App\Medium', 'medium_id', 'id');
    }

    /**
     * Retrive tags which belongs to this book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tag()
    {
        return $this->belongsToMany('App\Tag', 'book_tag', 'book_id', 'tag_id');
    }

    /**
     * Retrive authors which belongs to this book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function author()
    {
        return $this->belongsToMany('App\Author', 'book_author', 'book_id', 'author_id');
    }

    /**
     * Retrive shelves which belongs to this book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shelf()
    {
        return $this->belongsToMany('App\Shelf', 'book_shelf', 'book_id', 'shelf_id');
    }
}
