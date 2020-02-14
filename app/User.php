<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Skybluesofa\Followers\Models\Follower;
use Skybluesofa\Followers\Traits\Followable;
use Skybluesofa\Microblog\Model\Traits\MicroblogAuthor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use Followable;
    use MicroblogAuthor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function getBlogFriends()
    {
        // Return null to get all users
        //return null;
        //DB::enableQueryLog();
        // Return an array to get specific user ids
        $friends = Follower::whereFollowing(Auth::user())->pluck('sender_id');
        return $friends;
        //dd(DB::getQueryLog());
        // return [1,2,3];
    
        // Return an empty array to get no user ids (no one else)
        //return [];
    }
}
