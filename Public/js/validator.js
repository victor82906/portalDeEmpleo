function validaVacio(cadena){
    if(typeof cadena !== "string"){
        return false;
    }
    return cadena.trim();
}

function validaNombre(texto) {
    const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    if (typeof texto !== "string" || texto !== texto.trim()) {
        return false;
    }
    return regexNombre.test(texto);
}

function validaCorreo(correo){
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(typeof correo !== "string"){
        return false;
    }
    return regexCorreo.test(correo.trim());
}

function validaContrasena(contrasena) {
    const regexContrasena = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    if (typeof contrasena !== "string" || contrasena !== contrasena.trim()) {
        return false;
    }
    return regexContrasena.test(contrasena);
}

function validaTelefono(telefono) {
    const regexTelefono = /^[679]\d{8}$/;
    if (typeof telefono !== "string" || telefono !== telefono.trim()) {
        return false;
    }
    return regexTelefono.test(telefono);
}

function validaFoto(foto){
    const archivo = foto.files[0];
    let tiposValidos = ["image/jpeg", "image/png"];
    let valida = false;
    if(!archivo){
        valida = true;
    }else{
        if(tiposValidos.includes(archivo.type)){
            valida = true;
        }
    }
    return valida;
}

function validaCv(cv){
    const archivo = cv.files[0];
    let tiposValidos = ["application/pdf"];
    let valida = false;
    if(!archivo){
        valida = true;
    }else{
        if(tiposValidos.includes(archivo.type)){
            valida = true;
        }
    }
    return valida;
}