@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Mettre à jour les informations</h4>
            @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Erreur:</strong> {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Erreur:</strong> {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="post">@csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Adresse email</label>
                <input type="text" class="form-control" value="{{ $adminDetails['email'] }}" readonly>
              </div>
              <div class="form-group">
                <label>Type</label>
                <input class="form-control" value="{{ $adminDetails['type'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" value="{{ $adminDetails['name'] }}">
                <span id="check_password"></span>
              </div>
              <div class="form-group">
                <label for="mobile">Nouveau mot de passe</label>
                <input type="text" class="form-control" name="mobile" value="{{ $adminDetails['mobile'] }}">
              </div>
              <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
              <button class="btn btn-light">Annuler</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
