<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name'];
    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function employee()
    {
        return $this->belongsToMany(
            User::class,
            'employeeсlients',
            'client_id',
            'user_id'
        )
            ->withTimestamps();
    }
}
