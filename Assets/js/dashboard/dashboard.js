$(function() {
    actualizarEstiloMenu();
    var usu_id = $('#user_idx').val();

    if ($('#rol_idx').val() == 1) {
        $.post("../../controller/usuario.php?op=total", { usu_id: usu_id }, function(data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });

        $.post("../../controller/usuario.php?op=totalabierto", { usu_id: usu_id }, function(data) {
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });

        $.post("../../controller/usuario.php?op=totalcerrado", { usu_id: usu_id }, function(data) {
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });

        $.post("../../controller/usuario.php?op=grafico", { usu_id: usu_id }, function(data) {
            data = JSON.parse(data);

            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
                barColors: ["#1AB244"],
            });
        });

    } else {
        $.post("../../controller/ticket.php?op=total", function(data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });

        $.post("../../controller/ticket.php?op=totalabierto", function(data) {
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });

        $.post("../../controller/ticket.php?op=totalcerrado", function(data) {
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });

        $.post("../../controller/ticket.php?op=grafico", function(data) {
            data = JSON.parse(data);

            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value']
            });
        });

    }

    // var autoLockTimer;
    // window.onload = resetTimer;
    // window.onmousemove = resetTimer;
    // window.onmousedown = resetTimer; // catches touchscreen presses
    // window.onclick = resetTimer; // catches touchpad clicks
    // window.onscroll = resetTimer; // catches scrolling with arrow keys
    // window.onkeypress = resetTimer;

    // function lockScreen() {
    //     window.location.href = 'http://localhost/helpdesk/view/Logout/logout.php';
    // }

    // function resetTimer() {
    //     clearTimeout(autoLockTimer);
    //     autoLockTimer = setTimeout(lockScreen, 5000); // time is in milliseconds
    // }
});

const actualizarEstiloMenu = () => {
    for (let i = 0; i < 5; i++) {
        $('.menu').removeClass('opened');
    }

    $('.dashboard-menu').addClass('opened');
}