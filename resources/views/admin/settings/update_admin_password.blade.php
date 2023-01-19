@extends('admin.layout.layout')
@section('content')

    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Changer le mot de passe</h4>
              <p class="card-description">
                Basic form layout
              </p>
              <form class="forms-sample">
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
                  <input type="password" class="form-control" name="current_password" required id="current_password">
                </div>
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Nouveau mot de passe</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
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
