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
                <select name="country" class="form-control">
                    @foreach ($countries as $country)
                        <option value="{{ $country['country_name'] }}" @if($country['country_name'] == $vendorDetails['country']) selected @endif>{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Ville</label>
                <input type="text" class="form-control" name="city" value="{{ $vendorDetails['city'] }}">
              </div>
              <div class="form-group">
                <label for="name">Adresse</label>
                <input type="text" class="form-control" name="address" value="{{ $vendorDetails['address'] }}">
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
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Mettre à jour les informations de la boutique</h4>
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
            <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                <label for="name">Nom de la boutique</label>
                <input type="text" class="form-control" name="shop_name" value="{{ $vendorDetails['shop_name'] }}">
                </div>
                <div class="form-group">
                    <label for="name">Adresse</label>
                    <input type="text" class="form-control" name="shop_address" value="{{ $vendorDetails['shop_address'] }}">
                </div>
                <div class="form-group">
                    <label for="name">Ville</label>
                    <input type="text" class="form-control" name="shop_city" value="{{ $vendorDetails['shop_city'] }}">
                </div>
                <div class="form-group">
                    <label for="name">Pays </label>
                    <select name="shop_country" class="form-control">
                        @foreach ($countries as $country)
                            <option value="{{ $country['country_name'] }}" @if($country['country_name'] == $vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Code pin</label>
                    <input type="text" class="form-control" name="shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}">
                </div>
                <div class="form-group">
                    <label for="name">Numéro de téléphone</label>
                    <input type="text" class="form-control" name="shop_mobile" value="{{ $vendorDetails['shop_mobile'] }}">
                </div>
                <div class="form-group">
                    <label for="name">Site internet</label>
                    <input type="text" class="form-control" name="shop_website" value="{{ $vendorDetails['shop_website'] }}">
                </div>
                <div class="form-group">
                    <label for="name">Adresse mail</label>
                    <input type="text" class="form-control" name="shop_email" value="{{ $vendorDetails['shop_email'] }}">
                </div>
                <div class="form-group">
                    <label for="address_proof">Preuve de l'identité</label>
                    <select class="form-control" name="address_proof">
                        <option value="passport" @if($vendorDetails['address_proof']=="passport") selected @endif>Passport</option>
                        <option value="cni" @if($vendorDetails['address_proof']=="cni") selected @endif>CNI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mobile">Photo de la preuve</label>
                    <input type="file" class="form-control" name="address_proof_image">
                    @if(!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}">Voir la photo</a>
                        <input type="hidden" name="current_image" value="{{ $vendorDetails['address_proof_image'] }}">
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Ninea</label>
                    <input type="text" class="form-control" name="ninea" value="{{ $vendorDetails['ninea'] }}">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
            </form>
            </div>
        </div>
        </div>
    </div>
@elseif($slug == "bank")
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Mettre à jour les informations de la boutique</h4>
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
        <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data">@csrf
            <div class="form-group">
            <label for="name">Nom de la banque</label>
            <input type="text" class="form-control" name="bank_name" value="{{ $vendorDetails['bank_name'] }}">
            </div>
            <div class="form-group">
                <label for="name">Nom du propriétaire du compte</label>
                <input type="text" class="form-control" name="account_holder_name" value="{{ $vendorDetails['account_holder_name'] }}">
            </div>
            <div class="form-group">
                <label for="name">Numéro de compte</label>
                <input type="text" class="form-control" name="account_number" value="{{ $vendorDetails['account_number'] }}">
            </div>
            <div class="form-group">
                <label for="name">IFSC </label>
                <input type="text" class="form-control" name="ifsc" value="{{ $vendorDetails['ifsc'] }}">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
        </form>
        </div>
    </div>
    </div>
</div>
@endif

  </div>

@endsection
