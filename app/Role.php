<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** Proper name of the administrator role. */
    const ADMINISTRATOR = 'Administrator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /******************************************************************************************************************/

    /**
     * Accessor to the name attribute.
     *
     * @param $name
     * @return string
     */
    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    /******************************************************************************************************************/

    /**
     * Mutator of the Name attribute. Changes string to the lowercase.
     *
     * @param $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }
}
