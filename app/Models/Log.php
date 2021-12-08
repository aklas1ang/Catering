<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    const DONE = 'done';
    const CANCEL = 'cancelled';
    const CREATED = 'created';
    const CONFIRMED = 'confirmed';

    protected $fillable = [
        'type',
        'message',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
