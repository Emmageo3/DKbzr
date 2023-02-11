@extends('admin.layout.layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-primary" style="max-width: 150px; float:right; display:inline-block">Ajouter</a>
        <h4 class="card-title">Produits</h4>
        @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
        <div class="table-responsive pt-3">
          <table id="products" class="table table-bordered">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                    Image
                </th>
                <th>
                  Nom
                </th>
                <th>
                    Code
                </th>
                <th>
                    Couleur
                </th>
                <th>
                    Catégorie
                </th>
                <th>
                    Sous catégorie
                </th>
                <th>
                    Ajouté par
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
                @foreach ($products as $product)
              <tr>
                <td>
                  {{ $product['id'] }}
                </td>
                <td>
                    @if(!empty($product['product_image']))
                    <img src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}" style="border-radius: 0; height: 150px; width: 150px; object-fit: cover">
                    @else
                        Pas d'image pour ce produit
                    @endif
                </td>
                <td>
                  {{ $product['product_name'] }}
                </td>
                <td>
                    {{ $product['product_code'] }}
                </td>
                <td>
                    {{ $product['product_color'] }}
                </td>
                <td>
                    {{ $product['section']['name'] }}
                </td>
                <td>
                    {{ $product['category']['category_name'] }}
                </td>
                <td>
                    @if($product['admin_type']=="vendor")
                        <a target="_blank" href="{{ url('admin/view-vendor-details/'.$product['admin_id']) }}">{{ ucfirst($product['admin_type'])  }}</a>
                    @else
                        {{ ucfirst($product['admin_type']) }}
                    @endif
                </td>
                <td>
                    @if ($product['status']==1)
                    <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)">
                        <i class="mdi mdi-bookmark-check" style="font-size: 25px" status="Active"></i>
                    </a>
                    @else
                        <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)">
                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px" status="Inactive"></i>
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('admin/add-edit-product/'.$product['id']) }}">
                        <i class="mdi mdi-pencil-box" style="font-size: 25px"></i>
                    </a>
                    <a title="catégorie" module="product" moduleid="{{ $product['id'] }}" class="confirmDelete" href="javascript:void(0)">
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
