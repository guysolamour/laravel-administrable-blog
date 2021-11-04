@extends(back_view_path('layouts.base'))

@section('title', Lang::get('administrable-blog::translations.view.categories'))


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
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-blog::translations.view.categories') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.categories') }}</h3>
                        <div class="btn-group float-right">
                            <a href="{{ back_route('extensions.blog.category.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i>{{ Lang::get('administrable-blog::translations.default.add') }}</a>
                            <a href="#" class="btn btn-danger d-none" data-model="{{ config('administrable-blog.models.category') }}" id="delete-all">
                                <i class="fa fa-trash"></i> {{ Lang::get('administrable-blog::translations.default.deleteall') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-vcenter card-table" id='list'>
                            <thead>
                                <th>
                                    <div class="checkbox-fade fade-in-success ">
                                        <label for="check-all">
                                            <input type="checkbox" value="" id="check-all">
                                            <span class="cr">
                                                <i class="cr-icon ik ik-check txt-success"></i>
                                            </span>
                                            {{-- <span>Default</span> --}}
                                        </label>
                                    </div>
                                </th>
                                <th>#</th>
                                <th>{{ Lang::get('administrable-blog::translations.view.category.name') }}</th>
                                <th>{{ Lang::get('administrable-blog::translations.view.category.created_at') }}</th>
                                {{-- add fields here --}}
                                <th>{{ Lang::get('administrable-blog::translations.view.category.actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <div class="checkbox-fade fade-in-success ">
                                            <label for="check-{{ $category->id }}">
                                                <input type="checkbox" data-check data-id="{{ $category->id }}"
                                                    id="check-{{ $category->id }}">
                                                <span class="cr">
                                                    <i class="cr-icon ik ik-check txt-success"></i>
                                                </span>
                                                {{-- <span>Default</span> --}}
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('d/m/Y h:i') }}</td>
                                    {{-- add values here --}}
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ back_route('extensions.blog.category.show', $category) }}" class="btn btn-primary" data-toggle="tooltip"
                                                data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.show') }}"><i class="fas fa-eye"></i></a>

                                             <a href="{{ back_route('model.clone', get_clone_model_params($category)) }}" class="btn btn-secondary"
                                            title="{{ Lang::get('administrable-blog::translations.default.clone') }}"><i class="fas fa-clone"></i></a>


                                            <a href="{{ back_route('extensions.blog.category.edit', $category) }}" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ back_route('extensions.blog.category.destroy',$category) }}" data-method="delete"
                                                data-confirm="{{ Lang::get('administrable-blog::translations.view.category.destroy') }}" class="btn btn-danger"
                                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-administrable::datatable />
@deleteall()

@endsection
