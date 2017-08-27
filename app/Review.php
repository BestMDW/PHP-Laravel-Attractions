<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating', 'content'
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
