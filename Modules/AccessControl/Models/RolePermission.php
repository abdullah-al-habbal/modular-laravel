<?php

namespace Modules\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AccessControl\Database\Factories\RolePermissionFactory;

class RolePermission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): RolePermissionFactory
    // {
    //     // return RolePermissionFactory::new();
    // }
}
