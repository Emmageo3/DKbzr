@extends('admin.layout.layout')
@section('content')

    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Changer le mot de passe</h4>
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
              <form class="forms-sample" action="{{ url('admin/update-admin-password') }}" method="post">@csrf
                <div class="form-group">
                  <label for="exampleInputUsername1">Adresse email</label>
                  <input type="text" class="form-control" value="{{ $adminDetails['email'] }}" readonly>
                </div>
                <div class="form-group">
                  <label>Type</label>
                  <input class="form-control" value="{{ $adminDetails['type'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mot de passe actuel</label>
                  <input type="password" class="form-control" name="current_password" required id="current_password" placeholder="Veuillez saisir votre mot de passe actuel">
                  <span id="check_password"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Nouveau mot de passe</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Veuillez saisir votre nouveau mot de passe">
                </div>
                <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Veuillez confirmer votre nouveau mot de passe">
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
