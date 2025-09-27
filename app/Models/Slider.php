<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'queue',
        'title_id',
        'title_en',
        'description_id',
        'description_en',
        'image',
        'link',
        'link_caption_id',
        'link_caption_en',
        'status',
    ];

    protected $appends = ['image_url'];

    /* =====================
     *  Accessors Bilingual
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

    public function getLinkCaptionAttribute()
    {
        return $this->getLocalized('link_caption');
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/slider/' . $this->image)
            : null;
    }


    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }
}
