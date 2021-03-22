<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use \App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditProfile extends Controller
{

    public function storeDataUpdate($data, $user)
    {
        $slug_split = \explode("-", $user->slug);
        $slug = \Str::slug($data["name"]) . "-" . $slug_split[\sizeOf($slug_split) - 1];

        if ($data["avatar"] == null && $data["password"] == null) {
            $user->update([
                "name" => $data["name"],
                "slug" => $slug,
                "phone" => $data["phone"]
            ]);

            return true;
        } else if ($data["avatar"] == null) {
            $user->update([
                "name" => $data["name"],
                "slug" => $slug,
                "password" => \bcrypt($data["password"]),
                "phone" => $data["phone"]
            ]);

            return true;
        } else if ($data["password"] == null) {
            if ($user->avatar != null) {
                $this->deleteImage($user);
            }

            $avatar = $data['avatar']->storePublicly('assets/profile', 'public');

            if ($user->google_id) {
                $avatar = url('/storage/' . $avatar);
            }

            $user->update([
                "name" => $data["name"],
                "slug" => $slug,
                "avatar" => $avatar,
                "phone" => $data["phone"]
            ]);

            return true;
        } else {
            if ($user->avatar != null) {
                $this->deleteImage($user);
            }

            $avatar = $data['avatar']->storePublicly('assets/profile', 'public');

            if ($user->google_id) {
                $avatar = url('/storage/' . $avatar);
            }

            $user->update([
                "name" => $data["name"],
                "slug" => \Str::slug($data["name"]) . "-" . \Str::random(5),
                "avatar" => $avatar,
                "password" => \bcrypt($data["password"]),
                "phone" => $data["phone"]
            ]);

            return true;
        }
    }

    public function deleteImage($user)
    {
        if ($user->google_id) {
            $src = \Str::after($user->avatar, asset('storage/'));
            \Storage::disk('public')->delete($src);
        } else if (!Str::contains($user->avatar, 'avatar')) {
            Storage::disk('public')->delete($user->avatar);
        }
    }
}
