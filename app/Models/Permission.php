<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

       /**
     * Get profiles
     */

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
