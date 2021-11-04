<?php

namespace Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Lang;

class CategoryController extends BaseController
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = config('administrable-blog.models.category')::latest()->get();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(new (config('administrable-blog.models.category')), config('administrable-blog.forms.back.category'));

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm(new (config('administrable-blog.models.category')), config('administrable-blog.forms.back.category'));

        $form->redirectIfNotValid();

        config('administrable-blog.models.category')::create($request->all());

        flashy(Lang::get('administrable-blog::translations.controller.category.create'));

        return redirect_backroute('extensions.blog.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $category = config('administrable-blog.models.category')::where('slug', $slug)->firstOrFail();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $category = config('administrable-blog.models.category')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($category, config('administrable-blog.forms.back.category'));

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.categories.edit', compact('category', 'form'));
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
        $category = config('administrable-blog.models.category')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($category, config('administrable-blog.forms.back.category'));
        $form->redirectIfNotValid();

        $category->update($request->all());

        flashy(Lang::get('administrable-blog::translations.controller.category.update'));

        return redirect_backroute('extensions.blog.category.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $category = config('administrable-blog.models.category')::where('slug', $slug)->firstOrFail();

        $category->delete();

        flashy(Lang::get('administrable-blog::translations.controller.category.delete'));

        return redirect_backroute('extensions.blog.category.index');
    }

}
