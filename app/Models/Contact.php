<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    public $incrementing = false;
    protected $keyType = 'string'; // untuk UUID

    protected $fillable = ['name', 'email', 'subject', 'message', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    protected function getLocalized($field)
    {
        $locale = app()->getLocale();
        $column = "{$field}_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->{$field . '_en'};
    }
}

