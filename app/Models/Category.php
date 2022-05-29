<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Category extends Model
{
    use TenantTrait;
    protected $fillable = ['name', 'url', 'description'];
}
