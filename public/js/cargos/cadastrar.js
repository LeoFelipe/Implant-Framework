$(document).ready(function(){
    
    // VALIDATION
    $("#form").validate({
        rules: {
            nome: {
                required: true,
                minlength: 3
            },
            status: {
                required: true
            }
        }
    });
    
});