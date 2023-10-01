<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    protected $table = 'activity_log';

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    public function getFormattedSubjectTypeAttribute()
    {
        $parts = explode('\\', $this->subject_type);
        return end($parts);
    }
    public function getCreatedAtFormattedAttribute()
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->created_at)->isoFormat('LLLL');
    }

    public function getOldAttribute()
    {
        return json_decode($this->properties['old'], true);
    }

    public function getAttributesAttribute()
    {
        return json_decode($this->properties['attributes'], true);
    }
}
