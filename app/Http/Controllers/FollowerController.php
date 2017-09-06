<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;
use App\Notifications\NewUserFollowNotification;

class FollowerController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index($id)
    {
        // 关注作者的人当中是否存在当前用户
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();
        if (in_array(user('api')->id, $followers)) {
            return response()->json(['followed' => true]);
        }
        // 当前用户关注的人之中是否存在作者
        // $followed = Auth::guard('api')->user()->followers()->pluck('followed_id')->toArray();
        // if (in_array($id, $followed)) {
        //     return response()->json(['followed' => true]);
        // }

        return response()->json(['followed' => false]);
    }

    public function follow()
    {
        $userToFollow = $this->user->byId(request('user'));

        $followed = user('api')->followThisUser($userToFollow->id);

        if (count($followed['attached']) > 0) {

            $userToFollow->notify(new NewUserFollowNotification());

            $userToFollow->increment('followers_count');

            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');

        return response()->json(['followed' => false]);
    }
}
