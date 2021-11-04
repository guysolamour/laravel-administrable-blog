@extends(back_view_path('layouts.base'))

@section('title', Lang::get('administrable-blog::translations.view.tags'))

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}"{{ Lang::get('administrable-blog::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ Lang::get('administrable-blog::translations.view.tags') }}</a></li>
            </ol>

            <a href="{{ back_route('extensions.blog.tag.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>&nbsp; {{ Lang::get('administrable-blog::translations.default.add') }}</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between mb-3">
            <h3> Etiquettes </h3>
            <a href="#" class="btn btn-danger d-none" data-model="{{ config('administrable-blog.models.tag') }}"
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
                <th>{{ Lang::get('administrable-blog::translations.view.tag.name') }}</th>
                <th>{{ Lang::get('administrable-blog::translations.view.tag.created_at') }}</th>
                {{-- add fields here --}}
                <th>{{ Lang::get('administrable-blog::translations.view.tag.actions') }}</th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr class="tr-shadow">
                    <td></td>
                    <td>
                        <label class="form-check" for="check-{{ $tag->id }}">
                            <input class="form-check-input" type="checkbox" data-check data-id="{{ $tag->id }}"
                                id="check-{{ $tag->id }}" <span class="form-check-label"></span>
                        </label>
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->created_at->format('d/m/Y h:i') }}</td>
                    {{-- add values here --}}
                    <td>

                        <div class="btn-group" role="group">
                            <a href="{{ back_route('extensions.blog.tag.show', $tag) }}" class="btn btn-primary"
                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.show') }}"><i
                                    class="fas fa-eye"></i></a>

                                <a href="{{ back_route('model.clone', get_clone_model_params($tag)) }}" class="btn btn-secondary" data-toggle="tooltip"
                              data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.clone') }}"><i class="fas fa-clone"></i></a>

                            <a href="{{ back_route('extensions.blog.tag.edit', $tag) }}" class="btn btn-info"
                                data-toggle="tooltip" data-placement="top" title="{{ Lang::get('administrable-blog::translations.default.edit') }}"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ back_route('extensions.blog.tag.destroy', $tag) }}" data-method="delete"
                                data-confirm="{{ Lang::get('administrable-blog::translations.view.tag.destroy') }}"
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
