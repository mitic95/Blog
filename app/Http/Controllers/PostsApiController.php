<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;

class PostsApiController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    public function store(Request $request, PostService $postService)
    {
        $attributes  = $this->getCreatePostAttributesFromRequest($request);
        $post = $postService->createPost($attributes);

        return new PostResource($post);
    }

    public function update($id, Request $request, PostService $postService)
    {
        $user_id = $this->getUserId();
        $attributes = $this->getUpdatePostAttributesFromRequest($user_id, $id, $request);
        $post = $postService->updatePost($attributes);
        $post->save();

        return new PostResource($post);
    }

    public function getDeletePost($post_id, PostService $postService)
    {
        $attributes =  $this->getUserId();
        $post = $postService->deletePost($attributes)->findOrFail($post_id);
        $post->delete();

        return new PostResource($post);
    }
}