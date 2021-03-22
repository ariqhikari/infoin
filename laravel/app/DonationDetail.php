<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id', 'user_id', 'donasi', 'pesan', 'nama_rekening', 'bukti_pembayaran'
    ];

    protected $hidden = [];

    public function donation()
    {
        return $this->hasOne(Donation::class, 'id', 'donation_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
