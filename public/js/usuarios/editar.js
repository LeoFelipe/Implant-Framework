$(document).ready(function(){
    
    // VALIDATION
    $("#form").validate({
        rules: {
            grupo: {
                required: true
            },
            setor: {
                required: true
            },
            cargo: {
                required: true
            },
            nome: {
                required: true,
                minlength: 8,
                letras: true
            },
            login: {
                required: true,
                minlength: 5,
                letrasMinusculas: true,                
                remote: {
                    url: "/implant6/usuarios/chkLoginAjax",
                    type: "post",
                    data: {
                        id: function() {
                            return $("#id").val();
                        }
                    }
                }
            },
            cpf: {
                required: true,
                minlength: 14,
                remote: {
                    url: "/implant6/usuarios/chkCpfAjax",
                    type: "post",
                    data: {
                        id: function() {
                            return $("#id").val();
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/implant6/usuarios/chkEmailAjax",
                    type: "post",
                    data: {
                        id: function() {
                            return $("#id").val();
                        }
                    }
                }
            },
            dtNiver: {
                required: true
            },
            status: {
                required: true
            }
        },
        messages: {
            cpf: {
                remote: "Este CPF já foi cadastrado. Por favor use outro CPF."
            },
            email: {
                remote: "Este Email já foi cadastrado. Por favor use outro email."
            },
            login: {
                remote: "Este Login já existe. Por favor use outro Login."
            }
        }
    });
    
});