<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = 'mitraks';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'contact_person',
        'phone',
        'email',
        'address',
        'city',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Generate slug dari name
     */
    public static function generateSlug($name)
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
