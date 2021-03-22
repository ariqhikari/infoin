<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriDonation extends Model
{
    use HasFactory;

    protected $table = "categori_donation";

    protected $fillable = [
        'categori_id', 'donation_id'
    ];
}
