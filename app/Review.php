<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Possible rates that user can rate the attraction.
     *
     * @var array
     */
    protected static $rates = [
        5 => 'Very Good',
        4 => 'Good',
        3 => 'OK',
        2 => 'Bad',
        1 => 'Very Bad',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attraction_id', 'rating', 'content'
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

    /******************************************************************************************************************/

    /**
     * Returns possible rates that user can rate the attraction.
     *
     * @return array
     */
    public static function getRates() : array
    {
        return self::$rates;
    }
}
