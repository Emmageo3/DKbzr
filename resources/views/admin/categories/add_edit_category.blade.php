@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
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
            <form class="forms-sample" @if(empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$category['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
              <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="category_name" @if(empty($category['category_name'])) value="" @else value="{{ $category['category_name'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name"> Sélectionner une catégorie principale</label>
                <select name="section_id" id="section_id" class="form-control">
                    <option value="">Sélectionner</option>
                    @foreach ($getSections as $section)
                        <option value="{{ $section['id'] }}" @if(!empty($category['section_id']) && $category['section_id']==$section['id']) selected @endif>{{ $section['name'] }}</option>
                    @endforeach
                </select>
              </div>
              <div id="appendCategoriesLevel">
                @include('admin.categories.append_categories_level')
              </div>
              <div class="form-group">
                <label for="mobile">Photo</label>
                <input type="file" class="form-control" name="category_image">
                @if(!empty($category['category_image']))
                    <a target="_blank" href="{{ url('admin/images/categories/'.$category['category_image']) }}">Voir la photo</a>
                    <input type="hidden" name="current_image" value="{{ $category['category_image'] }}">
                @endif
              </div>
              <div class="form-group">
                <label for="name">Remise sur la catégorie</label>
                <input type="text" class="form-control" name="category_discount" @if(empty($category['category_discount'])) value="" @else value="{{ $category['category_discount'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" class="form-control">{{ $category['description'] }}</textarea>
              </div>
              <div class="form-group">
                <label for="name">URL de la catégorie</label>
                <input type="text" class="form-control" name="url" @if(empty($category['url'])) value="" @else value="{{ $category['url'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Résumé</label>
                <input type="text" class="form-control" name="meta_description" @if(empty($category['meta_description'])) value="" @else value="{{ $category['meta_description'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Mots clés</label>
                <input type="text" class="form-control" name="meta_keywords" @if(empty($category['meta_keywords'])) value="" @else value="{{ $category['meta_keywords'] }}" @endif>
              </div>
              <div class="form-group">
                <label for="name">Meta titre</label>
                <input type="text" class="form-control" name="meta_title" @if(empty($category['meta_title'])) value="" @else value="{{ $category['meta_title'] }}" @endif>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
