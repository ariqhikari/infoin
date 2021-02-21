<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Visitor;
use App\Eo_Verification;
use Auth;
use App\Chat;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google_id', 'slug', 'avatar', 'phone', 'role_id', 'status', 'token', 'email_verified_at', 'blacklist'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function sendEmailVerificationNotification($token)
    // {
    //     $this->notify(new \App\Notifications\MailVerifyEmailNotification($token));
    // }

    public function role()
    {
        return $this->belongsTo("App\Role", "role_id");
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function recentLogin()
    {
        return $this->hasMany("App\Visitor", "user_id");
    }

    public function eo_verifications()
    {
        return $this->hasMany("App\Eo_Verification", "user_id");
    }

    public function lastLogin()
    {
        $recent = Visitor::where("user_id", Auth::id())->get();
        if ($recent->count() >= 2) {
            $last = $recent[\sizeof($recent) - 2]->created_at->diffForHumans();
        } else if ($recent->count() < 2 && $recent->count() > 0) {
            $last = $recent[\sizeof($recent) - 1]->created_at->diffForHumans();
        } else {
            $last = 0;
        }
        return $last;
    }

    public function verifications()
    {
        $vr = Eo_Verification::where("user_id", Auth::id())->first();
        return $vr;
    }

    public function adminNotification()
    {
        $verifications = Eo_Verification::where("status_read", 0)->latest()->get();
        return $verifications;
    }

    public function ktp()
    {
        $ktp = Eo_Verification::where("user_id", $this->id)->first();
        return $ktp->ktp;
    }

    public function articles()
    {
        return $this->hasMany("App\Article", "user_id");
    }

    public function comments()
    {
        return $this->hasMany("App\Comment", "user_id");
    }

    public function sender()
    {
        return $this->hasMany("App\Chat", "sender_id");
    }

    public function receiver()
    {
        return $this->hasMany("App\Chat", "receiver_id");
    }

    public function unread()
    {
        $data = Chat::get();
        $unread = 0;

        foreach ($data as $key => $value) {
            if ($value->sender_id == $this->id && $value->receiver_id == Auth::id()) {
                if ($value->status == 0) {
                    $unread += 1;
                }
            }
        }

        return $unread;
    }

    public function globalUnread()
    {
        $unread = 0;
        foreach ($this->receiver as $key => $value) {
            if ($value->status == 0) {
                $unread += 1;
            }
        }

        return $unread;
    }

    public function userBanks()
    {
        return $this->hasMany("App\UserBank", "user_id");
    }

    public function donations()
    {
        return $this->hasMany("App\Donation", "user_id");
    }

    public function detailDonations()
    {
        return $this->hasMany("App\DonationDetail", "user_id");
    }

    public function events()
    {
        return $this->hasMany("App\Event", "user_id");
    }
}
