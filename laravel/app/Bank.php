<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ["name", "logo", "status"];

    public function userBanks()
    {
        return $this->hasMany("App\UserBank", "bank_id");
    }
}
