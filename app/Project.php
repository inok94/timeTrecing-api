<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = ['name','description'];

    /**
     * BelongsToMany
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employee()
    {
        return $this->belongsToMany(
            User::class,
            'employeeсlients',
            'user_id',
            'project_id'
        )
            ->withTimestamps();
    }
}
