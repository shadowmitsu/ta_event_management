<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReportFile extends Model
{
    use HasFactory;

    // Define fillable fields
    protected $fillable = [
        'event_report_id',
        'file_path',
    ];

    public function report()
    {
        return $this->belongsTo(EventReport::class);
    }
}
