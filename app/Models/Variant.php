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
        'description',
        'image'
    ];

    public function packages() 
    {
        return $this->belongsToMany(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
