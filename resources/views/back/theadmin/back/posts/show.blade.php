@extends(back_view_path('layouts.base'))



@section('title',$post->title)



@section('content')
<div class="main-content">
    <div class="card ">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end" style="padding-top:10px;padding-right:20px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.post.index') }}">{{ Lang::get('administrable-blog::translations.view.posts') }}</a></li>
                <li class="breadcrumb-item active">{{ $post->title }}</li>
            </ol>
        </nav>

    </div>
    <div class="card shadow-1 ">
        <div class="row">
            <div class="col-md-8">
                <header class="card-header bg-lightest">
                    <div class="card-title flexbox w-100 align-items-center">
                        <div>
                            <h3 >{{ $post->title }}</h3>
                        </div>
                    </div>
                </header>


                <div class="card-body">
                    <div class="row">
                        {{-- add fields here --}}
                        <div class="col-6">
                            <div class="pb-2">
                                <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.categories') }}:</span></p>
                                <p>
                                    @forelse ($post->categories as $category)
                                        <a href="{{ back_route('extensions.blog.category.show', $category) }}"
                                            class=" bg-azure p-2">{{ $category->name }}</a>
                                    @empty
                                        -
                                    @endforelse
                                </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pb-2">
                                <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.tags') }}:</span></p>
                                <p>
                                    @forelse ($post->tags as $tag)
                                        <a href="{{ back_route('extensions.blog.tag.show', $tag) }}"
                                            class=" bg-azure p-2">{{ $tag->name }}</a>
                                    @empty
                                        -
                                    @endforelse
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="pb-2">
                                <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.post.content') }}:</span></p>
                                <p>
                                    {!! $post->content !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            {!! $post->content !!}
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-transparent bl-3 bt-3 border-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.post.publication') }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ Lang::get('administrable-blog::translations.view.post.online') }} : {{ $post->online ? {{ Lang::get('administrable-blog::translations.default.yes') }} : {{ Lang::get('administrable-blog::translations.default.no') }} }}</p>
                        <p>{{ Lang::get('administrable-blog::translations.view.post.allow_comment') }} : {{ $post->allow_comment ? {{ Lang::get('administrable-blog::translations.default.yes') }} : {{ Lang::get('administrable-blog::translations.default.no') }} }}</p>

                    </div>
                </div>
                <div class="card card-transparent bl-3 bt-3 border-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="publish_date">{{ Lang::get('administrable-blog::translations.view.post.publication_date') }}:</label>
                            <p>{{ $post->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="publish_time">{{ Lang::get('administrable-blog::translations.view.post.publication_time') }}: </label>
                            <p>{{ $post->created_at->format('h:i:s') }}</p>
                        </div>
                    </div>
                </div>
                @filemanagerShow([
                    'collection' => 'front-image',
                    'label'      => 'Image à la une',
                    'model'      => $post,
                ])
            </div>
        </div>
    </div>
</div>

<div class="fab fab-fixed">
    <button class="btn btn-float btn-primary" data-toggle="button">
        <i class="fab-icon-default ti-plus"></i>
        <i class="fab-icon-active ti-close"></i>
    </button>

    <ul class="fab-buttons">
        <li><a class="btn btn-float btn-sm btn-info" href="{{ back_route('extensions.blog.post.edit', $post) }}"
                data-provide="tooltip" data-placement="left" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i class="ti-pencil"></i> </a>
        </li>
        <li><a class="btn btn-float btn-sm btn-danger" href="{{ back_route('extensions.blog.post.destroy',$post) }}"
                data-provide="tooltip" data-placement="left" data-method="delete"
                data-confirm="{{ Lang::get('administrable-blog::translations.view.post.destroy') }}"
                title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i class="ti-trash"></i> </a></li>

    </ul>
</div>

@endsection
