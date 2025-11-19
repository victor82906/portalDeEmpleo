let id = document.getElementById("id").value;

fetch("/portalDeEmpleo2/API/ApiEmpresa.php?id=" + id, {
    method: "GET"
}).
then((x)=>x.json()).
then((empresa)=>{

    document.querySelector(".foto").src = empresa.foto;
    document.querySelector(".nombre").textContent = empresa.nombre;
    document.querySelector(".correo").textContent = empresa.correo;
    document.querySelector(".rol").textContent = empresa.rol;
    document.querySelector(".telefono").textContent = empresa.telefono;
    document.querySelector(".direccion").textContent = empresa.direccion;
    document.querySelector(".descripcion").textContent = empresa.descripcion;
    document.querySelector(".personaContacto").textContent = empresa.personaContacto;
    document.querySelector(".telefonoContacto").textContent = empresa.telefonoContacto;
    

});