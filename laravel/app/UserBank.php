<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "bank_id", "no_rekening", "nama_rekening"];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function bank()
    {
        return $this->belongsTo("App\Bank", "bank_id");
    }
}
