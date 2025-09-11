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

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/slider') . '/' . $this->image : 'https://loremflickr.com/1280/720?random=' . $this->no_urut;
    }

    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }

}
