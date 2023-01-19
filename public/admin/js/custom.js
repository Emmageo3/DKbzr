$(document).ready(function(){
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
