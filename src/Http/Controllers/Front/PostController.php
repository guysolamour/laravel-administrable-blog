<?php

namespace Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Front;

use Illuminate\Http\Request;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $page = get_meta_page('blog');

        $posts = config('administrable-blog.models.post')::online()->with('categories')->latest()->paginate(9);

        $categories = config('administrable-blog.models.category')::withCount('posts')->latest()->get();

        return front_view('extensions.blog.index', compact('page', 'posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = config('administrable-blog.models.post')::where('slug', $slug)->firstOrFail();

        return front_view('extensions.blog.show', compact('post'));
    }

    public function category(string $slug)
    {
        $category = config('administrable-blog.models.category')::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->online()->with('categories', 'approvedComments')->latest()->paginate(5);

        return front_view('extensions.blog.category', compact('category', 'posts'));
    }

    public function tag(string $slug)
    {
        $tag = config('administrable-blog.models.tag')::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()->online()->with('tags', 'approvedComments')->latest()->paginate(5);

        return front_view('extensions.blog.tag', compact('tag', 'posts'));
    }

    public function search(Request $request)
    {
        $q = strtolower($request->get('q'));

        $posts = config('administrable-blog.models.post')::online()->with('categories', 'approvedComments')
                 ->where('title', 'LIKE', '%' . $q . '%')
                    ->orWhere('content', 'LIKE', '%' . $q . '%')
                    ->paginate(9);

        $posts->withPath(route(front_route_path('extensions.blog.search'), compact('q')));
        $page = get_meta_page('search');

        return front_view('extensions.blog.search', compact('posts', 'page'));
    }

}
