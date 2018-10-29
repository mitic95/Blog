<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;

/**
 * Class PostsApiController
 * @package App\Http\Controllers
 */
class PostsApiController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return PostResource::collection($posts);
    }

    /**
     * @param $id
     * @return PostResource
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    /**
     * @param Request $request
     * @param PostService $postService
     * @return PostResource
     */
    public function store(Request $request, PostService $postService)
    {
        $postAttributes = $this->getCreatePostAttributesFromRequest($request);
        $post = $postService->createPost($postAttributes);

        return new PostResource($post);
    }

    /**
     * @param $id
     * @param Request $request
     * @param PostService $postService
     * @return PostResource
     */
    public function update($id, Request $request, PostService $postService)
    {
        $postAttributes = $this->getUpdatePostAttributesFromRequest($id, $request);
        $post = $postService->updatePost($postAttributes);

        return new PostResource($post);
    }

    /**
     * @param $post_id
     * @param PostService $postService
     * @return PostResource
     */
    public function getDeletePost($post_id, PostService $postService)
    {
        $attributes = $this->getDeletePostAttributes($post_id);
        $post = $postService->deletePost($attributes);

        return new PostResource($post);
    }
}