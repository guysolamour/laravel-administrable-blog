<?php

return [
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Testimonial
    |--------------------------------------------------------------------------
    |
    | The migrations folder in database directory
    */
    'migrations_path' => database_path('extensions/blog'),
    'models' => [
        'post'     =>  \Guysolamour\Administrable\Extensions\Blog\Models\Post::class,
        'category' =>  \Guysolamour\Administrable\Extensions\Blog\Models\Category::class,
        'tag'      =>  \Guysolamour\Administrable\Extensions\Blog\Models\Tag::class,
    ],
    'forms' => [
        'back' => [
            'post'     => \Guysolamour\Administrable\Extensions\Blog\Forms\Back\PostForm::class,
            'category' => \Guysolamour\Administrable\Extensions\Blog\Forms\Back\CategoryForm::class,
            'tag'      => \Guysolamour\Administrable\Extensions\Blog\Forms\Back\TagForm::class,
        ],
    ],
    'controllers' => [
        'back' => [
            'post'     =>  \Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Back\PostController::class,
            'category' =>  \Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Back\CategoryController::class,
            'tag'      =>  \Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Back\TagController::class,
        ],
        'front' => [
            'post' => \Guysolamour\Administrable\Extensions\Blog\Http\Controllers\Front\PostController::class
        ]
    ],
];
