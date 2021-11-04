<?php

namespace Guysolamour\Administrable\Extensions\Blog\Models;

use Guysolamour\Administrable\Models\BaseModel;
use Guysolamour\Administrable\Traits\SluggableTrait;

class Category extends BaseModel
{
    use SluggableTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'extensions_blog_categories';


    protected $sluggablefield = 'name';


    // add relation methods below

    public function posts()
    {
        return $this->belongsToMany(config('administrable-blog.models.post'), 'extensions_blog_post_category');
    }
}
