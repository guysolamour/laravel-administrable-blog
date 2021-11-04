@extends(back_view_path('layouts.base'))


@section('title', Lang::get('administrable-blog::translations.view.tag.add'))


@section('content')
<div class="main-content">
    <div class="card ">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end" style="padding-top:10px;padding-right:20px;">
             <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                  <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.tag.index') }}">{{ Lang::get('administrable-blog::translations.view.tags') }}</a></li>
                  <li class="breadcrumb-item active">{{ Lang::get('administrable-blog::translations.view.tag.add') }}</li>
              </ol>
        </nav>
    </div>

    <div class="card">
        <h4 class="card-title">
            {{ Lang::get('administrable-blog::translations.view.tag.add') }}
        </h4>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.tags._form')
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
