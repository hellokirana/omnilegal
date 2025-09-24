<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, HasUuids;
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

    public function getTitleAttribute()
    {
        return $this->getLocalized('title');
    }

    public function getContentAttribute()
    {
        return $this->getLocalized('content');
    }

    public function getSlugAttribute()
    {
        return $this->getLocalized('slug');
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
            'slug_id' => ['source' => 'title_id'],
            'slug_en' => ['source' => 'title_en'],
        ];
    }
}
