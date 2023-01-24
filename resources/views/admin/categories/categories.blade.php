@extends('admin.layout.layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <a href="{{ url('admin/add-edit-category') }}" class="btn btn-block btn-primary" style="max-width: 150px; float:right; display:inline-block">Ajouter</a>
        <h4 class="card-title">Sous-categories</h4>
        @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            @endif
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Sous-catégorie
                </th>
                <th>
                    Catégorie principale
                </th>
                <th>
                  Url
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
            @foreach ($categories as $category)
            <tr>
                @if (isset($category['parentcategory']['category_name']) && !empty($category['parentcategory']['category_name']))
                    <?php $parent_category = $category['parentcategory']['category_name']; ?>
                @else
                    <?php $parent_category = "Root"; ?>
                @endif
                <td>
                    {{ $category['id'] }}
                </td>
                <td>
                    {{ $category['category_name'] }}
                </td>
                <td>
                    {{ $parent_category }}
                </td>
                <td>
                    {{ $category['section']['name'] }}
                </td>
                <td>
                  {{ $category['url'] }}
                </td>
                <td>
                    @if ($category['status']==1)
                    <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)">
                        <i class="mdi mdi-bookmark-check" style="font-size: 25px" status="Active"></i>
                    </a>
                    @else
                        <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)">
                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px" status="Inactive"></i>
                        </a>
                    @endif
                </td>
                <td>
                    edit
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
