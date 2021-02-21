<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    protected $fillable = ["name", "slug"];
    protected $table = "categories";

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function donations()
    {
        return $this->belongsToMany('App\Donation');
    }
}
