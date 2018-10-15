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
        $attributes  = $this->getCreatePostAttributesFromRequest($request);
        $post = $postService->createPost($attributes);

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
        $user_id = $this->getUserId();
        $attributes = $this->getUpdatePostAttributesFromRequest($user_id, $id, $request);
        $post = $postService->updatePost($attributes);
        $post->save();

        return new PostResource($post);
    }

    /**
     * @param $post_id
     * @param PostService $postService
     * @return PostResource
     */
    public function getDeletePost($post_id, PostService $postService)
    {
        $attributes =  $this->getUserId();
        $post = $postService->deletePost($attributes)->findOrFail($post_id);
        $post->delete();

        return new PostResource($post);
    }
}