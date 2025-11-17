// llamo a la api para obtener el token y lo guardo en sessionStorage, el token se lo doy si esta logueado
fetch("url/obtenerToken.php").
then((response) => response.json()).
then((json) => {
    sessionStorage.setItem("token", json.token);
});
// en obtenerToken.php primero compruebo si esta logueado, si lo esta lo saco de la base de datos,
// si no lo esta lo creo, lo guardo en la base de datos y lo devuelvo



//
let f = new FormData(formulario);

fetch("url/dondoMandoElForm.php", {
    headers: {Autorizarion: "Bearer {"+ sessionStorage.getItem("token") +"}"},
    method: "POST",
    body: f
});

// en todas las apis pregunto ahora por el token para autorizar la peticion