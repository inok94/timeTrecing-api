<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeСlient extends Model
{
    protected $fillable = ['employee_id', 'client_id'];

    /**
     * Get the user that owns the match.
     */
    public function employee()
    {
        return $this->belongsTo('App\User', 'id');
    }

    /**
     * Get the user that owns the match.
     */
    public function client()
    {
        return $this->belongsTo('App\Client','id');
    }

}
