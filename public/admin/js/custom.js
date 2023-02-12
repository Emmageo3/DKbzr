$(document).ready(function(){
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    $('#brands').DataTable();
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#products').DataTable();



    $('#current_password').keyup(function(){
        var current_password = $("#current_password").val()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-admin-password',
            data: {current_password:current_password},
            success:function(resp){
                if(resp == "false"){
                    $('#check_password').html("<font color='red'>Le mot de passe saisi est incorrect</font>")
                }else if(resp == "true"){
                    $('#check_password').html("<font color='green'>Le mot de passe saisi est correct</font>")
                }
            }, error:function(){
                alert('erreur')
            }
        })
    })
})

//active/inactive admin
$(document).on("click", ".updateAdminStatus", function(){
    var status = $(this).children("i").attr("status")
    var admin_id = $(this).attr("admin_id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/admin/update-admin-status",
        data: {status:status, admin_id:admin_id},
        success:function(resp){
            if(resp['status']==0){
                $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px' status='Inactive'></i>")
            }else if(resp['status']==1){
                $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px' status='Active'></i>")
            }
        },error:function(){
            alert('Erreur')
        }
    })
})

$(document).on("click", ".updateSectionStatus", function(){
    var status = $(this).children("i").attr("status")
    var section_id = $(this).attr("section_id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/admin/update-section-status",
        data: {status:status, section_id:section_id},
        success:function(resp){
            if(resp['status']==0){
                $("#section-"+section_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px' status='Inactive'></i>")
            }else if(resp['status']==1){
                $("#section-"+section_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px' status='Active'></i>")
            }
        },error:function(){
            alert('Erreur')
        }
    })
})

$(document).on("click", ".updateBrandStatus", function(){
    var status = $(this).children("i").attr("status")
    var brand_id = $(this).attr("brand_id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/admin/update-brand-status",
        data: {status:status, brand_id:brand_id},
        success:function(resp){
            if(resp['status']==0){
                $("#brand-"+brand_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px' status='Inactive'></i>")
            }else if(resp['status']==1){
                $("#brand-"+brand_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px' status='Active'></i>")
            }
        },error:function(){
            alert('Erreur')
        }
    })
})

$(document).on("click", ".updateCategoryStatus", function(){
    var status = $(this).children("i").attr("status")
    var category_id = $(this).attr("category_id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/admin/update-category-status",
        data: {status:status, category_id:category_id},
        success:function(resp){
            if(resp['status']==0){
                $("#category-"+category_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px' status='Inactive'></i>")
            }else if(resp['status']==1){
                $("#category-"+category_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px' status='Active'></i>")
            }
        },error:function(){
            alert('Erreur')
        }
    })
})

$(document).on("click", ".updateProductStatus", function(){
    var status = $(this).children("i").attr("status")
    var product_id = $(this).attr("product_id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/admin/update-product-status",
        data: {status:status, product_id:product_id},
        success:function(resp){
            if(resp['status']==0){
                $("#product-"+product_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px' status='Inactive'></i>")
            }else if(resp['status']==1){
                $("#product-"+product_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px' status='Active'></i>")
            }
        },error:function(){
            alert('Erreur')
        }
    })
})

$(document).on("click", ".updateAttributeStatus", function(){
    var status = $(this).children("i").attr("status")
    var attribute_id = $(this).attr("attribute_id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/admin/update-attribute-status",
        data: {status:status, attribute_id:attribute_id},
        success:function(resp){
            if(resp['status']==0){
                $("#attribute-"+attribute_id).html("<i class='mdi mdi-bookmark-outline' style='font-size: 25px' status='Inactive'></i>")
            }else if(resp['status']==1){
                $("#attribute-"+attribute_id).html("<i class='mdi mdi-bookmark-check' style='font-size: 25px' status='Active'></i>")
            }
        },error:function(){
            alert('Erreur')
        }
    })
})

$('.confirmDelete').click(function(){
    var module = $(this).attr('module')
    var moduleid = $(this).attr('moduleid')
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.location = "/admin/delete-"+module+"/"+moduleid
        }
      })
})

$("#section_id").change(function(){
    var section_id = $(this).val()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '/admin/append-categories-level',
        data: {section_id:section_id},
        success:function(resp){
            $("#appendCategoriesLevel").html(resp)
        },error:function(){
            alert('Erreur')
        }
    })
})

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top: 10px"><input type="text" name="size[]" placeholder="Taille" style="width: 120px"/>&nbsp;<input type="text" name="sku[]" placeholder="Code" style="width: 120px"/>&nbsp;<input type="text" name="price[]" placeholder="Prix" style="width: 120px"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width: 120px"/><a href="javascript:void(0);" class="remove_button">Supprimer</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});


