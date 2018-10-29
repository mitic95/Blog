<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'ajax']);
    }

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
     * @param int $id
     * @return string
     */
    public function generatePostKey(int $id): string
    {
        return 'post_' . $id;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = Cache::remember($this->generatePostKey($id), 20, function () use ($id)
        {
            if (Cache::has($this->generatePostKey($id) . $id)) {
                return Cache::get($this->generatePostKey($id) . $id);
            } else {
                return Post::find($id);
            }
        });

        return view('posts.show', compact('post'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::find($id);

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
            'body' => 'required'
        ]);

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

        return redirect('/');
    }

    /**
     * @param $post_id
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getDeletePost($post_id, PostService $postService)
    {
        $attributes = $this->getDeletePostAttributes($post_id);
        $postService->deletePost($attributes);

        Cache::delete($this->generatePostKey($post_id));
        Cache::flush();

        return redirect('/');
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