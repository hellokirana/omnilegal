<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Description extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'about_id',
        'about_en',
        'short_about_id',
        'short_about_en',
        'team_id',
        'team_en',
        'career_id',
        'career_en',
        'service_id',
        'service_en',
        'practice_id',
        'practice_en',
        'disclaimer_id',
        'disclaimer_en',
    ];
}
