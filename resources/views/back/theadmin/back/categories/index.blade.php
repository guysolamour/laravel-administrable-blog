@extends(back_view_path('layouts.base'))


@section('title', Lang::get('administrable-blog::translations.view.categories'))


@section('content')
<div class="main-content">
    <div class="card ">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end" style="padding-top:10px;padding-right:20px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ Lang::get('administrable-blog::translations.view.categories') }}</li>
            </ol>
        </nav>

    </div>

    <div class="card">
        {{-- <h4 class="card-title">
                {{ Lang::get('administrable-blog::translations.view.categories') }}
            </h4> --}}

        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title h3">
                        {{ Lang::get('administrable-blog::translations.view.categories') }}
                    </h5>
                    <div class="btn-group">
                        <a href="{{ back_route('extensions.blog.category.create') }}"
                            class="btn btn-sm btn-label btn-round btn-primary"><label><i class="fa fa-plus"></i></label>
                            {{ Lang::get('administrable-blog::translations.default.add') }}</a>
                        <a href="#" data-model="{{ config('administrable-blog.models.category') }}" id="delete-all" class="btn btn-sm btn-label btn-round btn-danger d-none"><label><i
                                    class="fa fa-trash"></i></label> {{ Lang::get('administrable-blog::translations.default.deleteall') }}</a>

                    </div>
                </div>

                <table class="table table-hover table-has-action" id='list'>
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th></th>
                            <th>{{ Lang::get('administrable-blog::translations.view.category.name') }}</th>
                            <th>{{ Lang::get('administrable-blog::translations.view.category.created_at') }}</th>
                            {{-- add fields here --}}
                            <th>{{ Lang::get('administrable-blog::translations.view.category.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                 <div class="form-check">
                                    <input type="checkbox" data-check class="form-check-input" data-id="{{ $category->id }}"
                                        id="check-{{ $category->id }}">
                                    <label class="form-check-label" for="check-{{ $category->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d/m/Y h:i') }}</td>
                            {{-- add values here --}}

                            <td>
                                <nav class="nav no-gutters gap-2 fs-16">
                                    <a class="nav-link hover-primary" href="{{ back_route('extensions.blog.category.show', $category) }}"
                                        data-provide="tooltip" title="{{ Lang::get('administrable-blog::translations.default.show') }}"><i
                                            class="ti-eye"></i></a>

                                    <a class="nav-link hover-primary" href="{{ back_route('model.clone', get_clone_model_params($category)) }}" data-provide="tooltip"
                                        title="{{ Lang::get('administrable-blog::translations.default.clone') }}"><i class="ti-layers"></i></a>

                                    <a class="nav-link hover-primary" href="{{ back_route('extensions.blog.category.edit', $category) }}"
                                        data-provide="tooltip" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i
                                            class="ti-pencil"></i></a>
                                    <a class="nav-link hover-danger" href="{{ back_route('extensions.blog.category.destroy', $category) }}" data-provide="tooltip" title=""
                                        data-method="delete"
                                        data-confirm="{{ Lang::get('administrable-blog::translations.view.category.destroy') }}"
                                        title='{{ Lang::get('administrable-blog::translations.default.delete') }}'
                                        data-original-title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i class="ti-close"></i></a>
                                </nav>
                            </td>

                        </tr>
                       @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</div>


<x-administrable::datatable />
@deleteall()

@endsection
