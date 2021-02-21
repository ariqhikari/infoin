<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eo_Verification extends Model
{
    protected $fillable = ["user_id","ktp","status","status_read"];
    protected $table = "eo_verifications";

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }
}
