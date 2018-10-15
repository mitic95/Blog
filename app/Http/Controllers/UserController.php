<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();

        if(!auth::user()){
            return redirect('/login');
        }

        return view('posts.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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