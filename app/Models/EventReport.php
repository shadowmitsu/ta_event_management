<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReport extends Model
{
    use HasFactory;

    // Define fillable fields
    protected $fillable = [
        'event_id',
        'user_id',
        'report_content',
        'additional_link',
    ];

    public function files()
    {
        return $this->hasMany(EventReportFile::class);
    }

    public function mediaFiles()
    {
        return $this->hasMany(EventReportFile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
