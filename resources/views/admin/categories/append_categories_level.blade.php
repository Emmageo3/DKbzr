<div class="form-group">
    <label for="name"> Sélectionner une catégorie secondaire</label>
    <select name="parent_id" id="" class="form-control">
        <option value="0" @if(isset($category['parent_id']) && $category['parent_id']==0) selected @endif>N'a pas catégorie secondaire</option>
        @if(!empty($getCategories))
            @foreach ($getCategories as $parentcategory)
                <option value="{{ $parentcategory['id'] }}"
                    @if(isset($parentcategory['parent_id']) && $parentcategory['parent_id']==$parentcategory['id'])
                    selected
                    @endif
                >
                    {{ $parentcategory['category_name'] }}
                </option>
                @if (!empty($parentcategory['subcategories']))
                    @foreach ($parentcategory['subcategories'] as $subcategory)
                        <option value="{{ $subcategory['id'] }}" @if(isset($parentcategory['parent_id']) && $parentcategory['parent_id']==$subcategory['id']) selected @endif>&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>
