<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id', // Assigned user (petugas)
    ];

    // Belongs to Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
