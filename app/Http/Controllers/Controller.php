<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return array
     */
    public function getCreatePostAttributesFromRequest(Request $request)
    {
        return [
            'user_id' => $this->getAuthUser()->id,
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ];
    }

    /**
     * @param $post_id
     * @param Request $request
     * @return array
     */
    public function getUpdatePostAttributesFromRequest($post_id, Request $request)
    {
        return [
            'user_id' => $this->getAuthUser()->id,
            'id' => $post_id,
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ];
    }

    /**
     * @param $post_id
     * @return array
     */
    public function getDeletePostAttributes($post_id)
    {
        return [
            'user_id' => $this->getAuthUser()->id,
            'id' => $post_id
        ];
    }

    /**
     * @return User
     */
    public function getAuthUser(): User
    {
        return Auth::user();
    }

    /**
     * @param int $id
     * @return string
     */
    public function generatePostKey(int $id): string
    {
        return 'post_' . $id;
    }
}