<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $table = 'news';
    public $incrementing = false;
    protected $keyType = 'string'; // untuk UUID

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
        'published_at',
    ];

    protected $dates = ['published_at'];

    protected $appends = ['image_url', 'document_id_url', 'document_en_url'];

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
