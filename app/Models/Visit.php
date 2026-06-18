<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visit extends Model
{
    protected $fillable = [
        'title', 'slug', 'location', 'story', 'visit_date', 'gmaps_link', 'instagram_link',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function images()
    {
        return $this->hasMany(VisitImage::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
