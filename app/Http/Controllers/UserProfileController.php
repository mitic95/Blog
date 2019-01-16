<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserProfileController
 * @package App\Http\Controllers
 */
class UserProfileController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update_avatar(Request $request)
    {
        $this->validate($request, [
           'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $directory = 'public_avatars';

            $filename = Storage::disk($directory)->putFile('', $avatar);

            $user = Auth::User();
            $user->avatar = $filename;
            $user->save();
        }

        return view('posts.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @param PostService $postService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update_name(Request $request, PostService $postService)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:30'
        ]);

        if($request->has('name')){
            $userAttributes = $this->getUpdateUserAttributesFromRequest($request);
            $user = $postService->updateUser($userAttributes);
        }

        return view('posts.profile', compact('user'));
    }
}