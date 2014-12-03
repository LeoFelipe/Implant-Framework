$(document).ready(function(){
    
    // VALIDATION
    $("#form").validate({
        rules: {
            nome: {
                required: true,
                minlength: 2
            },
            status: {
                required: true
            }
        }
    });
    
});