<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCreatePostAttributesFromRequest(Request $request)
    {
        return [
            'user_id' => $this->getAuthUser()->id,
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ];
    }

    public function getUpdatePostAttributesFromRequest($user_id, $post_id, Request $request)
    {
        return [
            'user_id' => $user_id,
            'id' => $post_id,
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ];
    }

    /**
     * @return User
     */
    public function getAuthUser(): User
    {
        return Auth::user();
    }

    public function getUserId()
    {
        return [
            'user_id' => $this->getAuthUser()->id
        ];
    }
}