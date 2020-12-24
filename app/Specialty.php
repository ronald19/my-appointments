<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    //
    public function scopeSpecialties($query)
    {
        return $query->whereNull('deleted_at');
    }

    //$specialty->users
    public function users(){
    	return $this->belongsToMany(User::class)->withTimestamps();
    }
}
