<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'email', 'subject', 'message', 'aplication'];

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
    public function getAplicationUrlAttribute()
    {
        return $this->aplication
            ? asset('storage/careers/' . $this->aplication)
            : null;
    }
}

