@extends(back_view_path('layouts.base'))

@section('title', $post->title)

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
                     <div class='float-sm-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.post.index') }}">{{ Lang::get('administrable-blog::translations.view.posts') }}</a></li>
                            <li class="breadcrumb-item active">{{ $post->title }}</li>
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
                    <div class="col-md-8">

                        <div class="col-12">
                            <section style="margin-bottom: 2rem;">

                                <div class="btn-group-horizontal">
                                    <a href="{{ back_route('extensions.blog.post.edit', $post) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                        title="Editer"><i class="fas fa-edit"></i>{{ Lang::get('administrable-blog::translations.default.edit') }}</a>
                                    <a href="{{ back_route('extensions.blog.post.destroy', $post) }}" data-method="delete"
                                        data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"
                                        data-confirm="{{ Lang::get('administrable-blog::translations.view.post.destroy') }}" class="btn btn-danger"><i
                                            class="fa fa-trash"></i> {{ Lang::get('administrable-blog::translations.default.delete') }}</a>
                                </div>
                            </section>
                            {{-- add fields here --}}
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
                    <div class='col-md-4'>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.post.publication') }}</h3>
                            </div>
                            <div class="card-body">
                                <p>{{ Lang::get('administrable-blog::translations.view.post.online') }} : {{ $post->online ? {{ Lang::get('administrable-blog::translations.default.yes') }} : {{ Lang::get('administrable-blog::translations.default.no') }} }}</p>
                                <p>{{ Lang::get('administrable-blog::translations.view.post.allow_comment') }} : {{ $post->allow_comment ? {{ Lang::get('administrable-blog::translations.default.yes') }} : {{ Lang::get('administrable-blog::translations.default.no') }} }}</p>

                            </div>
                        </div>
                        <div class="card card-secondary">

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
                            'model'      =>  $post,
                            'collection' =>  'front-image',
                        ])
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
