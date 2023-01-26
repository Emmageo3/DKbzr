@extends('admin.layout.layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-block btn-primary" style="max-width: 150px; float:right; display:inline-block">Ajouter</a>
        <h4 class="card-title">Marques</h4>
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
                @foreach ($brands as $brand)
              <tr>
                <td>
                  {{ $brand['id'] }}
                </td>
                <td>
                  {{ $brand['name'] }}
                </td>
                <td>
                    @if ($brand['status']==1)
                    <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                        <i class="mdi mdi-bookmark-check" style="font-size: 25px" status="Active"></i>
                    </a>
                    @else
                        <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px" status="Inactive"></i>
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('admin/add-edit-brand/'.$brand['id']) }}">
                        <i class="mdi mdi-pencil-box" style="font-size: 25px"></i>
                    </a>
                    <a title="marque" module="brand" moduleid="{{ $brand['id'] }}" class="confirmDelete" href="javascript:void(0)">
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
