<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'media_type', // Could be an image, video, document, etc.
        'file_path', // Path to the uploaded media
    ];

    // Belongs to Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
