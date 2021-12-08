<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'book_by_id',
        'reserved_to_id',
        'schedule'
    ];

    public function bookBy() {
        return $this->belongsTo(User::class, 'book_by_id', 'id');
    }

    public function reservedTo() {
        return $this->belongsTo(User::class, 'reserved_to_id', 'id');
    }
}
