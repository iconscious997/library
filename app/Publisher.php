<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Publisher
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $location
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Book[] $book
 * @method static \Illuminate\Database\Query\Builder|\App\Publisher whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Publisher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Publisher whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Publisher whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Publisher whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Publisher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Publisher extends Model
{
    /**
     * Table which belongs to the model.
     *
     * @var string
     */
    protected $table = 'publishers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'location'
    ];

    /**
     * Retrive books which belongs to publisher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book()
    {
        return $this->hasMany('App\Book', 'publisher_id', 'id');
    }
}
