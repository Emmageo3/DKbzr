@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="col-md-8">
      <div class="row grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter des propriétés</h4>
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
            @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif



            <form class="row forms-sample" action="{{ url('admin/add-edit-attributes/'.$product['id']) }}" method="post" enctype="multipart/form-data">@csrf
              <div class="form-group">
                <label for="name">Nom</label>
                &nbsp; {{ $product['product_name'] }}
              </div>
              <div class="form-group">
                <label for="name">Code</label>
                &nbsp; {{ $product['product_code'] }}
              </div>
              <div class="form-group">
                <label for="name">Couleur</label>
                &nbsp; {{ $product['product_color'] }}
              </div>
              <div class="form-group">
                <label for="name">Prix</label>
                &nbsp; {{ $product['product_price'] }}
              </div>
              <div class="form-group">
                @if(!empty($product['product_image']))
                    <img src="{{ url('front/images/product_images/large/'.$product['product_image']) }}" style="width: 120px; object-fit: cover">
                @else
                    Il n'y a pas d'image pour ce produit
                @endif
              </div>
              <div class="form-group">
                <div class="field_wrapper">
                    <div>
                        <input type="text" name="size[]" placeholder="taille" style="width: 120px" required/>
                        <input type="text" name="sku[]" placeholder="code sku" style="width: 120px" required/>
                        <input type="text" name="price[]" placeholder="prix" style="width: 120px" required/>
                        <input type="text" name="stock[]" placeholder="stock" style="width: 120px" required/>
                        <a href="javascript:void(0);" class="add_button" title="Ajouter des attributs">Ajouter</a>
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mr-2" style="float: right">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Attributs</h4>
        <div class="table-responsive pt-3">
        <form class="row forms-sample" action="{{ url('admin/edit-attributes/'.$product['id']) }}" method="post" enctype="multipart/form-data">@csrf

          <table id="products" class="table table-bordered">
            <thead>
              <tr>
                <th>
                    Sku
                </th>
                <th>
                    Taille
                </th>
                <th>
                    Prix
                </th>
                <th>
                    Stock
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
                @foreach ($product['attributes'] as $attribute)
                <input style="display: none" type="text" name="attributeId[]" value="{{ $attribute['id'] }}">
              <tr>
                <td>
                  {{ $attribute['sku'] }}
                </td>
                <td>
                  {{ $attribute['size'] }}
                </td>
                <td>
                    <input type="text" name="price[]" value="{{ $attribute['price'] }}" required style="width: 100%">
                </td>
                <td>
                    <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required style="width: 100%">
                </td>
                <td>
                    @if ($attribute['status']==1)
                    <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                        <i class="mdi mdi-bookmark-check" style="font-size: 25px" status="Active"></i>
                    </a>
                    @else
                        <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px" status="Inactive"></i>
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('admin/add-edit-attribute/'.$attribute['id']) }}">
                        <i class="mdi mdi-pencil-box" style="font-size: 25px"></i>
                    </a>
                    <a title="attribute" module="attribute" moduleid="{{ $attribute['id'] }}" class="confirmDelete" href="javascript:void(0)">
                        <i class="mdi mdi-file-excel-box" style="font-size: 25px"></i>
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
      </div>
    </div>
</div>

@endsection
