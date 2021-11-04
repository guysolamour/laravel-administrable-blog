@extends(back_view_path('layouts.base'))

@section('title', $tag->name)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1></h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') .'.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.tag.index') }}">{{ Lang::get('administrable-blog::translations.view.tags') }}</a></li>
                            <li class="breadcrumb-item active">{{ $tag->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="{{ Lang::get('administrable-blog::translations.default.minus') }}">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class='col-md-8'>
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
                    <div class='col-md-4'>
                        <section style="margin-bottom: 2rem;">
                            <div class="btn-group-horizontal">
                                <a href="{{ back_route('extensions.blog.tag.edit', $tag) }}" class="btn btn-info" data-toggle="tooltip"
                                    data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i class="fas fa-edit"></i>{{ Lang::get('administrable-blog::translations.default.edit') }}</a>
                                <a href="{{ back_route('extensions.blog.tag.destroy', $tag) }}" data-method="delete" data-toggle="tooltip"
                                    data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"
                                    data-confirm="{{ Lang::get('administrable-blog::translations.view.category.destroy') }}" class="btn btn-danger"><i
                                        class="fa fa-trash"></i> {{ Lang::get('administrable-blog::translations.default.delete') }}</a>
                            </div>
                        </section>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
