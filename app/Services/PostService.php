<?php

namespace App\Services;

use App\Comment;
use App\Post;
use App\User;

/**
 * Class PostService
 * @package App\Services
 */
class PostService
{
    /**
     * @param array $attributes
     * @return Post
     */
    public function createPost(array $attributes): Post
    {
        /** @var Post $post */
        $post = new Post($attributes);
        $post->save();

        return $post;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function updatePost(array $attributes)
    {
        $id = $attributes['id'];
        $user_id = $attributes['user_id'];
        $post = Post::where('user_id', $user_id)->findOrFail($id);
        $post->title = $attributes['title'];
        $post->body = $attributes['body'];
        $post->save();

        return $post;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function deletePost(array $attributes)
    {
        $user_id = $attributes['user_id'];
        $post_id = $attributes['id'];
        $post = Post::where('user_id', $user_id)->findOrFail($post_id);
        $post->delete();

        return $post;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function updateUser(array $attributes)
    {
        $id = $attributes['id'];
        $user = User::where('id', $id)->findOrFail($id);
        $user->name = $attributes['name'];
        $user->save();

        return $user;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function updateComment(array $attributes)
    {
        $id = $attributes['id'];
        $user_id = $attributes['user_id'];
        $comment = Comment::where('user_id', $user_id)->findOrFail($id);
        $comment->body = $attributes['body'];
        $comment->save();

        return $comment;
    }
}