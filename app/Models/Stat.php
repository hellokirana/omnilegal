<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Stat extends Model
{
    use HasUuids;

    protected $fillable = [
        'label_id',
        'label_en',
        'value',
        'image',   // icon / gambar
        'status'
    ];

    protected $appends = ['image_url'];

    /* =====================
     *  Accessor bilingual
     * ===================== */
    public function getLabelAttribute()
    {
        $locale = app()->getLocale();
        $column = "label_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->label_en; // fallback EN
    }

    /* =====================
     *  Accessor image
     * ===================== */
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/stat/' . $this->image)
            : 'https://loremflickr.com/100/100/icon'; // default icon random
    }

    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }
}
