<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Disclaimer extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'description_id',
        'description_en',
        'created_at',
        'updated_at'
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
