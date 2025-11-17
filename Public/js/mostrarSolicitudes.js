cargaSolicitudes();

function cargaSolicitudes(){
    fetch("/portalDeEmpleo2/API/ApiSolicitud.php", {
        method: "GET"
    }).
    then((x)=>x.json()).
    then((solicitudes)=>{
        solicitudes.forEach(solicitud => {
            
            fetch("/portalDeEmpleo2/API/ApiOferta.php?id=" + solicitud.ofertaId, {
                method: "GET"
            }).
            then((x)=>x.json()).
            then((oferta)=>{

                fetch("/portalDeEmpleo2/API/ApiEmpresa.php?id=" + oferta.empresaId, {
                    method: "GET"
                }).
                then((x)=>x.json()).
                then((empresa)=>{

                    fetch("/portalDeEmpleo2/Views/plantillaOferta.php").
                        then((x)=>x.text()).
                        then((plantilla)=>{

                            let main = document.querySelector("main");
                            let section = document.createElement("section");
                            section.innerHTML = plantilla;

                            let foto = section.querySelector(".foto");
                            foto.src = empresa.foto;

                            section.querySelector(".nombre").textContent = empresa.nombre;
                            section.querySelector(".descripcion").textContent = oferta.descripcion;
                            section.querySelector(".direccion").textContent = empresa.direccion;
                            section.querySelector(".fecha").textContent = solicitud.fecha.date.split(" ")[0];
                            section.querySelector(".correo").textContent = empresa.correo;
                            section.querySelector(".telefonoContacto").textContent = empresa.telefonoContacto;

                            main.appendChild(section);
                            let btnBorrar = section.querySelector(".boton");
                            btnBorrar.textContent = "Borrar";

                            let estado = document.createElement("p");
                            switch(solicitud.estado){
                                case "enProceso":
                                    estado.textContent = "En Proceso";
                                break;
                                case "aceptada":
                                    estado.className = "verde"
                                    estado.textContent = "Aceptada";
                                break;
                                case "rechazada":
                                    estado.className = "rojo"
                                    estado.textContent = "Rechazada";
                                break;
                            }
                            btnBorrar.parentElement.insertBefore(estado, btnBorrar);

                            btnBorrar.onclick=function(){
                                fetch("/portalDeEmpleo2/API/ApiSolicitud.php", {
                                    method: "DELETE",
                                    body: JSON.stringify({id: solicitud.id})
                                }).
                                then((x)=>x.json()).
                                then((data)=>{
                                    alert(data.mensaje);
                                    if(data.respuesta){
                                        section.remove();
                                    }
                                })
                            }

                        });

                });

            });

        });
    })
}
