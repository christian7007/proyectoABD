function validarLogin() {
    "use strict";
    
    var ret = (validarUsuario() & validarContrasenya());

    if (ret === 0) {
        return false;
    } else {
        return true;
    }
}