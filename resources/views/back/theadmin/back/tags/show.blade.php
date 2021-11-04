@extends(back_view_path('layouts.base'))

@section('title', $tag->name)



@section('content')
<div class="main-content">
    <div class="card ">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end" style="padding-top:10px;padding-right:20px;">
            <ol class="breadcrumb">
                 <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                      <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.tag.index') }}">{{ Lang::get('administrable-blog::translations.view.tags') }}</a></li>
                      <li class="breadcrumb-item active">{{ $tag->name }}</li>
                  </ol>
            </ol>
        </nav>

    </div>

    <div class="card">
        {{-- <h4 class="card-title">
                {{ Lang::get('administrable-blog::translations.view.tags') }}
            </h4> --}}

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                {{-- add fields here --}}

                <div>
                    <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.tag.name') }}:</span></p>
                    <p>
                        {{ $tag->name }}
                    </p>
                </div>

                <div>
                    <p><span class="font-weight-bold">{{ Lang::get('administrable-blog::translations.view.tag.created_at') }}:</span></p>
                    <p>
                        {{ $tag->created_at->format('d/m/Y h:i') }}
                    </p>
                </div>


                </div>
                <div class="col-md-4">
                    <section style="margin-bottom: 2rem;">

                        <div class="btn-group-horizontal">
                            <a href="{{ back_route('extensions.blog.tag.edit', $tag) }}" class="btn btn-info"
                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i class="fas fa-edit"></i>{{ Lang::get('administrable-blog::translations.default.edit') }}</a>
                            <a href="{{ back_route('extensions.blog.tag.destroy', $tag) }}" data-method="delete"
                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"
                                data-confirm="{{ Lang::get('administrable-blog::translations.default.delete') }}" class="btn btn-danger"><i
                                    class="fa fa-trash"></i> {{ Lang::get('administrable-blog::translations.default.delete') }}</a>
                        </div>
                    </section>
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
            <li><a class="btn btn-float btn-sm btn-info" href="{{ back_route('extensions.blog.tag.edit', $tag) }}"  data-provide="tooltip" data-placement="left"
                    title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i class="ti-pencil"></i> </a></li>
            <li><a class="btn btn-float btn-sm btn-danger" href="{{ back_route('extensions.blog.tag.destroy',$tag) }}" data-method="delete" data-confirm="{{ Lang::get('administrable-blog::translations.default.delete') }}"   data-provide="tooltip"
                    data-placement="left" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i class="ti-trash"></i> </a></li>

        </ul>
    </div>
</div>

@endsection
