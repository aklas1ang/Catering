<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    const FOOD = 'food';
    const DRINKS = 'drinks';

    protected $fillable = [
        'name',
        'type',
        'user_id',
        'package_id',
        'description'
    ];

    public function package() 
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
