@extends(back_view_path('layouts.base'))


@section('title', $post->title)


@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.post.index') }}">{{ Lang::get('administrable-blog::translations.view.posts') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $post->title }}</a></li>
            </ol>

            <div class="btn-group">
                <a href="{{ back_route('extensions.blog.post.edit', $post) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>&nbsp; {{ Lang::get('administrable-blog::translations.default.edit') }}</a>
                <a href="{{ back_route('extensions.blog.post.destroy', $post) }}" class="btn btn-danger"
                    data-method="delete" data-confirm="{{ Lang::get('administrable-blog::translations.view.post.destroy') }}">
                    <i class="fas fa-trash"></i>&nbsp; {{ Lang::get('administrable-blog::translations.default.delete') }}</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h3 class="title-5 m-b-35">
            {{ Lang::get('administrable-blog::translations.view.posts') }}
        </h3>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    {{-- add fields here --}}
                    <div class="col-12">
                        <div class="pb-2">
                            <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.post.title') }}:</span></p>
                            <p>
                                {{ $post->title }}
                            </p>
                        </div>
                    </div>
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
                </div>


            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.post.publication') }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ Lang::get('administrable-blog::translations.view.post.online') }} : {{ $post->online ? {{ Lang::get('administrable-blog::translations.default.yes') }} : {{ Lang::get('administrable-blog::translations.default.no') }} }}</p>
                        <p>{{ Lang::get('administrable-blog::translations.view.post.allow_comment') }} : {{ $post->allow_comment ? {{ Lang::get('administrable-blog::translations.default.yes') }} : {{ Lang::get('administrable-blog::translations.default.no') }} }}</p>
                    </div>
                </div>
                <div class="card">

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
@endsection













