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

    protected $appends = ['logo_url', 'favicon_url'];

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/website/' . $this->logo) : '';
    }

    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? asset('storage/website/' . $this->favicon) : '';
    }

}
