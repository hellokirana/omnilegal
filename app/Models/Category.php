<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasUuids;
    protected $table = 'categories';

    protected $fillable = [
        'title_id',
        'title_en',
        'status',
    ];

    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        $field = "title_" . $locale;

        if (in_array($locale, ['id', 'en']) && !empty($this->{$field})) {
            return $this->{$field};
        }

        // fallback ke EN
        return $this->title_en;
    }


    public function getStatusTextAttribute()
    {
        $status = status_active();
        return isset($status[$this->status]) ? $status[$this->status] : '';
    }

    public function news(): HasMany
    {
        return $this->HasMany(News::class, 'category_id');
    }
}
