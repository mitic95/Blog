<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * Class SessionsController
 * @package App\Http\Controllers
 */
class SessionsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()){
            return redirect()->home();
        }

        return view('sessions.create');
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if (Auth::user()){
            return redirect()->home();
        }

        // Attempt to authenticate the user.
        // If not, redirect back.
        // If so, sign them in.

        if(! auth()->attempt(request(['email', 'password']))) {

            return back()->withErrors([

                'message' => 'Please check your credentials and try again.'

            ]);

        }
        return redirect()->home();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}