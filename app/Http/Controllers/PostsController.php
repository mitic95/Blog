<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $cacheKey = $this->buildPostsCacheKey($request->all());

        $posts = Cache::remember($cacheKey, 20, function () {
            return Post::latest()
                ->filter(request(['month', 'year']))
                ->paginate(5);
        });

        return view('posts.index', compact('posts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajax(Request $request)
    {
        $cacheKey = $this->buildPostsCacheKey($request->all());

        $posts = Cache::remember($cacheKey, 20, function () {
            return Post::latest()
                ->filter(request(['month', 'year']))
                ->paginate(5);
        });

        return view('posts.product', compact('posts'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Cache::remember($this->generatePostKey($id), 20, function () use ($id)
        {
            return Post::find($id);
        });

        return view('posts.show', compact('post'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::user() != $post->user) {
            return redirect()->home();
        }

        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    /**
     * @param Request $request
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, PostService $postService)
    {
        $this->validate(request(), [
            'title' => 'required|max:30',
            'body' => 'required|min:5'
        ]);

        // $request->validate([
        // 'title' => 'required|max:30',
        // 'body' => 'required|min:5'
        // ]);

        $postAttributes = $this->getCreatePostAttributesFromRequest($request);
        $post = $postService->createPost($postAttributes);

        $post->tags()->sync($request->tags,false);

        Cache::delete('posts_order_by_created_at_1');
        Cache::flush();

        session()->flash(
            'message', 'Your post has now been published'
        );

        return redirect('/');
    }

    /**
     * @param $id
     * @param Request $request
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, PostService $postService)
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        $postAttributes = $this->getUpdatePostAttributesFromRequest($id, $request);
        $post = $postService->updatePost($postAttributes);

        $post->tags()->sync(request('tags'));

        Cache::delete($this->generatePostKey($id));
        Cache::flush();

        session()->flash(
            'message', 'Your post has now updated!'
        );

//        return redirect()->action('PostsController@show', ['id' => $id]);
        return redirect()->route('show', ['id' => $id]);
    }

    /**
     * @param $post_id
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getDeletePost($post_id, PostService $postService)
    {
        $attributes = $this->getDeletePostAttributes($post_id);
        $post = $postService->deletePost($attributes);

        $postComments = Comment::where('post_id', $post_id)->get();

        foreach($postComments as $comment){
            if($comment){
                $comment->delete();
            }
        }

        $post->tags()->detach();

        Cache::delete($this->generatePostKey($post_id));
        Cache::flush();

        return redirect('/');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('posts.about');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContact()
    {
        return view('posts.contact');
    }

    public function postContact(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10'
        ]);

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message //zato sto promenjiva $messace vec postoji tako da moramo da damo drugi naziv
        );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('marko.mitic@quantox.com');
            $message->subject($data['subject']);
        });

        //Session::flash('success', 'Your Email was Sent!'); // u ovo slucaju bi smo morali da koristimo facade: use Illuminate\Support\Facades\Session;
        session()->flash(
            'message', 'Your Email Was Sent!'
        );

        return redirect()->route('home');
    }
}