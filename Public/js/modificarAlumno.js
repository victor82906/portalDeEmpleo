async function cargarAlumnos() {

    fetch("/portalDeEmpleo2/API/ApiAlumno.php", {
        method:"GET"
    }).
    then(response => response.json()).
    then(alumnos =>{

        const tbody = document.querySelector('#tablaAlumnos tbody');
        tbody.innerHTML = ''; // Limpiar la tabla

        alumnos.forEach(alumno => {
            const fila = document.createElement('tr');
            fila.innerHTML = '<td>'+alumno.id+'</td> <td>'+alumno.nombre+'</td> <td>'+alumno.correo+'</td>';
            tbody.appendChild(fila);
        });

        document.querySelector('#tablaAlumnos').editar();

    })

    //podria hacerlo asi pero lo que quisiera hacer tendria que hacerlo dentro de un then con un metodo, por la asincronicidad
    //let alumnos = "";
    //fetch(archivoJSON).then(x => x.json()).then(datos => {alumnos=datos});

    // const respuesta = await fetch(archivoJSON);
    // const alumnos = await respuesta.json();

    
    
}
// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', cargarAlumnos);
let btnAñadir = document.getElementById("añadir");
btnAñadir.onclick=function(){añadir()};


HTMLTableElement.prototype.editar=function(){
    let trs = this.getElementsByTagName("tr");
    let tam = trs.length;

    // si vuelvo a llamar a editar, quito la columna de edicion que ya exista
    for (let i = 0; i < tam; i++) {
        let ultimaCelda = trs[i].lastElementChild;
        if (ultimaCelda && (ultimaCelda.classList.contains("col-edicion") || ultimaCelda.innerText === "EDICION")) {
            ultimaCelda.remove();
        }
    }


    for(let i = 0; i < tam; i++){
        let celda;
        if(trs[i].parentElement.nodeName.toLocaleUpperCase() == "THEAD"){
            celda = document.createElement("th");
            celda.innerHTML="EDICION";
        }else{
            celda = document.createElement("td");
            let btnEditar = document.createElement("span");
            btnEditar.className = "boton editar";
            celda.appendChild(btnEditar);
            btnEditar.onclick=function(){this.parentElement.parentElement.editar()};
            let btnBorrar = document.createElement("span");
            btnBorrar.className = "boton borrar";
            celda.appendChild(btnBorrar);
            btnBorrar.onclick=function(){this.parentElement.parentElement.borrar()};
        }
        celda.classList.add("col-edicion");
        trs[i].appendChild(celda);
    }
}

HTMLTableRowElement.prototype.borrar=function(){
    let fila = this;
    let id = fila.querySelector("td").textContent;
    
    if(confirm("¿Estas seguro de que quieres eliminar al usuario con id " + id + "?")){
        fetch("/portalDeEmpleo2/API/ApiAlumno.php", {
            method:"DELETE",
            body: JSON.stringify({id: id})
        }).
        then((x)=>x.json()).
        then((json)=>{
            if(json.respuesta){
                fila.remove();
            }else{
                alert("No se ha podido borrar el alumno");
            }
        });
    }

    //fetch("localhost/API/ApiAlumno.php",{method:"DELETE",body:data,headers{......}}).then()
}

