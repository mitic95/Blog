<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function profile(){

        $user = Auth::user();

        return view('posts.profile', compact('user'));

    }

    public function update_avatar(Request $request){

        // handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');

            $filename = Storage::disk('public_avatars')->putFile('', $avatar);

            $user = Auth::User();
            $user->avatar = $filename;
            $user->save();

            return redirect('/profile');
        }

        return view('posts.profile', compact('user'));
    }
}
/*

        if(Input::file('avatar'))
        {

            $image = Input::file('avatar');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/uploads/avatars/' . $filename);
            Image::make($image->getRealPath())->resize(200, 200)->save($path);
            $user = Auth::user();
            $user->image = $filename;
            $user->save();
        }

        return view('profile', compact('user'));

*/