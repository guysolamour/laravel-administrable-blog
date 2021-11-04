<?php

namespace Guysolamour\Administrable\Extensions\Blog\Forms\Back;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\Lang;

class PostForm extends Form
{
    public function buildForm()
    {

        if ($this->getModel() && $this->getModel()->getKey()) {
            $method = 'PUT';
            $url    = back_route('extensions.blog.post.update', $this->getModel());
        } else {
            $method = 'POST';
            $url    = back_route('extensions.blog.post.store');
        }

        $this->formOptions = [
            'method' => $method,
            'url'    => $url,
            'name'   => get_form_name($this->getModel()),
            'id'   => get_form_name($this->getModel()),
        ];

	    $this
            // add fields here

		    ->add('title','text', [
			      'label' => Lang::get('administrable-blog::translations.view.post.title'),
			      'rules' => 'required',
            ])
            ->add('author_id', 'entity', [
                "class" => get_guard_model_class(),
                "property" => 'first_name',
                "label" => Lang::get('administrable-blog::translations.view.post.author'),
                "rules" => 'required|exists:admins,id',
                'attr' => [
                    'class' => 'custom-select select2'
                ]

            ])
            ->add('allow_comment', 'select', [
                'choices' => ['1' => Lang::get('administrable-blog::translations.default.yes'), '0' => Lang::get('administrable-blog::translations.default.no')],
                'label' => Lang::get('administrable-blog::translations.view.post.allow_comment'),
                'rules' => 'required',
                'attr'  => [
                    'class' => 'custom-select select2'
                ]
            ])
		    ->add('content','textarea', [
                'label' => Lang::get('administrable-blog::translations.view.post.content'),
                'rules' => 'required',
                'attr' => [
                    'data-required',
                    'data-tinymce'
                ]
		    ])
        ;
    }
}
