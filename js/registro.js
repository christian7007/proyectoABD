function validarUsuario() {
    "use strict";

    var reg_usuario = /^[0-9a-zA-Z]+$/i,
        usuario = document.getElementById("ID_Usuario"),
        usuario_val = usuario.value;

    if (usuario_val === "") {
        document.getElementById("ID_Error_Usuario").style.display = "block";
        document.getElementById("ID_Error_Usuario").innerHTML = "Debes introducir un nombre de usuario";
        return false;
    } else if (!reg_usuario.test(usuario_val) || (usuario_val.length > 15)) {
        document.getElementById("ID_Error_Usuario").style.display = "block";
        document.getElementById("ID_Error_Usuario").innerHTML = "El usuario sólo puede contener números y letras y debe tener una longitud menor a 16";
        return false;
    } else {
        document.getElementById("ID_Error_Usuario").style.display = "none";
        return true;
    }
}

function validarContrasenya() {
    "use strict";

    var pass = document.getElementById("ID_Pass"),
        pass_val = pass.value;
    if ((pass_val === "") || (pass_val.length > 15) || (pass_val.length < 5)) {
        document.getElementById("ID_Error_Pass").style.display = "block";
        document.getElementById("ID_Error_Pass").innerHTML = "Debes introducir una contraseña (entre 5 y 15 caracteres)";
        return false;
    } else {
        document.getElementById("ID_Error_Pass").style.display = "none";
        return true;
    }
}

function validarContrasenya2() {
    "use strict";

    var pass = document.getElementById("ID_Pass"),
        pass_val = pass.value,
        pass2 = document.getElementById("ID_Pass2"),
        pass2_val = pass2.value;

    if ((pass_val !== pass2_val)) {
        document.getElementById("ID_Error_Pass2").style.display = "block";
        document.getElementById("ID_Error_Pass2").innerHTML = "Las contraseñas deben coincidir";
        return false;
    } else {
        document.getElementById("ID_Error_Pass2").style.display = "none";
        return true;
    }
}

function validarFecha() {
    "use strict";

    var fecha = document.getElementById("ID_Fecha"),
        fecha_val = fecha.value,
        fecha_actual = new Date(),
        fecha_min = new Date().setFullYear(fecha_actual.getFullYear() - 120),
        fecha_usr = new Date(fecha_val);

    if (isNaN(fecha_usr.getDate())) {
        document.getElementById("ID_Error_Fecha").style.display = "block";
        document.getElementById("ID_Error_Fecha").innerHTML = "Debes introducir una fecha";
        return false;
    } else if ((fecha_usr > fecha_actual) || (fecha_usr < fecha_min)) {
        document.getElementById("ID_Error_Fecha").style.display = "block";
        document.getElementById("ID_Error_Fecha").innerHTML = "Fecha no valida";
        return false;
    } else {
        document.getElementById("ID_Error_Fecha").style.display = "none";
        return true;
    }
}

function validarRegistro() {
    "use strict";

    var ret = (validarUsuario() & validarContrasenya() & validarContrasenya2() & validarFecha());

    if (ret === 0) {
        return false;
    } else {
        return true;
    }
}
