<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::prefix(config('administrable.auth_prefix_path') . "/extensions/") ->middleware(['web'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Blog
    |--------------------------------------------------------------------------
    */
    Route::name(Str::lower(config('administrable.back_namespace')) . '.extensions.blog.category.')->group(function () {
        Route::prefix('blog')->group(function () {
            Route::resource('categories', config('administrable-blog.controllers.back.category'))->names([
                'index'      => 'index',
                'show'       => 'show',
                'create'     => 'create',
                'store'      => 'store',
                'edit'       => 'edit',
                'update'     => 'update',
                'destroy'    => 'destroy',
            ]);
        });
    });

    Route::name(Str::lower(config('administrable.back_namespace')) . '.extensions.blog.tag.')->group(function () {
        Route::prefix('blog')->group(function () {
            Route::resource('tags', config('administrable-blog.controllers.back.tag'))->names([
                'index'      => 'index',
                'show'       => 'show',
                'create'     => 'create',
                'store'      => 'store',
                'edit'       => 'edit',
                'update'     => 'update',
                'destroy'    => 'destroy',
            ]);
        });
    });

    Route::name(Str::lower(config('administrable.back_namespace')) . '.extensions.blog.post.')->group(function () {
        Route::prefix('blog')->group(function () {
            Route::resource('posts', config('administrable-blog.controllers.back.post'))->names([
                'index'      => 'index',
                'show'       => 'show',
                'create'     => 'create',
                'store'      => 'store',
                'edit'       => 'edit',
                'update'     => 'update',
                'destroy'    => 'destroy',
            ]);

            // JS
            Route::post('posts/category', [config('administrable-blog.controllers.back.post'), 'addCategory'])->name('addcategory');
            Route::post('posts/tag', [config('administrable-blog.controllers.back.post'), 'addTag'])->name('addtag');
        });
    });

});
