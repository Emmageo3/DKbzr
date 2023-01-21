@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Vendeur</h4>
            <form class="forms-sample"enctype="multipart/form-data">
                <div class="form-group">
                    <img src="{{ asset('admin/images/photos/'.$vendorDetails['image']) }}" style="height: 100px; width: 100px; border-radius: 100%; object-fit: cover; object-position: top">
                  </div>
              <div class="form-group">
                <label for="exampleInputUsername1">Adresse email</label>
                <input type="text" class="form-control" value="{{ $vendorDetails['email'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['name'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="mobile">Numéro de téléphone</label>
                <input type="text" class="form-control" name="mobile" value="{{ $vendorDetails['mobile'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Adresse</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['address'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Ville</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['city'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Pays</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['country'] }}" readonly>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Boutique</h4>
            <form class="forms-sample"enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputUsername1">Nom</label>
                <input type="text" class="form-control" value="{{ $vendorDetails['vendorBusiness']['shop_name'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Adresse</label>
                <input type="text" class="form-control" value="{{ $vendorDetails['vendorBusiness']['shop_address'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="mobile">Ville</label>
                <input type="text" class="form-control" value="{{ $vendorDetails['vendorBusiness']['shop_city'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Pays</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['shop_country'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Code postal</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['shop_pincode'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Numéro de téléphone</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['shop_mobile'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Site web</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['shop_website'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Adresse mail</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['shop_email'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Ninea</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['ninea'] }}" readonly>
              </div>
              <div class="form-group">
                <label for="name">Preuve</label>
                <input type="text" class="form-control" name="name" value="{{ $vendorDetails['vendorBusiness']['address_proof'] }}" readonly>
              </div>

                @if (!empty($vendorDetails['vendorBusiness']['address_proof_image']))
                <div class="form-group">
                    <label for="name">Photo</label><br>
                    <img src="{{ url('admin/images/proofs/'.$vendorDetails['vendorBusiness']['address_proof_image']) }}" style="height: 100px; width: 100px">
                </div>
                @endif

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
