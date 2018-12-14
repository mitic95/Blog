<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use Illuminate\Support\Facades\Auth;

/**
 * Class RegistrationController
 * @package App\Http\Controllers
 */
class RegistrationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()){
            return redirect()->home();
        }
        return view('registration.create');
    }

    /**
     * @param RegistrationForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegistrationForm $form)
    {
        if (Auth::user()){
            return redirect()->home();
        }

        $form->persist();

        session()->flash('message', 'Thanks so much for singig up!');

        // Redirect to the home page.
        return redirect()->home();
    }
}