HTMLTableRowElement.prototype.editar=function(){
    fetch("/portalDeEmpleo2/Views/plantillaAlumno.php").then((x)=>x.text()).then((plantilla)=>{

        let velo = document.querySelector(".velo");
        let modal = document.querySelector(".modal");
        let volver = document.getElementById("cancelarEdit");
        let guardar = document.getElementById("guardarEdit");

        velo.classList.remove("hidden");
        modal.classList.remove("hidden");

        volver.onclick=function(){
            velo.classList.add("hidden");
            modal.classList.add("hidden");
        }

        let celdas = this.querySelectorAll("td");
        let id = celdas[0].innerText;
        // aqui hago un get para traer el usuario con el id
        fetch("/portalDeEmpleo2/API/ApiAlumno.php?id=" + id, {
            method:"GET"
        }).
        then((x)=>x.json()).
        then((json)=>{
            
            fetch("/portalDeEmpleo2/API/ApiFamilia.php", {
                method: "GET"
            }).then((x)=>x.json()).
            then((familias)=>{
                
                // borro lo que hubiera antes
                if(modal.querySelector(".formEditar")){
                    modal.querySelector(".formEditar").remove();
                }

                let div = document.createElement("div");
                div.className = "formEditar";
                div.innerHTML = plantilla;
                div.querySelector("#nombre").value = json.nombre;
                div.querySelector("#apellidos").value = json.apellidos;
                div.querySelector("#direccion").value = json.direccion;
                div.querySelector("#correo").value = json.correo;

                let divSelect = document.createElement("div");
                divSelect.className = "campos divGrande";

                let selectFamilia = document.createElement("select");
                selectFamilia.id = "familiaProfesional";
                selectFamilia.innerHTML = `<option value="">Selecciona familia profesional</option>`;

                familias.forEach(f =>{
                    let opt = document.createElement("option");
                    opt.value = f.id;
                    opt.textContent = f.nombre;
                    selectFamilia.appendChild(opt);
                });

                let selectCiclo = document.createElement("select");
                selectCiclo.id = "ciclo";
                selectCiclo.innerHTML = `<option value="">Selecciona ciclo formativo</option>`;
                let labCiclo = document.createElement("labeñ");
                labCiclo.textContent = "Agregar Ciclo:";
                divSelect.appendChild(labCiclo);
                divSelect.appendChild(selectFamilia);
                divSelect.appendChild(selectCiclo);
                div.appendChild(divSelect);

                modal.prepend(div);
                activarValidacionIndividual();


                selectFamilia.addEventListener("change", () => {
                    const familiaId = selectFamilia.value;
                    if (!familiaId) {
                        selectCiclo.innerHTML = `<option value="">Selecciona ciclo formativo</option>`;
                    }else{
                        fetch("/portalDeEmpleo2/API/ApiCiclo.php?familiaId=" + familiaId, {
                            method: "GET"
                        }).then((x) => x.json()).
                        then((ciclos) => {
                            selectCiclo.innerHTML = `<option value="">Selecciona ciclo formativo</option>`;
                            ciclos.forEach(c => {
                                let opt = document.createElement("option");
                                opt.value = c.id;
                                opt.textContent = `${c.nombre} (${c.nivel})`;
                                selectCiclo.appendChild(opt);
                            });
                        });
                    }
                });

                guardar.onclick=function(){
                    if(validaAlumno()){
                        velo.classList.add("hidden");
                        modal.classList.add("hidden");
                    
                        const formData = new FormData();
                        console.log(id);
                        formData.append("id", id);
                        formData.append("nombre", document.querySelector("#nombre").value);
                        formData.append("correo", document.querySelector("#correo").value);
                        formData.append("apellidos", document.querySelector("#apellidos").value);
                        formData.append("direccion", document.querySelector("#direccion").value);
                        formData.append("ciclo", selectCiclo.value);
                        let foto = document.getElementById("foto");
                        if(foto.files[0]){
                            formData.append("foto", foto.files[0], "foto.png");
                        }
                        let curriculum = document.getElementById("cv");
                        if(curriculum.files[0]) {
                            formData.append("cv", curriculum.files[0]);
                        }

                        formData.append("_method", "PUT"); // engaño diciendo que va por put
                        fetch("/portalDeEmpleo2/API/ApiAlumno.php", {
                            method: "POST",
                            body: formData
                        }).
                        then((x)=>x.json()).
                        then((data)=>{
                            if(!data.respuesta){
                                alert(data.mensaje);
                            }else{
                                alert("Alumno modificado correctamente");
                                cargarAlumnos();
                            }
                        });
                    }
                    
                }


            });
            
        });

    });

    // fetch("localhost/API/ApiAlumno.php",{method:"PUT",headers{......},body: JSON.stringify({id: id})}).then()
}

HTMLTableRowElement.prototype.guardar=function(){
    let inputs = this.querySelectorAll("input[type=text]");
    let tam = inputs.length;
    for(let i = 0; i < tam; i++){
        inputs[i].parentElement.innerHTML=inputs[i].value;
    }
}

