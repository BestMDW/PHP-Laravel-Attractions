<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Possible states for the user status.
     * [0 - Not Active, 1 - Active]
     */
    const ACTIVE_STATES = [
        1 => 'Active',
        0 => 'Not Active',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to One relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /******************************************************************************************************************/

    /**
     * Make Eloquent One to Many relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attractions()
    {
        return $this->hasMany('App\Attraction');
    }

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
     * Make Eloquent One to Many relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /******************************************************************************************************************/

    /**
     * Returns whether or not the user is active.
     *
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->active;
    }

    /******************************************************************************************************************/

    /**
     * Returns whether or not the user has administrator privileges.
     *
     * @return bool
     */
    public function isAdmin() : bool
    {
        return $this->role && $this->role->name == Role::ADMINISTRATOR && $this->isActive();
    }

    /******************************************************************************************************************/

    /**
     * Returns possible states for the user account.
     *
     * @return array
     */
    public static function getStatusOptions() : array
    {
        return self::ACTIVE_STATES;
    }
}
