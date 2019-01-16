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
     * @param Request $request
     * @return array
     */
    public function getUpdateUserAttributesFromRequest(Request $request)
    {
        return [
            'id' => $this->getAuthUser()->id,
            'name' => $request->input('name')
        ];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function getUpdateCommentAttributesFromRequest($id, Request $request)
    {
        return [
            'user_id' => $this->getAuthUser()->id,
            'id' => $id,
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

    /**
     * @param int $id
     * @return string
     */
    public function generatePostKey(int $id): string
    {
        return 'post_' . $id;
    }

    /**
     * @param array $requestData
     * @return string
     */
    protected function buildPostsCacheKey(array $requestData)
    {
        $key = 'posts_order_by_created_at_';

        $page = 1;

        if (array_key_exists('month', $requestData) && array_key_exists('year', $requestData)) {
            $key .= $requestData['month'] . '_' . $requestData['year'] . '_';
        }

        if (array_key_exists('page', $requestData)) {
            $page = $requestData['page'];
        }

        $key .= $page;

        return $key;
    }
}