function añadir(){
    fetch("/portalDeEmpleo2/Views/plantillaAlumno.php").then((x)=>x.text()).then((plantilla)=>{
        let velo = document.querySelector(".velo");
        let modal = document.querySelector(".modal");
        let volver = document.getElementById("cancelarEdit");
        let guardar = document.getElementById("guardarEdit");

        velo.classList.remove("hidden");
        modal.classList.remove("hidden");

        volver.onclick=function(){
            velo.classList.add("hidden");
            modal.classList.add("hidden");
        }

        if(modal.querySelector(".formEditar")){
            modal.querySelector(".formEditar").remove();
        }

        let div = document.createElement("div");
        div.className = "formEditar";
        div.innerHTML = plantilla;
        modal.prepend(div);
        // modal.appendChild(div);
        activarValidacionIndividual();

        guardar.onclick=function(){
            if(validaAlumno()){
                velo.classList.add("hidden");
                modal.classList.add("hidden");
            
                const formData = new FormData();
                formData.append("nombre", document.querySelector("#nombre").value);
                formData.append("correo", document.querySelector("#correo").value);
                formData.append("apellidos", document.querySelector("#apellidos").value);
                formData.append("direccion", document.querySelector("#direccion").value);

                let foto = document.getElementById("foto");
                if(foto.files[0]){
                    formData.append("foto", foto.files[0], "foto.png");
                }
                let curriculum = document.getElementById("cv");
                if(curriculum.files[0]) {
                    formData.append("cv", curriculum.files[0]);
                }

                // fetch("localhost/API/ApiAlumno.php",{method:"POST",headers{......},body: JSON.stringify(user)}).then()
                // este fetch deberia devolver el usuario creado con su id:, sino devuelve respuesta: false
                fetch("/portalDeEmpleo2/API/ApiAlumno.php", {
                    method: "POST",
                    body: formData
                }).
                then((x)=>x.json()).
                then((data)=>{
                    if(!data.respuesta){
                        alert(data.mensaje);
                    }else{
                        alert("Alumno creado correctamente");
                        cargarAlumnos();
                    }
                });
            }
        }

    });
}








document.getElementById("btnCargarMasiva").onclick = function() {
    let inputFile = document.getElementById("cargarMasiva");
    let archivo = inputFile.files[0];

    if(archivo){
        if(archivo.name.toLowerCase().endsWith(".csv")){
            const lector = new FileReader();
            lector.onload = function(){
                let datos = lector.result;
                const lineas = datos.split("\n");
                const alumnos = [];

                lineas.forEach(linea => {
                    linea = linea.split(";");
                    const alumno = {
                        nombre: linea[0],
                        apellidos: linea[1],
                        direccion: linea[2],
                        correo: linea[3]
                    };
                    alumnos.push(alumno);
                });

                pintarCarga(alumnos);
            }
            lector.readAsText(archivo);
        }else{
            alert("El fichero tiene que ser csv");
        }
    }else{
        alert("No hay fichero seleccionado");
    }

};


function pintarCarga(alumnos){
    fetch("/portalDeEmpleo2/Views/cargaMasivaTabla.php").then((x)=>x.text()).then((plantilla)=>{
        let velo = document.querySelector(".velo");
        let modal = document.querySelector(".modal");
        let volver = document.getElementById("cancelarEdit");
        let guardar = document.getElementById("guardarEdit");

        velo.classList.remove("hidden");
        modal.classList.remove("hidden");

        volver.onclick=function(){
            velo.classList.add("hidden");
            modal.classList.add("hidden");
        }

        if(modal.querySelector(".formEditar")){
            modal.querySelector(".formEditar").remove();
        }

        let div = document.createElement("div");
        div.className = "formEditar";
        div.innerHTML = plantilla;
        modal.prepend(div);

        let tbody = document.getElementById("cuerpoCarga");
        alumnos.forEach(alumno => {
            let fila = document.createElement("tr");
            if(validaAlumnoCarga(alumno)){
                fila.innerHTML = `
                            <td class="guardar"><input type="checkbox" name="alumnos[]" class="guardar" value="${alumno.correo}" checked></td>
                            <td class="nombre">${alumno.nombre}</td>
                            <td class="apellidos">${alumno.apellidos}</td>
                            <td class="direccion">${alumno.direccion}</td>
                            <td class="correo">${alumno.correo}</td>`;
            }else{
                fila.style.backgroundColor = "#ffcccc";
                fila.innerHTML = `
                            <td class="guardar"><input type="checkbox" name="alumnos[]" class="guardar" value="${alumno.correo}" checked></td>
                            <td class="nombre"><input type="text" name="nombre" class="nombre" value="${alumno.nombre}"></td>
                            <td class="apellidos"><input type="text" name="apellidos" class="apellidos" value="${alumno.apellidos}"></td>
                            <td class="direccion"><input type="text" name="direccion" class="direccion" value="${alumno.direccion}"></td>
                            <td class="correo"><input type="text" name="correo" class="correo" value="${alumno.correo}"></td>`;
            }
            tbody.appendChild(fila);

        }); // tengo que mandar el array alumnos al servidor y quedarme con los correos seleccionados

        guardar.onclick=function(){
            const filas = document.querySelectorAll("#cuerpoCarga tr");
            const alumnosNuevos = [];
            filas.forEach(fila => {
                const checkbox = fila.querySelector("input.guardar");
                if(checkbox.checked){
                    const valor = (selector) => {
                        const celda = fila.querySelector(selector);
                        const input = celda.querySelector("input");
                        return input ? input.value : celda.textContent;
                    };
                    const alumno = {
                        nombre: valor(".nombre"),
                        apellidos: valor(".apellidos"),
                        direccion: valor(".direccion"),
                        correo: valor(".correo")
                    };
                    alumnosNuevos.push(alumno);
                }  
            })
            
            let enviar = true;
            alumnosNuevos.forEach(alumno => {    
                if(!validaAlumnoCarga(alumno)){
                    enviar = false;
                }
            })

            if(enviar){
                velo.classList.add("hidden");
                modal.classList.add("hidden");

                fetch("/portalDeEmpleo2/API/ApiAlumno.php", {
                    method: "POST",
                    body: JSON.stringify(alumnosNuevos)
                }).
                then((x)=>x.json()).
                then((data)=>{
                    if(data.errores.length > 0){
                        let duplicados = "";
                        data.errores.forEach(error => {
                            duplicados = duplicados + error + ", "; 
                        })
                        alert("Los correos " + duplicados + "ya existen, los demas se añadieron con exito");
                        cargarAlumnos();
                    }else{
                        alert("Alumnos creados correctamente");
                        cargarAlumnos();
                    }
                });
            }else{
                alert("Hay campos de alumnos incorrectos");
            }
        }

    });
    
}

