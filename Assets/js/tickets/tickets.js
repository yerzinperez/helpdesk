$(function() {
    actualizarEstiloMenu();
    $('#tblTicketsAbiertos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        searching: true,
        "lengthChange": true,
        colReorder: true,
        // "ajax": {
        //     "url": " " + base_url + "Usuarios/getUsuarios",
        //     "dataSrc": ""
        // },
        // "columns": [
        //     { "data": "id_usuario" },
        //     { "data": "nombres" },
        //     { "data": "apellidos" },
        //     { "data": "telefono" },
        //     { "data": "correo" },
        //     { "data": "rol" },
        //     { "data": "estado" },
        //     { "data": "opciones" }
        // ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });
    $('#tblTicketsAtrasados').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        searching: true,
        "lengthChange": true,
        colReorder: true,
        // "ajax": {
        //     "url": " " + base_url + "Usuarios/getUsuarios",
        //     "dataSrc": ""
        // },
        // "columns": [
        //     { "data": "id_usuario" },
        //     { "data": "nombres" },
        //     { "data": "apellidos" },
        //     { "data": "telefono" },
        //     { "data": "correo" },
        //     { "data": "rol" },
        //     { "data": "estado" },
        //     { "data": "opciones" }
        // ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });
    $('#tblTicketsCerrados').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        searching: true,
        "lengthChange": true,
        colReorder: true,
        // "ajax": {
        //     "url": " " + base_url + "Usuarios/getUsuarios",
        //     "dataSrc": ""
        // },
        // "columns": [
        //     { "data": "id_usuario" },
        //     { "data": "nombres" },
        //     { "data": "apellidos" },
        //     { "data": "telefono" },
        //     { "data": "correo" },
        //     { "data": "rol" },
        //     { "data": "estado" },
        //     { "data": "opciones" }
        // ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });
});

const actualizarEstiloMenu = () => {
    for (let i = 0; i < 5; i++) {
        $('.menu').removeClass('opened');
    }

    $('.tickets-menu').addClass('opened');
}