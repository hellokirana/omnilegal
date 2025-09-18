<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Service extends Model 
{
    use HasUuids;

    protected $fillable = [
        'image',
        'title_id',
        'title_en',
        'description_id',
        'description_en',
        'status'
    ];

    protected $appends = ['image_url'];

    /* =====================
     *  Accessors
     * ===================== */

    protected function getLocalized($field)
    {
        $locale = app()->getLocale();
        $column = "{$field}_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->{$field . '_en'};
    }

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getDescriptionAttribute()
    {
        return $this->getLocalized('description');
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/service/' . $this->image)
            : 'https://loremflickr.com/800/600';
    }

    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }
}
