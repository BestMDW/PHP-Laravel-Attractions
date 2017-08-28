<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body'
    ];

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to Many relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to Many relation (Inverse).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to Many relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews() {
        return $this->hasMany('App\Review');
    }
}
