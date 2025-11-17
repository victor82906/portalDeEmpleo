fetch("/portalDeEmpleo2/API/ApiOferta.php", {
    method: "GET"
}).
then((x)=>x.json()).
then((ofertas)=>{
    ofertas.forEach(oferta => {

        fetch("/portalDeEmpleo2/API/ApiEmpresa.php?id=" + oferta.empresaId ,{
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
                section.querySelector(".fecha").textContent = oferta.fechaFin.date.split(" ")[0];
                section.querySelector(".correo").textContent = empresa.correo;
                section.querySelector(".telefonoContacto").textContent = empresa.telefonoContacto;

                main.appendChild(section);

                let btnSolicitar = section.querySelector(".boton");
                btnSolicitar.onclick=function(){
                    const solicitud = {
                        ofertaId: oferta.id
                    }
                    fetch("/portalDeEmpleo2/API/ApiSolicitud.php", {
                        method: "POST",
                        body: JSON.stringify(solicitud)
                    }).
                    then((x)=>x.json()).
                    then((data)=>{
                        alert(data.mensaje);
                    })
                }

            });

        });

    });
});