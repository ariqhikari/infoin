<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["user_id", "article_id", "parent", "comment"];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function article()
    {
        return $this->belongsTo("App\Article", "article_id");
    }

    public function parent()
    {
        return $this->belongsTo("App\Comment", "parent");
    }

    public function childs()
    {
        return $this->hasMany("App\Comment", "parent");
    }
}
