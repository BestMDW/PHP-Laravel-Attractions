<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    /** Placeholder path. */
    const PLACEHOLDER = '/images/placeholder-300x300.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attraction_id', 'path'
    ];

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to Many relation (Inverse).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attraction()
    {
        return $this->belongsTo('App\Attraction');
    }

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to Many relation (Inverse).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
