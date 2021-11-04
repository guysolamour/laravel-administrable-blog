@extends(back_view_path('layouts.base'))

@section('title', Lang::get('administrable-blog::translations.default.edition'))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>{{ Lang::get('administrable-blog::translations.default.edition') }}</h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.tag.index') }}">{{ Lang::get('administrable-blog::translations.view.tags') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.tag.show', $tag) }}">{{ $tag->name }}</a></li>
                            <li class="breadcrumb-item active">{{ Lang::get('administrable-blog::translations.default.edition') }}</li>
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
                <h3 class="card-title">{{ Lang::get('administrable-blog::translations.default.edition') }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="{{ Lang::get('administrable-blog::translations.default.minus') }}">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class='col-md-12'>
                        @include('administrable-blog::' . Str::lower(config('administrable.back_namespace')) . '.tags._form', ['edit' => true])
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
