<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public static function defaultPermissions()
    {
        return [
            'Administer roles & permissions',
            'View Product',
            'Add Product',
            'Edit Product',
            'Delete Product'
        ];
    }
}
