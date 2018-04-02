<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function client()
    {
        return $this->belongsToMany(
            Client::class,
            'employeeсlients',
            'id',
            'client_id'
        )
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients()
    {
        return $this->belongsToMany(
            Project::class,
            'employeeсlients',
            'user_id',
            'client_id'
        )
            ->withTimestamps();
    }

    public function project()
    {
        return $this->belongsToMany(
            Project::class,
            'project_employees',
            'user_id',
            'project_id'
        )
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeInWorkstation()
    {
        return $this->hasMany('App\TimeEmployee');
    }

    public function generateToken()
    {
        $this->remember_token = str_random(60);
        $this->save();

        return $this->remember_token;
    }
}
