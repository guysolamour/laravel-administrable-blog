<?php

namespace Guysolamour\Administrable\Extensions\Blog\Forms\Back;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\Lang;

class CategoryForm extends Form
{
    public function buildForm()
    {
        if ($this->getModel() && $this->getModel()->getKey()) {
            $method = 'PUT';
            $url    = back_route('extensions.blog.category.update', $this->getModel());
        } else {
            $method = 'POST';
            $url    = back_route('extensions.blog.category.store');
        }

        $this->formOptions = [
            'method' => $method,
            'url'    => $url,
            'name'   => get_form_name($this->getModel()),
        ];

	      $this
           // add fields here
            ->add('name', 'text', [
                'label'  => Lang::get('administrable-blog::translations.view.category.name'),

                'rules' => ['required', 'string',],
            ])
        ;
    }
}
