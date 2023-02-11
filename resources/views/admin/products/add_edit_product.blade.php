@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="row">
      <div class="row grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">{{ $title }}</h4>
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



            <form class="row forms-sample" @if(empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
            <div class="col-md-6">
              <div class="form-group">
                <label for="name"> Sélectionner une catégorie principale</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Sélectionner</option>
                    @foreach ($categories as $section)
                        <optgroup label="{{ $section['name'] }}"></optgroup>
                        @foreach ($section['categories'] as $category)
                            <option @if(!empty($product['category_id']==$category['id'])) selected @endif value="{{ $category['id'] }}">&nbsp;&nbsp;&nbsp;
                            ---&nbsp;{{ $category['category_name'] }}</option>
                            @foreach ($category['subcategories'] as $subcategory)
                                <option @if(!empty($product['category_id']==$subcategory['id'])) selected @endif value="{{ $subcategory['id'] }}" {{ old('category_id') == $subcategory['id'] ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ---&nbsp;{{ $subcategory['category_name'] }}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name"> Sélectionner la marque</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    <option value="">Sélectionner</option>
                    @foreach ($brands as $brand)
                        <option @if(!empty($product['brand_id']==$brand['id'])) selected @endif value="{{ $brand['id'] }}" {{ old('brand_id') == $brand['id'] ? 'selected' : '' }}>{{ $brand['name'] }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="product_name" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}"  @endif>
              </div>
              <div class="form-group">
                <label for="name">Code</label>
                <input type="text" class="form-control" name="product_code" @if(empty($product['product_code'])) value="{{ old('product_code') }}" @else value="{{ $product['product_code'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Couleur</label>
                <input type="text" class="form-control" name="product_color" @if(empty($product['product_color'])) value="{{ old('product_color') }}" @else value="{{ $product['product_color'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Prix</label>
                <input type="text" class="form-control" name="product_price" @if(empty($product['product_price'])) value="{{ old('product_price') }}" @else value="{{ $product['product_price'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="mobile">Photo</label>
                <input type="file" class="form-control" name="product_image" @if(!empty($product['product_image'])) value="{{ $product['product_image'] }} @endif">
                @if(!empty($product['product_image']))
                    <a target="_blank" href="{{ url('admin/images/products/'.$product['product_image']) }}">Voir la photo</a>
                    <input type="hidden" name="current_image" value="{{ $product['product_image'] }}">&nbsp;|&nbsp;
                    <a title="catégorie" module="product-image" moduleid="{{ $product['id'] }}" class="confirmDelete" href="javascript:void(0)">
                        Supprimer
                    </a>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Remise sur le produit (%)</label>
                <input type="text" class="form-control" name="product_discount" @if(empty($category['product_discount'])) value="{{ old('product_discount') }}" @else value="{{ $category['product_discount'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Poids</label>
                <input type="text" class="form-control" name="product_weight" @if(empty($product['product_weight'])) value="{{ old('product_weight') }}" @else value="{{ $product['product_weight'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" class="form-control">@if(!empty($product['description'])) {{ $product['description'] }} @else {{ old('description') }} @endif</textarea>
              </div>
              <div class="form-group">
                <label for="name">URL de la catégorie</label>
                <input type="text" class="form-control" name="url" @if(empty($product['url'])) value="{{ old('url') }}" @else value="{{ $product['url'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Résumé</label>
                <input type="text" class="form-control" name="meta_description" @if(empty($product['meta_description'])) value="{{ old('meta_description') }}" @else value="{{ $product['meta_description'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Mots clés</label>
                <input type="text" class="form-control" name="meta_keywords" @if(empty($product['meta_keywords'])) value="{{ old('meta_keywords') }}" @else value="{{ $product['meta_keywords'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Meta titre</label>
                <input type="text" class="form-control" name="meta_title" @if(empty($product['meta_title'])) value="{{ old('meta_title') }}" @else value="{{ $product['meta_title'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">En tendance ?</label>
                <input type="checkbox" name="is_featured" value="yes"
                @if (!empty($product['is_featured']) && $product['is_featured'] == "yes")
                    checked
                @endif
                >
              </div>
              <button type="submit" class="btn btn-primary mr-2" style="float: right">Enregistrer</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
