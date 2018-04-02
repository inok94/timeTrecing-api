<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    protected $fillable = ['employee_id', 'project_id'];

    public function employee()
    {
        return $this->belongsTo('App\User','id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project','id');
    }

}
