<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'limit',
        'user_id',
        'image'
    ];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
