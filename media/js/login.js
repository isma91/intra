$(document).ready(function(){
    $(document).on('mousedown', "#display_user_pass", function() {
        $("#user_pass").prop("type", "text");
    });
    $(document).on('mouseup', "#display_user_pass", function() {
        $("#user_pass").prop("type", "password");
    });
});