const BASE_URL = 'http://helpdesk2.test/';

$(document).ready(function() {
    startTime();
    fntValidText();
    fntValidNumber();
    fntValidEmail();
});

/**
 * función que valida el ingreso de caracteres
 * @param {e} Evento del teclados
 * @returns boolean: true si es válido, false si no lo es
 */
const controlTag = (e) => {
    let tecla = (document) ? e.keyCode : e.which;

    if (tecla == 8) {
        return true;
    }

    if (tecla == 0 || tecla == 9) {
        return true;
    }

    let patron = /[0-9\s]/;
    let n = String.fromCharCode(tecla);
    return patron.test(n);
}

/**
 * Función para validar un string
 * @param {string} txtString String a ser validado
 * @returns boolean: true si es válido, false si no lo es
 */
const testText = (txtString) => {
    let stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);

    if (stringText.test(txtString)) {
        return true;
    }

    return false;
}

/**
 * Función para validar un número
 * @param {int} intNumero Número a ser validado
 * @returns boolean: true si es válido, false si no lo es
 */
const testEntero = (intNumero) => {
    let intCantidad = new RegExp(/^([0-9])*$/);

    if (intNumero != "") {
        if (intCantidad.test(intNumero)) {
            return true;
        }
    }

    return false;
}

/**
 * Función para validar un email
 * @param {string} email Email a ser validados
 * @returns boolean: true si es válido, false si no lo es
 */
const validarEmail = (email) => {
    let stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if (stringEmail.test(email) == false) {
        return false;
    }

    return true;
}

/**
 * Función para validar un campo tipo email
 * @returns void
 */
const fntValidEmail = () => {
    let validEmail = $('.validEmail');
    $.each(validEmail, function(validEmailParam) {
        $(this).on('keyup', function() {
            let inputValue = $(this).val();
            if (!validarEmail(inputValue)) {
                $(this).parent().addClass('form-group-error');
                $(this).addClass('is-invalid');
                $(this).siblings('.text-muted').css('display', 'block');
            } else {
                $(this).parent().removeClass('form-group-error');
                $(this).removeClass('is-invalid');
                $(this).siblings('.text-muted').css('display', 'none');
            }
        })
    });
}

/**
 * Función para validar un campo tipo text
 * @returns void
 */
const fntValidText = () => {
    let validText = $('.validText');
    $.each(validText, function(validTextParam) {
        $(this).on('keyup', function() {
            let inputValue = $(this).val();
            if (!testText(inputValue)) {
                $(this).parent().addClass('form-group-error');
                $(this).addClass('is-invalid');
                $(this).siblings('.text-muted').css('display', 'block');
            } else {
                $(this).parent().removeClass('form-group-error');
                $(this).removeClass('is-invalid');
                $(this).siblings('.text-muted').css('display', 'none');
            }
        })
    });
}

/**
 * Función para validar un campo tipo number
 * @returns void
 */
const fntValidNumber = () => {
    let validNumber = $('.validNumber');
    $.each(validNumber, function(validNumberParam) {
        $(this).on('keyup', function() {
            let inputValue = $(this).val();
            if (!testEntero(inputValue)) {
                $(this).parent().addClass('form-group-error');
                $(this).addClass('is-invalid');
                $(this).siblings('.text-muted').css('display', 'block');
            } else {
                $(this).parent().removeClass('form-group-error');
                $(this).removeClass('is-invalid');
                $(this).siblings('.text-muted').css('display', 'none');
            }
        })
    });
}

/**
 * @description Función que valida una contraseña
 * @param {string} txtPassword Contraseña a ser validada
 * @returns {boolean} True si es válida, False si no lo es
 */
const testPassword = (txtPassword) => {
    let espacios = false;
    let cont = 0;

    while (!espacios && (cont < txtPassword.length)) {
        if (txtPassword.charAt(cont) == " ") {
            espacios = true;
        }
        cont++;
    }

    if (espacios) {
        return false;
    }

    if (txtPassword.length >= 8) {
        let mayuscula = false;
        let minuscula = false;
        let numero = false;
        let caracter_raro = false;

        for (let i = 0; i < txtPassword.length; i++) {
            if (txtPassword.charCodeAt(i) >= 65 && txtPassword.charCodeAt(i) <= 90) {
                mayuscula = true;
            } else if (txtPassword.charCodeAt(i) >= 97 && txtPassword.charCodeAt(i) <= 122) {
                minuscula = true;
            } else if (txtPassword.charCodeAt(i) >= 48 && txtPassword.charCodeAt(i) <= 57) {
                numero = true;
            } else {
                caracter_raro = true;
            }
        }
        if (mayuscula == true && minuscula == true && caracter_raro == true && numero == true) {
            return true;
        }
    }
    return false;
}

function startTime() {
    today = new Date();
    h = today.getHours();
    m = today.getMinutes();
    s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    AMPM = "AM";
    if (h >= 12) {
        h = h - 12;
        AMPM = "PM"
    }
    h = checkTime(h);
    $('#txtHora').html(h);
    $('#txtMinuto').html(m);
    $('#txtSegundo').html(s);
    $('#AMPM').html(AMPM);
    t = setTimeout('startTime()', 500);
}

function checkTime(i) { if (i < 10) { i = "0" + i; } return i; }
// window.onload = function() { startTime(); }