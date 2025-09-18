<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Description extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'about_id',
        'about_en',
        'short_about_id',
        'short_about_en',
        'team_id',
        'team_en',
        'career_id',
        'career_en',
        'service_id',
        'service_en',
        'practice_id',
        'practice_en',
        'disclaimer_id',
        'disclaimer_en',
    ];

    protected function getLocalized($field)
    {
        $locale = app()->getLocale();
        $column = "{$field}_{$locale}";

        if (in_array($locale, ['id', 'en']) && !empty($this->{$column})) {
            return $this->{$column};
        }

        return $this->{$field . '_en'};
    }


    public function getAboutAttribute()
    {
        return $this->getLocalized('about');
    }

    public function getShortAboutAttribute()
    {
        return $this->getLocalized('short_about');
    }

    public function getTeamAttribute()
    {
        return $this->getLocalized('team');
    }

    public function getCareerAttribute()
    {
        return $this->getLocalized('career');
    }

    public function getServiceAttribute()
    {
        return $this->getLocalized('service');
    }

    public function getPracticeAttribute()
    {
        return $this->getLocalized('practice');
    }

    public function getDisclaimerAttribute()
    {
        return $this->getLocalized('disclaimer');
    }
}
