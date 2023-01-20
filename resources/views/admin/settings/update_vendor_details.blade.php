@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
@if($slug == "personal")
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
                  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
            <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data">@csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Adresse email</label>
                <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
              </div>
              <div class="form-group">
                <label>Type</label>
                <input class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}">
                <span id="check_password"></span>
              </div>
              <div class="form-group">
                <label for="name">Pays</label>
                <input type="text" class="form-control" name="country" value="{{ $vendorDetails['country'] }}">
                <span id="check_password"></span>
              </div>
              <div class="form-group">
                <label for="name">Ville</label>
                <input type="text" class="form-control" name="city" value="{{ $vendorDetails['city'] }}">
                <span id="check_password"></span>
              </div>
              <div class="form-group">
                <label for="name">Adresse</label>
                <input type="text" class="form-control" name="address" value="{{ $vendorDetails['address'] }}">
                <span id="check_password"></span>
              </div>
              <div class="form-group">
                <label for="name">Code postal</label>
                <input type="text" class="form-control" name="pincode" value="{{ $vendorDetails['pincode']}}">
                <span id="check_password"></span>
              </div>
              <div class="form-group">
                <label for="mobile">Numéro de téléphone</label>
                <input type="text" class="form-control" name="vendor_mobile" value="{{ Auth::guard('admin')->user()->mobile }}">
              </div>
              <div class="form-group">
                <label for="mobile">Photo de profil</label>
                <input type="file" class="form-control" name="image">
                @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">Voir la photo</a>
                    <input type="hidden" name="current_image" value="{{ Auth::guard('admin')->user()->image }}">
                @endif
              </div>
              <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@elseif($slug == "business")

@elseif($slug == "bank")

@endif

  </div>

@endsection
