@extends(back_view_path('layouts.base'))


@section('title', Lang::get('administrable-blog::translations.view.posts') )

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>{{ Lang::get('administrable-blog::translations.view.posts')  }}</h1> --}}
                </div>
                <div class="col-sm-6">
                     <div class='float-sm-right'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ Lang::get('administrable-blog::translations.view.posts')  }}</li>
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
                    <div class="col-md-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.posts')  }}</h3>
                                        <div class="btn-group float-right">
                                            <a href="{{ back_route('extensions.blog.post.create') }}" class="btn  btn-primary"> <i
                                                    class="fa fa-plus"></i> {{ Lang::get('administrable-blog::translations.default.add') }}</a>
                                            <a href="#" class="btn btn-danger d-none" data-model="{{ config('administrable-blog.models.post') }}"
                                                id="delete-all"> <i class="fa fa-trash"></i> {{ Lang::get('administrable-blog::translations.default.deleteall') }}</a>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped" id="list">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="check-all">
                                                                <label class="custom-control-label"
                                                                    for="check-all"></label>
                                                            </div>
                                                        </th>
                                                        <th></th>
                                                        <th>{{ Lang::get('administrable-blog::translations.view.post.title') }}</th>
                                                        <th>{{ Lang::get('administrable-blog::translations.view.post.content') }}</th>
                                                        <th>{{ Lang::get('administrable-blog::translations.view.post.statut') }}</th>
                                                        <th>{{ Lang::get('administrable-blog::translations.view.categories') }}</th>
                                                        <th>{{ Lang::get('administrable-blog::translations.view.tags') }}</th>
                                                        <th>{{ Lang::get('administrable-blog::translations.view.post.created_at') }}</th>
                                                        {{-- add fields here --}}

                                                        <th>{{ Lang::get('administrable-blog::translations.view.post.actions') }}</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($posts as $post)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" data-check
                                                                    class="custom-control-input"
                                                                    data-id="{{ $post->id }}"
                                                                    id="check-{{ $post->id }}">
                                                                <label class="custom-control-label"
                                                                    for="check-{{ $post->id }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $post->title }}</td>
                                                        <td>{!! Str::limit(strip_tags($post->content),50) !!}</td>
                                                        <td>
                                                            @if ($post->isOnline())
                                                                <a data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.view.post.online') }}"><i class="fas fa-circle text-success" ></i></a>
                                                                @else
                                                                <a data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.view.post.offline') }}"><i class="fas fa-circle text-secondary" ></i></a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @forelse ($post->categories as $category)
                                                                <a href="{{ back_route('extensions.blog.category.show', $category) }}"
                                                                    class=" bg-azure p-2">{{ $category->name }}</a>
                                                            @empty
                                                                -
                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            @forelse ($post->tags as $tag)
                                                                <a href="{{ back_route('extensions.blog.tag.show', $tag) }}"
                                                                    class=" bg-azure p-2">{{ $tag->name }}</a>
                                                            @empty
                                                                -
                                                            @endforelse
                                                        </td>
                                                        <td>{{ $post->created_at?->format('d/m/Y h:i') }}</td>
                                                        {{-- add values here --}}
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ back_route('extensions.blog.post.show', $post) }}"
                                                                    class="btn btn-primary" data-toggle="tooltip"
                                                                    data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.show') }}"><i
                                                                        class="fas fa-eye"></i></a>

                                                                <a href="{{ back_route('model.clone', get_clone_model_params($post)) }}"
                                                                class="btn btn-secondary" data-toggle="tooltip"
                                                                data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.clone') }}"><i
                                                                    class="fas fa-clone"></i></a>

                                                                <a href="{{ back_route('extensions.blog.post.edit', $post) }}"
                                                                    class="btn btn-info" data-toggle="tooltip"
                                                                    data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i
                                                                        class="fas fa-edit"></i></a>
                                                                <a href="{{ back_route('extensions.blog.post.destroy', $post) }}"
                                                                    data-method="delete"
                                                                    data-confirm="{{ Lang::get('administrable-blog::translations.view.post.destroy') }}"
                                                                    class="btn btn-danger" data-toggle="tooltip"
                                                                    data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i
                                                                        class="fas fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


<x-administrable::datatable />
@deleteall()
@endsection
