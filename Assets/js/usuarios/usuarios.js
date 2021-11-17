let tablaUsuarios;
let datePick;

$(function() {
    actualizarEstiloMenu();
    ftnRolesUsuario();
    ftnDepartamentosUsuario();
    tablaUsuarios = $('#userTable').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        searching: true,
        "lengthChange": true,
        colReorder: true,
        "ajax": {
            "url": " " + BASE_URL + "Usuario/getUsuarios",
            "dataSrc": "",
            error: function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: 'Algo sucedió. Inténtalo de nuevo mas tarde. Error: ' + error.responseText,
                });
            }
        },
        "columns": [
            { "data": "nombres" },
            { "data": "departamento" },
            { "data": "rol" },
            { "data": "email" },
            { "data": "celular" },
            { "data": "estado" },
            { "data": "acciones" }
        ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "asc"]
        ]
    });

    $('.summernote').summernote('disable', {
        height: 200,
        lang: "es-ES",
        disableDragAndDrop: true,
        dialogsInBody: true
    });

    $('#txtFechaNacimiento').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        "opens": "center"
    });

    $('#cboRol').select2({
        dropdownParent: $('.group-rol')
    });
    $('#cboDepartamento').select2({
        dropdownParent: $('.group-departamento')
    });
    $('#cboEstado').select2({
        dropdownParent: $('.group-estado')
    });

    //Nuevo usuario o actualizar usuario
    $('#btnActionForm').click(function() {
        let elementosValidos = $('.valid');
        for (let i = 0; i < elementosValidos.length; i++) {
            if ($(elementosValidos[i]).hasClass('is-invalid') && !$(elementosValidos[i]).hasClass('opcional')) {
                Swal.fire({
                    title: 'Error',
                    text: 'Por favor, verfique los campos marcados en rojo.',
                    icon: 'error'
                });
                return false;
            }
        }

        if (parseInt($('#txtIdentificacion').val()) == 0 || $('#txtNombres').val() == '' || $('#txtApellidos').val() == '' || $('#txtCargo').val() == '' || $('#txtCorreo').val() == '' || parseInt($('#txtCelular').val()) == 0 || $('#txtFechaNacimiento').val() == '' || $('#cboRol').val() == null || $('#cboDepartamento').val() == null || $('#txtUsuario').val() == '' || $('#cboEstado').val() == null) {
            Swal.fire({
                title: 'Error',
                text: 'Todos los campos marcados con asterisco(*) son obligatorios.',
                icon: 'error'
            });
            return false;
        }
        //todo ok
        $.ajax({
            url: BASE_URL + 'Usuario/setUsuario',
            data: $("#formUsuario").serialize() + '&cboEstado=' + $('#cboEstado').val() + '&cboRol=' + $('#cboRol').val() + '&cboDepartamento=' + $('#cboDepartamento').val(),
            type: 'POST',
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
                if (response.status) {
                    tablaUsuarios.ajax.reload();
                    resetearModalCerrar();
                    $('#modalFormUsuario').modal('hide');
                    $('#formUsuario').trigger('reset');

                    Swal.fire({
                        title: 'Usuarios',
                        text: response.msg,
                        icon: 'success'
                    });
                } else {
                    //restaurar usuario
                    console.log(response);
                    if (response.code == 1) {
                        Swal.fire({
                            title: '¡Atención!',
                            text: response.msg,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Si',
                            cancelButtonText: 'No'
                        }).then((respuesta) => {
                            if (respuesta.isConfirmed) {
                                $.ajax({
                                    url: BASE_URL + 'Usuario/restaurarUsuario/' + response.data,
                                    type: 'POST',
                                    cache: 'false',
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
                                        if (response.status) {
                                            tablaUsuarios.ajax.reload();
                                            resetearModalCerrar();
                                            $('#modalFormUsuario').modal('hide');
                                            $('#formUsuario').trigger('reset');
                                            Swal.fire({
                                                title: 'Restaurar usuario',
                                                text: response.msg,
                                                icon: 'success'
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Error',
                                                text: response.msg,
                                                icon: 'error'
                                            });
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Hubo un error interno en el servidor.',
                                            icon: 'error'
                                        });
                                    }
                                });
                            }
                        });
                        //fin restaurar usuario
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.msg
                        });
                    }
                }
            },
            error: function(error) {
                Swal.close();

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: 'Algo sucedió. Inténtalo de nuevo mas tarde. Error: ' + error.responseText,
                });
            }
        });
    });
});
const actualizarEstiloMenu = () => {
    for (let i = 0; i < 5; i++) {
        $('.menu').removeClass('opened');
    }

    $('.usuarios-menu').addClass('opened');
}

const ftnRolesUsuario = () => {
    $.ajax({
        url: BASE_URL + 'Usuario/getRoles',
        type: 'GET',
        cache: 'false',
        dataType: 'json',
        success: function(respuesta) {
            let htmlSelect;
            respuesta.forEach(function(respuesta, index) {
                htmlSelect += `<option value="${respuesta.id_rol}">${respuesta.rol}</option>`;
            });
            $('#cboRol').html(htmlSelect);
        }
    });
}

const ftnDepartamentosUsuario = () => {
    $.ajax({
        url: BASE_URL + 'Usuario/getDepartamentos',
        type: 'GET',
        cache: 'false',
        dataType: 'json',
        success: function(respuesta) {
            let htmlSelect;
            respuesta.forEach(function(respuesta, index) {
                htmlSelect += `<option value="${respuesta.id_departamento}">${respuesta.departamento}</option>`;
            });
            $('#cboDepartamento').html(htmlSelect);
        }
    });
}

