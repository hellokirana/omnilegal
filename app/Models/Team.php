<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Cviebrock\EloquentSluggable\Sluggable;

class Team extends Model
{
    use HasUuids, Sluggable;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'slug',
        'position_id',
        'position_en',
        'description_id',
        'description_en',
        'email',
        'image',
        'status'
    ];

    protected $appends = ['image_url', 'position', 'description'];

    /* =====================
     *  Accessor bilingual
     * ===================== */
    public function getPositionAttribute()
    {
        $locale = app()->getLocale();
        $column = "position_{$locale}";
        return !empty($this->{$column}) ? $this->{$column} : $this->position_en;
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        $column = "description_{$locale}";
        return !empty($this->{$column}) ? $this->{$column} : $this->description_en;
    }

    /* =====================
     *  Accessor image
     * ===================== */
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/team/' . $this->image)
            : 'https://loremflickr.com/800/600';
    }

    /* =====================
     *  Slug config
     * ===================== */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }
}
