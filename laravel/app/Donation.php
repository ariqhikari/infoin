<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'thumbnail', 'min_dana', 'max_dana',  'content', 'donation_end', 'status_id', 'slug'
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function status()
    {
        return $this->belongsTo("App\Status", "status_id");
    }

    public function categories()
    {
        return $this->belongsToMany('App\Categori');
    }

    public function donation_details()
    {
        return $this->hasMany('App\DonationDetail');
    }
}
