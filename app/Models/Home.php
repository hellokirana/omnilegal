<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Home extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title_id',
        'title_en',
        'description_id',
        'description_en'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Ambil title sesuai locale (default EN)
     */
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        $column = "title_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->title_en;
    }

    /**
     * Ambil description sesuai locale (default EN)
     */
    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        $column = "description_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->description_en;
    }
}
