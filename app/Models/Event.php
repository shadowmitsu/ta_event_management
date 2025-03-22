<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'short_desc', 'long_desc', 'status', 'start_date', 'end_date', 'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function eventAssigns()
    {
        return $this->hasMany(EventAssign::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_assigns', 'event_id', 'user_id');
    }
    public function eventMedia()
    {
        return $this->hasMany(EventMedia::class);
    }

    public function reports()
    {
        return $this->hasMany(EventReport::class);
    }
}
