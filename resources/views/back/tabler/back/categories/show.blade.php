@extends(back_view_path('layouts.base'))


@section('title', $category->name)


@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.category.index') }}">{{ Lang::get('administrable-blog::translations.view.categories') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $category->name }}</a></li>
            </ol>

            <div class="btn-group">
                <a href="{{ back_route('extensions.blog.category.edit', $category) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>&nbsp;  {{ Lang::get('administrable-blog::translations.default.edit') }}</a>
                <a href="{{ back_route('extensions.blog.category.destroy', $category) }}" class="btn btn-danger" data-method="delete"
                    data-confirm="{{ Lang::get('administrable-blog::translations.view.category.destroy') }}">
                    <i class="fas fa-trash"></i>&nbsp;  {{ Lang::get('administrable-blog::translations.default.delete') }}</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h3 class="title-5 m-b-35">

        </h3>
        <div class="row">
            <div class="col-md-12">
                {{-- add fields here --}}
                <div class="pb-2">
                    <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.category.name') }}:</span></p>
                    <p>
                        {{ $category->name }}
                    </p>
                </div>

                <div class="pb-2">
                    <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.category.created_at') }}:</span></p>
                    <p>
                        {{ $category->created_at->format('d/m/Y h:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
