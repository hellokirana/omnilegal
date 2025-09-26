<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, HasUuids, Sluggable;
    protected $table = 'news';
    public $timestamps = true;
    protected $fillable = [
        'category_id',
        'title_id',
        'title_en',
        'author',
        'content_id',
        'content_en',
        'slug_id',
        'slug_en',
        'image',
        'image_caption',
        'document_id',
        'document_en',
        'status',
        'created_at'
    ];

    protected $appends = [
        'image_url',
        'document_id_url',
        'document_en_url',
    ];

    /* =====================
     *  Accessors
     * ===================== */

    // Ambil field bilingual sesuai locale
    protected function getLocalized($field)
    {
        $locale = app()->getLocale();
        $column = "{$field}_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->{$field . '_en'};
    }

    // Ambil title sesuai locale target
    public function getTitleByLocale($locale)
    {
        $column = 'title_' . $locale;
        return $this->{$column} ?: $this->title_en;
    }

    // Ambil content sesuai locale target
    public function getContentByLocale($locale)
    {
        $column = 'content_' . $locale;
        return $this->{$column} ?: $this->content_en;
    }

    // Ambil slug sesuai locale target
    public function getSlugByLocale($locale)
    {
        $column = 'slug_' . $locale;
        return $this->{$column} ?: $this->slug_en;
    }



    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{'title_' . $locale};
    }

    public function getSlugAttribute()
    {
        $locale = app()->getLocale();
        return $this->{'slug_' . $locale};
    }

    public function getContentAttribute()
    {
        $locale = app()->getLocale();
        return $this->{'content_' . $locale};
    }

    public function getDocumentAttribute()
    {
        return $this->getLocalized('document');
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/news/' . $this->image)
            : 'https://loremflickr.com/800/600';
    }

    public function getDocumentIdUrlAttribute()
    {
        return $this->document_id
            ? asset('storage/news/' . $this->document_id)
            : null;
    }

    public function getDocumentEnUrlAttribute()
    {
        return $this->document_en
            ? asset('storage/news/' . $this->document_en)
            : null;
    }

    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }

    /* =====================
     *  Relations
     * ===================== */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // kalau pakai package cviebrock/eloquent-sluggable
    public function sluggable(): array
    {
        return [
            'slug_id' => [
                'source' => 'title_id',
                'onUpdate' => true
            ],
            'slug_en' => [
                'source' => 'title_en',
                'onUpdate' => true
            ],
        ];
    }
}
