<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Medium
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Book[] $book
 * @method static \Illuminate\Database\Query\Builder|\App\Medium whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Medium whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Medium whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Medium whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Medium whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Medium extends Model
{
    /**
     * Table which belongs to this model.
     *
     * @var string
     */
    protected $table = 'mediums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Retrive books which belongs to the medium.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book()
    {
        return $this->hasMany('App\Book', 'medium_id', 'id');
    }
}
