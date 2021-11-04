@extends(back_route_path('layouts.base'))

@section('title' , Lang::get('administrable-blog::translations.default.edition'))


@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route(config('administrable.guard') . '.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ back_route('extensions.blog.post.index') }}">{{ Lang::get('administrable-blog::translations.view.posts') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ back_route('extensions.blog.post.show', $post) }}">{{ $post->title }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-blog::translations.default.edition') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">{{ Lang::get('administrable-blog::translations.default.edition') }}</h3>
                        <div class="btn-group">
                            <a href="{{ back_route('extensions.blog.post.destroy', $post) }}" class="btn btn-danger" data-method="delete"
                                data-confirm="{{ Lang::get('administrable-blog::translations.view.post.destroy') }}">
                                <i class="fas fa-trash"></i>&nbsp; {{ Lang::get('administrable-blog::translations.default.delete') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.posts._form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
