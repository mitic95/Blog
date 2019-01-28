<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

/**
 * Class CommentsController
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Post $post)
    {
        $this->validate(request(), ['body' => 'required|min:2']);

        // $post->addComment(request('body'));
        // return back();
        // add a comment to a post

        if(!auth::user()){
            return redirect('/login');
        }

        Comment::create([
            'body' => request('body'),
            'post_id' => $post->id,
            'user_id' => auth::id()
        ]);

        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editComment($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::user() != $comment->user) {
            return redirect()->home();
        }

        return view('posts.editComment', compact('comment'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::user() != $comment->user) {
            return redirect()->home();
        }

        $comment->delete();

        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateComment($id, Request $request, PostService $postService)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $commentAttributes = $this->getUpdateCommentAttributesFromRequest($id, $request);
        $comment = $postService->updateComment($commentAttributes);

        session()->flash(
            'message', 'Your comment has now updated!'
        );

        return redirect()->route('show', ['id' => $comment->post_id]);
    }
}