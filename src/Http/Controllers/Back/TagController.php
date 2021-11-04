<?php

namespace Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Back;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Guysolamour\Administrable\Traits\FormBuilderTrait;
use Guysolamour\Administrable\Http\Controllers\BaseController;


class TagController extends BaseController
{
    use FormBuilderTrait;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $tags = config('administrable-blog.models.tag')::last()->get();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.tags.index', compact('tags'));
    }



    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $form = $this->getForm(new (config('administrable-blog.models.tag')), config('administrable.extensions.blog.tag.back.form'));

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.tags.create', compact('form'));
    }




    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $form = $this->getForm(new (config('administrable-blog.models.tag')), config('administrable.extensions.blog.category.back.form'));
        $form->redirectIfNotValid();

        config('administrable-blog.models.tag')::create($request->all());

        flashy(Lang::get('administrable-blog::translations.controller.tag.create'));

        return redirect_backroute('extensions.blog.tag.index');
    }





    /**
    * Display the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function show(string $slug)
    {
        $tag = config('administrable-blog.models.tag')::where('slug', $slug)->firstOrFail();

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.tags.show', compact('tag'));
    }



    /**
    * Show the form for editing the specified resource.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function edit(string $slug)
    {
        $tag = config('administrable-blog.models.tag')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($tag, config('administrable-blog.forms.back.tag'));

        return view('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.tags.edit', compact('form', 'tag'));
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
        $tag = config('administrable-blog.models.tag')::where('slug', $slug)->firstOrFail();

        $form = $this->getForm($tag, config('administrable-blog.forms.back.tag'));
        $form->redirectIfNotValid();
        $tag->update($request->all());

        flashy(Lang::get('administrable-blog::translations.controller.tag.update'));

        return redirect_backroute('extensions.blog.tag.index');
    }


    /**
    * Remove the specified resource from storage.
    *
    * @param  string  $slug
    * @return \Illuminate\Http\Response
    */
    public function destroy(string $slug)
    {
        $tag = config('administrable-blog.models.tag')::where('slug', $slug)->firstOrFail();

        $tag->delete();

        flashy(Lang::get('administrable-blog::translations.controller.tag.delete'));;

        return redirect_backroute('extensions.blog.tag.index');
    }

}
