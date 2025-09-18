<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasUuids;

    protected $fillable = [
        'url',
        'nama',
        'caption',
        'favicon',
        'logo',
        'maps',
        'phone',
        'email',
        'address_id',
        'address_en',
        'facebook',
        'instagram',
        'linkedin',
        'x',
    ];

    protected $appends = [
        'logo_url',
        'favicon_url',
        'address'
    ];

    /* =====================
     *  Accessors
     * ===================== */

    // bilingual address
    public function getAddressAttribute()
    {
        $locale = app()->getLocale();
        $column = "address_{$locale}";

        return !empty($this->{$column})
            ? $this->{$column}
            : $this->address_en; // fallback ke EN
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? asset('storage/website/' . $this->logo)
            : asset('default/logo.png'); // fallback default
    }

    public function getFaviconUrlAttribute()
    {
        return $this->favicon
            ? asset('storage/website/' . $this->favicon)
            : asset('default/favicon.ico'); // fallback default
    }
}