function validaAlumnoCarga(alumno){
    const nombre = alumno.nombre;
    const apellidos = alumno.apellidos;
    const direccion = alumno.direccion;
    const correo = alumno.correo;

    let valido = true;

    if (!validaNombre(nombre)) {
        valido = false;
    }

    if (!validaNombre(apellidos)) {
        valido = false;
    }

    if (!validaVacio(direccion)) {
        valido = false;
    }

    if (!validaCorreo(correo)) {
        valido = false;
    }

    return valido;

}

function validaAlumno() {
    const nombre = document.getElementById("nombre");
    const apellidos = document.getElementById("apellidos");
    const direccion = document.getElementById("direccion");
    const correo = document.getElementById("correo");
    let foto = document.getElementById("foto");
    let curriculum = document.getElementById("cv");

    let valido = true;

    // Limpiar errores previos
    document.querySelectorAll(".error").forEach(e => e.textContent = "");

    // Validar nombre
    if (!validaNombre(nombre.value)) {
        muestraError(nombre, "El nombre puede tener letras y espacios");
        valido = false;
    }

    // Validar apellidos
    if (!validaNombre(apellidos.value)) {
        muestraError(apellidos, "Los apellidos pueden tener letras y espacios");
        valido = false;
    }

    // Validar dirección
    if (!validaVacio(direccion.value)) {
        muestraError(direccion, "La dirección no puede estar vacía");
        valido = false;
    }

    // Validar correo
    if (!validaCorreo(correo.value)) {
        muestraError(correo, "El correo electrónico no es válido");
        valido = false;
    }
    
    // Validar Foto
    if (!validaFoto(foto)) {
        muestraError(foto, "La foto tiene que ser jpg o png");
        valido = false;
    }

    // Validar Curriculum
    if (!validaCv(curriculum)) {
        muestraError(curriculum, "El curriculum tiene que ser pdf");
        valido = false;
    }

    return valido;
}

// Mostrar mensaje de error junto al input
function muestraError(input, mensaje) {
    const spanError = input.parentElement.querySelector(".error");
    if (spanError) {
        spanError.textContent = mensaje;
    }
}

function activarValidacionIndividual() {
    const inputs = document.querySelectorAll(".input-form");

    inputs.forEach(input => {
        input.addEventListener("blur", function() {
            const id = this.id;
            const valor = this.value;
            const span = this.parentElement.querySelector(".error");
            span.textContent = ""; // limpia anterior error

            switch (id) {
                case "nombre":
                    if (!validaNombre(valor)){
                        span.textContent = "El nombre puede tener letras y espacios";
                    }
                break;
                case "apellidos":
                    if (!validaNombre(valor)){
                        span.textContent = "Los Los apellidos pueden tener letras y espacios";
                    }
                break;
                case "direccion":
                    if (!validaVacio(valor)){
                        span.textContent = "La dirección no puede estar vacía";
                    }
                break;
                case "correo":
                    if (!validaCorreo(valor)){
                        span.textContent = "El correo electrónico no es válido";
                    }
                break;
                case "foto":
                    if (!validaFoto(this)){
                        muestraError(this, "La foto tiene que ser jpg o png");
                    }
                break;
                case "cv":
                    if (!validaCv(this)){
                        muestraError(this, "El curriculum tiene que ser pdf");
                    }
                break;
            }
        });
    });
}

