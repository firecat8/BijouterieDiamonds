var registrationFormHandler = {
    "register": function () {
         var inputs = $("#regForm").serializeArray();
        $.ajax({
            type: "post",
            url: "./templates/add_user.php",
            data: inputs,
            dataType: 'json',
            success: function (errors) {
                var allErrors = '<ul class="errUL">';
                for (var i = 0; i < errors.length; i++) {
                    allErrors +='<li class="errLI">' + errors[i] + '</li>';
                }
                    allErrors +='</ul ';

                $("#errorsDiv").html(allErrors);
            }
        });
    }

};
$(document).ready(function () {
    $(".regbtn").click(registrationFormHandler.register);
});


