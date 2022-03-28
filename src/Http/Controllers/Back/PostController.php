<?php

namespace Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;

class PostController extends BaseController
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = config('administrable-blog.models.post')::with(['categories', 'tags'])->last()->get();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new (config('administrable-blog.models.post'));
        $post->setRelation('categories', collect());
        $post->setRelation('tags', collect());

        $form = $this->getForm($post, config('administrable-blog.forms.back.post'));

        $categories = config('administrable-blog.models.category')::latest()->get();

        $tags = config('administrable-blog.models.tag')::latest()->get();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.posts.create', compact('form', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(new (config('administrable-blog.models.post')), config('administrable-blog.forms.back.post'));
        $form->redirectIfNotValid();

        config('administrable-blog.models.post')::create($request->all());

        // flashy(Lang::get('administrable-blog::translations.controller.post.create'));
        return redirect_backroute('extensions.blog.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $post = config('administrable-blog.models.post')::where('slug', $slug)->firstOrFail();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $post = config('administrable-blog.models.post')::where('slug', $slug)->firstOrFail();

        $post->load(['categories', 'tags']);

        $form = $this->getForm($post, config('administrable-blog.forms.back.post'));

        $categories = config('administrable-blog.models.category')::last()->get();

        $tags  = config('administrable-blog.models.tag')::last()->get();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.posts.edit', compact('post', 'form', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug)
    {
        $post = config('administrable-blog.models.post')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($post, config('administrable-blog.forms.back.post'));
        $form->redirectIfNotValid();

        $post->update($request->all());

        flashy(Lang::get('administrable-blog::translations.controller.post.update'));

        return redirect_backroute('extensions.blog.post.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $post = config('administrable-blog.models.post')::where('slug', $slug)->firstOrFail();

        $post->delete();

        flashy(Lang::get('administrable-blog::translations.controller.post.delete'));

        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $category = config('administrable-blog.models.category')::create($data);

        return $category;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTag(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        $tag = config('administrable-blog.models.tag')::create($data);

        return $tag;
    }

}
