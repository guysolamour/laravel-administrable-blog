@extends(back_view_path('layouts.base'))


@section('title', Lang::get('administrable-blog::translations.view.posts') )


@section('content')

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-blog::translations.view.posts')  }}</a></li>
            </ol>

            <a href="{{ back_route('extensions.blog.post.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>&nbsp; {{ Lang::get('administrable-blog::translations.default.add') }}</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between mb-3">
            <h3> {{ Lang::get('administrable-blog::translations.view.posts')  }} </h3>
            <a href="#" class="btn btn-danger d-none" data-model="{{ config('administrable-blog.models.post') }}" id="delete-all"><i
                    class="fa fa-trash"></i> &nbsp; {{ Lang::get('administrable-blog::translations.default.deleteall') }}</a>
        </div>
        <table class="table table-vcenter card-table" id='list'>
            <thead>
                <th></th>
               <th>
                   <label class="form-check" for="check-all">
                        <input class="form-check-input" type="checkbox" id="check-all">
                        <span class="form-check-label"></span>
                    </label>
               </th>

                <th>#</th>
                <th>{{ Lang::get('administrable-blog::translations.view.post.title') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.post.content') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.post.statut') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.categories') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.tags') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.post.created_at') }}</th>
                {{-- add fields here --}}

                <th>{{ Lang::get('administrable-blog::translations.view.post.actions') }}</th
            </thead>
            <tbody>
               @foreach($posts as $post)
            <tr class="tr-shadow">
                <td></td>
                <td>
                    <label class="form-check" for="check-{{ $post->id }}">
                        <input class="form-check-input" type="checkbox" data-check data-id="{{ $post->id }}" id="check-{{ $post->id }}"
                        <span class="form-check-label"></span>
                    </label>
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
                        <a href="{{ back_route('extensions.blog.post.show', $post) }}" class="btn btn-primary" data-toggle="tooltip"
                            data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.show') }}"><i class="fas fa-eye"></i></a>

                          <a href="{{ back_route('model.clone', get_clone_model_params($post)) }}" class="btn btn-secondary" data-toggle="tooltip"
                        data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.clone') }}"><i class="fas fa-clone"></i></a>

                        <a href="{{ back_route('extensions.blog.post.edit', $post) }}" class="btn btn-info" data-toggle="tooltip"
                            data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i class="fas fa-edit"></i></a>
                        <a href="{{ back_route('extensions.blog.post.destroy',$post) }}" data-method="delete"
                            data-confirm="{{ Lang::get('administrable-blog::translations.view.post.destroy') }}" class="btn btn-danger"
                            data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

<x-administrable::datatable />
@deleteall()

@endsection
