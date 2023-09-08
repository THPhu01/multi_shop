$(document).ready(function() {
    $(".login-form__btn submit").click(function(e){
        e.preventDefault();


        var _token = $("input[name='_token']").val();
        var email = $("input[name='email']").val();
        var password = $("textarea[name='password']").val();


        $.ajax({
            url: "/login",
            type:'POST',
            data: {_token:_token, email:email, password:password},
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    alert(data.success);
                }else{
                    printErrorMsg(data.error);
                }
            }
        });


    }); 


    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
});
