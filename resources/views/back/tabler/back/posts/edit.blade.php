@extends(back_view_path('layouts.base'))


@section('title' , Lang::get('administrable-blog::translations.default.edition'))


@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.post.index') }}">{{ Lang::get('administrable-blog::translations.view.posts') }}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ back_route('extensions.blog.post.show', $post) }}">{{ $post->title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-blog::translations.default.edition') }}</a></li>
            </ol>

            <div class="btn-group">
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
            {{ Lang::get('administrable-blog::translations.default.edition') }}
        </h3>
        @include('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.posts._form')
    </div>
</div>
@endsection

