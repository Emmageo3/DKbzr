$(document).ready(function(){
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

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
