<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "thumbnail",
        "province_id",
        "regency_id",
        "address",
        "date_start",
        "date_end",
        "desc",
        "slug",
        "maps"
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function province()
    {
        return $this->belongsTo("App\Models\Province", "regency_id");
    }

    public function regency()
    {
        return $this->belongsTo("App\Models\Regency", "regency_id");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
