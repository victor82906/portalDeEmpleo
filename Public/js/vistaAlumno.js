let id = document.getElementById("id").value;

fetch("/portalDeEmpleo2/API/ApiAlumno.php?id=" + id, {
    method: "GET"
}).
then((x)=>x.json()).
then((alumno)=>{

    document.querySelector(".foto").src = alumno.foto;
    document.querySelector(".nombreApellidos").textContent = alumno.nombre + " " + alumno.apellidos;
    document.querySelector(".correo").textContent = alumno.correo;
    document.querySelector(".rol").textContent = alumno.rol;
    document.querySelector(".direccion").textContent = alumno.direccion;
    if(!alumno.cv){
        document.querySelector(".cv").onclick = (e) => {e.preventDefault()};
        document.querySelector(".cv").textContent = "Sin Curriculum";
    }else{
        document.querySelector(".cv").href = alumno.cv;
        document.querySelector(".cv").target = "_blank";
    }
    let divCiclos = document.querySelector(".ciclos");
    alumno.ciclos.forEach(ciclo => {
        let p = document.createElement("p");
        p.textContent = "- " + ciclo.nombre;
        divCiclos.appendChild(p);
    });
    

});