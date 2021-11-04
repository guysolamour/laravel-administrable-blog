@extends(back_view_path('layouts.base'))


@section('title', Lang::get('administrable-blog::translations.view.categories'))



@section('content')


<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-blog::translations.view.categories') }}</a></li>
            </ol>

            <a href="{{ back_route('extensions.blog.category.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>&nbsp; Ajouter</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between mb-3">
            <h3> {{ Lang::get('administrable-blog::translations.view.categories') }} </h3>
            <a href="#" class="btn btn-danger d-none" data-model="{{ config('administrable-blog.models.category') }}"
                id="delete-all"><i class="fa fa-trash"></i> &nbsp; {{ Lang::get('administrable-blog::translations.default.deleteall') }}</a>
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

                <th>#</>
                <th>{{ Lang::get('administrable-blog::translations.view.category.name') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.category.created_at') }}</th>
                {{-- add fields here --}}
                <th>{{ Lang::get('administrable-blog::translations.view.category.actions') }}</th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="tr-shadow">
                    <td></td>
                    <td>
                        <label class="form-check" for="check-{{ $category->id }}">
                            <input class="form-check-input" type="checkbox" data-check data-id="{{ $category->id }}"
                                id="check-{{ $category->id }}" <span class="form-check-label"></span>
                        </label>
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->format('d/m/Y h:i') }}</td>
                    {{-- add values here --}}
                    <td>

                        <div class="btn-group" role="group">
                            <a href="{{ back_route('extensions.blog.category.show', $category) }}" class="btn btn-primary"
                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.show') }}"><i
                                    class="fas fa-eye"></i></a>

                            <a href="{{ back_route('model.clone', get_clone_model_params($category)) }}" class="btn btn-secondary" data-toggle="tooltip"
                              data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.clone') }}"><i class="fas fa-clone"></i></a>

                            <a href="{{ back_route('extensions.blog.category.edit', $category) }}" class="btn btn-info"
                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ back_route('extensions.blog.category.destroy',$category) }}" data-method="delete"
                                data-confirm="{{ Lang::get('administrable-blog::translations.view.category.destroy') }}"
                                class="btn btn-danger" data-toggle="tooltip" data-placement="top"
                                title="{{ Lang::get('administrable-blog::translations.default.delete') }}"><i class="fas fa-trash"></i></a>
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
