<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ["title", "slug", "thumbnail", "content", "categori_id", "user_id", "status_id", 'min_read'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function categori()
    {
        return $this->belongsTo("App\Categori", "categori_id");
    }

    public function comments()
    {
        return $this->hasMany("App\Comment", "article_id");
    }

    public function view()
    {
        return $this->hasMany("App\View", "article_id");
    }

    public function status()
    {
        return $this->belongsTo("App\Status", "status_id");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
