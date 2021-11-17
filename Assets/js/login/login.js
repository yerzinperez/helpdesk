$(document).ready(function() {
    $(document).on("click", "#btnAcceder", function(event) {
        event.preventDefault();

        let userEmail = $('#userEmail').val();
        let userPassword = $('#userPassword').val();

        if (userEmail != '' && userPassword != '' && validarEmail(userEmail)) {
            $.ajax({
                type: 'POST',
                url: 'http://helpdesk2.test/Login/loginUser/',
                data: $('#frmLoginForm').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Cargando...',
                        text: 'Por favor, espera...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(response) {
                    Swal.close();
                    if (response.status == true && response.msg == 'ok') {
                        window.location = BASE_URL + 'dashboard';
                    } else {
                        $('#divValidate').html(`
                                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <i class="font-icon font-icon-warning"></i>
                                ${response.msg}
                                </div>`);
                    }

                },
                error: function(error) {
                    console.log(error);
                    Swal.close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: 'Algo sucedió. Inténtalo de nuevo mas tarde. Error: ' + error.responseText,
                    });
                }
            });
        } else {
            if (userEmail == '' && userPassword != '') {
                $('#divValidate').html(`
                                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="font-icon font-icon-warning"></i>
                                Debe ingresar un email.
                                </div>`);
            }
            if (userPassword == '' && userEmail != '') {
                $('#divValidate').html(`
                                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="font-icon font-icon-warning"></i>
                                Debe ingresar una contraseña.
                                </div>`);
            }
            if (!validarEmail(userEmail)) {
                $('#divValidate').html(`
                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                    <i class="font-icon font-icon-warning"></i>
                Email inválido.
                </div>`);
            }
            if (userPassword == '' && userEmail == '') {
                $('#divValidate').html(`
                                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="font-icon font-icon-warning"></i>
                                Los campos están vacios.
                                </div>`);
            }
        }
    });

    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function() {
            setTimeout(function() {
                $('.page-center').matchHeight({
                    remove: true
                });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            }, 100);
        });
    });
});