function fntViewUsuario(idUsuario) {
    $.ajax({
        url: BASE_URL + 'Usuario/getUsuario/' + idUsuario,
        type: 'POST',
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
            if (response.status) {
                let estadoUsuario = response.msg.estado == 1 ?
                    '<span class="label label-success">Activo</span>' :
                    '<span class="label label-danger">Inactivo</span>';
                let celularAlternativo = response.msg.celular_alternativo == null ?
                    'N/A' :
                    '<a href="tel:' + response.msg.celular_alternativo + '">' + response.msg.celular_alternativo + '</a>';
                $('#celIdentificacion').html('CC ' + response.msg.identificacion);
                $('#celNombres').html(response.msg.nombres_apellidos);
                $('#celFechaNacimiento').html(response.msg.fecha_nacimiento);
                $('#celEdad').html(response.msg.edad + ' años');
                $('#celCargo').html(response.msg.cargo);
                $('#celCelular').html('<a href="tel:' + response.msg.celular + '">' + response.msg.celular + '</a>');
                $('#celCelularAlternativo').html(celularAlternativo);
                $("#celCorreo").html('<a href="mailto:' + response.msg.email + '">' + response.msg.email + '</a>');
                $("#celRol").html(response.msg.rol);
                $("#celDepartamento").html(response.msg.departamento);
                $("#celEstado").html(estadoUsuario);
                $("#celFechaCreacion").html(response.msg.fecha_creacion);
                $("#celFechaActualización").html(response.msg.fecha_actualizacion);
                $("#celDescrpcion").html(response.msg.descripcion);

                $('#modalViewUsuario').modal('show');
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.msg,
                    icon: 'error'
                });
            }
        },
        error: function() {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un error interno en el servidor.',
                icon: 'error'
            });
        }
    });
}

function fntEditarUsuario(idUsuario) {
    $('#btnActionForm').removeClass("btn-primary").addClass("btn-update");
    $('#btnActionForm').html('<i class="fa fa-fw fa-lg fa-check-circle"></i> Actualizar');
    $('#titleModal').html("Actualizar Usuario");
    $.ajax({
        url: BASE_URL + 'Usuario/getUsuario/' + idUsuario,
        type: 'POST',
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
        success: function(respuesta) {
            Swal.close();
            if (respuesta.status) {
                $('#idUsuario').val(respuesta.msg.id_usuario);
                $('#txtIdentificacion').val(respuesta.msg.identificacion);
                $('#txtNombres').val(respuesta.msg.nombres);
                $('#txtApellidos').val(respuesta.msg.apellidos);
                $('#txtFechaNacimiento').val(respuesta.msg.fecha_nacimiento);
                $('#txtCargo').val(respuesta.msg.cargo);
                $('#txtCelular').val(respuesta.msg.celular);
                $('#txtCelularAlternativo').val(respuesta.msg.celular_alternativo);
                $('#txtCorreo').val(respuesta.msg.email);
                $('#cboRol').select2('val', respuesta.msg.id_rol);
                $('#cboDepartamento').select2('val', respuesta.msg.id_departamento);
                $('#cboEstado').select2('val', respuesta.msg.estado);
                $('#txtUsuario').val(respuesta.msg.usuario);
                $('#txtPassword').removeAttr('readonly');
                $('#txtPassword').removeAttr('required');
                $('.lblPassword span').remove();

                $('#modalFormUsuario').modal('show');
            } else {
                Swal.fire({
                    title: 'Error',
                    text: respuesta.msg,
                    icon: 'error'
                });
            }
        },
        error: function() {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un error interno en el servidor.',
                icon: 'error'
            });
        }
    });
}

const fntSetPassword = (input) => {
    $('#txtPassword').val(input);
}

const fntSetUser = (input) => {
    $('#txtUsuario').val(input);
}

const fntEliminarUsuario = (idUsuario) => {
    Swal.fire({
        title: '¡Atención!',
        text: '¿Está seguro que desea eliminar este usuario?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((respuesta) => {
        if (respuesta.isConfirmed) {
            $.ajax({
                url: BASE_URL + 'Usuario/delUsuario/' + idUsuario,
                type: 'POST',
                cache: 'false',
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
                    if (response.status) {
                        tablaUsuarios.ajax.reload();
                        Swal.fire({
                            title: 'Eliminar usuario',
                            text: response.msg,
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.msg,
                            icon: 'error'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error interno en el servidor.',
                        icon: 'error'
                    });
                }
            });
        }
    });
}

const abrirModal = () => {
    $('#idUsuario').val("");
    $('#btnActionForm').html('<i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar');
    $('#titleModal').html("Nuevo Usuario");
    $('#txtPassword').attr('readonly', true);
    $('#formUsuario').trigger('reset');

    $('#modalFormUsuario').modal('show');
}

const cerrarModal = () => {
    Swal.fire({
        title: '¿Estás seguro de que quieres salir?',
        showDenyButton: true,
        confirmButtonText: 'Si',
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            resetearModalCerrar();
            $('#modalFormUsuario').modal('hide');
        }
    })
}

const resetearModalCerrar = () => {
    let elementosValidos = $('.valid');
    for (let i = 0; i < elementosValidos.length; i++) {
        if ($(elementosValidos[i]).hasClass('is-invalid')) {
            $(elementosValidos[i]).removeClass('is-invalid');
            $(elementosValidos[i]).parent().removeClass('form-group-error');
            $(elementosValidos[i]).siblings('.text-muted').css('display', 'none');
        }
    }
}