<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    public function scopeDoctors($query)
    {
        return $query->whereNull('deleted_at');
    }
}
