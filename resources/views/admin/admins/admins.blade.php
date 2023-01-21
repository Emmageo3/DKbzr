@extends('admin.layout.layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
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
                  Type
                </th>
                <th>
                  Numéro de téléphone
                </th>
                <th>
                  Email
                </th>
                <th>
                    Photo de profil
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
                @foreach ($admins as $admin)
              <tr>
                <td>
                  {{ $admin['id'] }}
                </td>
                <td>
                  {{ $admin['name'] }}
                </td>
                <td>
                  {{ $admin['type'] }}
                </td>
                <td>
                    {{ $admin['mobile'] }}
                </td>
                <td>
                    {{ $admin['email'] }}
                </td>
                <td>
                    <img src="{{ asset('admin/images/photos/'.$admin['image']) }}" alt="" style="object-fit: cover; object-position: top">
                </td>
                <td>
                   @if ($admin['status']==1)
                       Actif
                    @else
                        Inactif
                   @endif
                </td>
                <td>
                    actions
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
