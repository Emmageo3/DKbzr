@extends('admin.layout.layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/add-edit-section') }}" class="btn btn-block btn-primary" style="max-width: 150px; float:right; display:inline-block">Ajouter</a>
        <h4 class="card-title">Catégories</h4>
        @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Nom
                </th>
                <th>
                  Statut
                </th>
                <th>
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
              <tr>
                <td>
                  {{ $section['id'] }}
                </td>
                <td>
                  {{ $section['name'] }}
                </td>
                <td>
                    @if ($section['status']==1)
                    <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)">
                        <i class="mdi mdi-bookmark-check" style="font-size: 25px" status="Active"></i>
                    </a>
                    @else
                        <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)">
                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px" status="Inactive"></i>
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('admin/add-edit-section/'.$section['id']) }}">
                        <i class="mdi mdi-pencil-box" style="font-size: 25px"></i>
                    </a>
                    <a title="catégorie" module="section" moduleid="{{ $section['id'] }}" class="confirmDelete" href="javascript:void(0)">
                        <i class="mdi mdi-file-excel-box" style="font-size: 25px"></i>
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
