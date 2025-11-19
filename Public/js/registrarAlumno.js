let nombre = document.getElementById("nombre");
let correo = document.getElementById("correo");
let apellidos = document.getElementById("apellidos");
let passw = document.getElementById("passw");
let direccion = document.getElementById("direccion");
let foto = document.getElementById("foto");
let curriculum = document.getElementById("cv");
let btnGuardar = document.querySelector("#boton > button");
let valorCorreo = correo.value;

let imagenCuadradaBlob = null;

foto.onchange = function () {
    const file = foto.files[0];
    const preview = document.getElementById("preview");

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (e) {
        const img = new Image();
        img.src = e.target.result;

        img.onload = function () {
            // Determinar lado del cuadrado
            const lado = Math.min(img.width, img.height);

            // Crear canvas cuadrado
            const canvas = document.createElement("canvas");
            canvas.width = 300;  // tamaño final (puedes cambiarlo)
            canvas.height = 300;

            const ctx = canvas.getContext("2d");

            // Recortar desde el centro
            const sx = (img.width - lado) / 2;
            const sy = (img.height - lado) / 2;

            ctx.drawImage(img, sx, sy, lado, lado, 0, 0, 300, 300);

            // Vista previa
            preview.src = canvas.toDataURL("image/jpeg");
            preview.style.display = "block";

            // Convertir a Blob para enviarlo
            canvas.toBlob(function (blob) {
                imagenCuadradaBlob = blob;
            }, "image/jpeg", 0.9);
        };
    };

    reader.readAsDataURL(file);
};

fetch("/portalDeEmpleo2/API/ApiFamilia.php", {
    method: "GET"
}).
then((x)=>x.json()).
then((familias)=>{
        
    let ultimoDiv = document.querySelectorAll(".archivo")[1];
    let div = document.createElement("div");
    div.className = "divCiclo";

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
    let labCiclo = document.createElement("label");
    labCiclo.textContent = "Agregar Ciclo:";
    div.appendChild(labCiclo);
    div.appendChild(selectFamilia);
    div.appendChild(selectCiclo);
    ultimoDiv.insertAdjacentElement("afterend", div);


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



    btnGuardar.onclick=function(){

        if(validaAlumno()){
            const formData = new FormData();
            
            formData.append("nombre", nombre.value);
            formData.append("correo", correo.value);
            formData.append("apellidos", apellidos.value);
            formData.append("contrasena", passw.value);
            formData.append("direccion", direccion.value);
            formData.append("ciclo", selectCiclo.value);
            if (foto.files[0]) {
                formData.append("foto", imagenCuadradaBlob, "foto.png");
            }
            if (curriculum.files[0]) {
                formData.append("cv", curriculum.files[0]);
            }
            
            fetch("/portalDeEmpleo2/API/ApiAlumno.php", {
                method: "POST",
                body: formData
            }).
            then((x)=>x.json()).
            then((data)=>{
                if(!data.respuesta){
                    alert(data.mensaje);
                }else{
                    const correoLog = {correo: data.alumno.correo};
                    fetch("/portalDeEmpleo2/API/ApiLogin.php", {
                        method: "POST",
                        body: JSON.stringify(correoLog)
                    }).
                    then((x)=>x.json()).
                    then((data)=>{
                        if(data.respuesta){
                            window.location.href = "?menu=home";
                        }
                    });
                }
                
            });
        }
    }

});

activarValidacionIndividual();

function validaAlumno() {
    let valido = true;

    // Limpiar errores previos
    document.querySelectorAll(".error").forEach(e => e.textContent = "");

    // Validar nombre
    if (!validaNombre(nombre.value)) {
        muestraError(nombre, "El nombre no es valido");
        valido = false;
    }

    // Validar apellidos
    if (!validaNombre(apellidos.value)) {
        muestraError(apellidos, "Los apellidos no son validos");
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

    // Validar contraseña
    if (!validaContrasena(passw.value)) {
        muestraError(passw, "La contraseña no es valida");
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

function activarValidacionIndividual() {
    const inputs = document.querySelectorAll("input");

    inputs.forEach(input => {
        input.addEventListener("blur", function() {
            const id = this.id;
            const valor = this.value;
            const spanError = input.parentElement.querySelector(".error");
            spanError.textContent = "";

            switch (id) {
                case "nombre":
                    if (!validaNombre(valor)){
                        muestraError(this, "El nombre no es valido");
                    }
                break;
                case "apellidos":
                    if (!validaNombre(valor)){
                        muestraError(this, "Los apellidos no son validos");
                    }
                break;
                case "direccion":
                    if (!validaVacio(valor)){
                        muestraError(this, "La dirección no puede estar vacía");
                    }
                break;
                case "correo":
                    if (!validaCorreo(valor)){
                        muestraError(this, "El correo electrónico no es válido");
                    }
                break;
                case "passw":
                    if (!validaContrasena(valor)){
                        muestraError(this, "La contraseña no es válida");
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

function muestraError(input, mensaje) {
    const spanError = input.parentElement.querySelector(".error");
    if (spanError) {
        spanError.textContent = mensaje;
    }
}