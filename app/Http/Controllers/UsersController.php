<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function avatar()
    {
        return view('users.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('img');
        $fileName = md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('avatars'), $fileName);

        user()->avatar = '/avatars/'.$fileName;
        user()->save();

        return ['url' => user()->avatar];
    }
}
