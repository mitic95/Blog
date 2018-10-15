<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;

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
        return view('registration.create');
    }

    /**
     * @param RegistrationForm $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegistrationForm $form)
    {
        $form->persist();

        session()->flash('message', 'Thanks so much for singig up!');

        // Redirect to the home page.
        return redirect()->home();
    }
}