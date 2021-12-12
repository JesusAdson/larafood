<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get permissions
     */

     public function permissions()
     {
         return $this->belongsToMany(Permission::class);
     }
}
