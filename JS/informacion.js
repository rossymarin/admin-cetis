var urlP = "php/proceso.php";

function getPeriodo(){
    selectPeriodo = document.getElementById("periodo")
    periodo = selectPeriodo.options[selectPeriodo.selectedIndex].value

    if (periodo == "AGO - DIC") {
        document.getElementById("semestre").innerHTML = `
            <option selected disabled>Selecciona una opción</option>
            <option>1</option>
            <option>3</option>
            <option>5</option>
        `;
    }else if(periodo == "ENE - JUL") {
        document.getElementById("semestre").innerHTML = `
            <option selected disabled>Selecciona una opción</option>
            <option>2</option>
            <option>4</option>
            <option>6</option>
        `;
    }else{
        document.getElementById("semestre").innerHTML = `
            <option selected disabled>Selecciona un periodo primero</option>
        `;
    }
}

function selectFile(){
    fileInput = document.querySelector(".file-input");
    fileInput.click();
    fileInput.onchange = ({target})=>{
        let file = target.files[0];
        console.log(target.files)
        if(file){
            let fileName = file.name; 
            document.getElementById("fileUploader").style.display = 'none';
            uploadFile(fileName); 
            filePreview(fileInput);
        }
    }
}

function filePreview(input) {
    pdfViewer = document.getElementById("pdf-viewer");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            pdfViewer.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function uploadFile(name){
    uploadedArea = document.getElementById("uploaded-area");
    let uploadedHTML = `<li class="row" style="width: 400px">
                            <div class="content upload">
                            <i class="fas fa-file-alt"></i>
                            <div class="details">
                                <span id="name" class="name">${name}</span>
                            </div>
                            </div>
                            <i class="fas fa-check"></i>
                        </li>`;
    uploadedArea.innerHTML = uploadedHTML; 
}

function saveFileHorario(){
    const form = document.getElementById("file");
    carrera = document.getElementById("carrera");
    semestre = document.getElementById("semestre");
    var alertSuccess = document.getElementById("alert-s");
    var alertWarning = document.getElementById("alert-w");
  
    let datos = new FormData(form);
    let sol = new XMLHttpRequest();
    
    datos.append("opc", "horarios");
    datos.append("acc", "guardar");
    datos.append("carrera", carrera.value);
    datos.append("semestre", semestre.value);
  
    sol.addEventListener("load", function(e){
        if(e.target.responseText == "exito"){
            alertSuccess.innerHTML="Horario cargado con exito";
            mostrar("alert-s");
        }else{
            alertWarning.innerHTML="Ocurrio un error";
            mostrar("alert-w");
        }
        setTimeout(function(){
            ocultar("alert-s");
            ocultar("alert-w");
            if(e.target.responseText == "exito"){
                cleanHorario();
            }
        },2500);
        console.log(e.target.responseText)
    });
    sol.open("POST", urlP);
    sol.send(datos); 
}

function saveFile(tramite){
    const form = document.getElementById("file");
    var alertSuccess = document.getElementById("alert-s");
    var alertWarning = document.getElementById("alert-w");
  
    let datos = new FormData(form);
    let sol = new XMLHttpRequest();

    if(tramite === "horario"){
        carrera = document.getElementById("carrera");
        semestre = document.getElementById("semestre");

        datos.append("opc", "horarios");
        datos.append("acc", "guardar");
        datos.append("carrera", carrera.value);
        datos.append("semestre", semestre.value);

    }else{
        formato = document.getElementById(tramite);

        datos.append("opc", tramite);
        datos.append("acc", "guardar");
        datos.append("formato", formato.value);
    }
  
    sol.addEventListener("load", function(e){
        if(e.target.responseText == "exito"){
            alertSuccess.innerHTML="Archivo cargado con exito";
            mostrar("alert-s");
        }else{
            alertWarning.innerHTML="Ocurrio un error, intentalo de nuevo";
            mostrar("alert-w");
        }
        setTimeout(function(){
            ocultar("alert-s");
            ocultar("alert-w");
            if(e.target.responseText == "exito"){
                clean();
            }
        },2500);
    });
    sol.open("POST", urlP);
    sol.send(datos); 
}

function clean(){
    fileUploader = document.getElementById("fileUploader"),
    selectPeriodo = document.getElementById("periodo"),
    selectCarrera = document.getElementById("carrera"),
    selectServicio = document.getElementById("servicio"),
    selectPracticas = document.getElementById("practicas"),
    pdfViewer = document.getElementById("pdf-viewer");
    uploadedArea = document.querySelector(".uploaded-area");

    selectPeriodo.value = "Selecciona una opción"; 
    selectCarrera.value = "Selecciona una opción"; 
    selectServicio.value = "Selecciona una opción"; 
    selectPracticas.value = "Selecciona una opción"; 
    getPeriodo();
    fileUploader.style.display = "block";
    uploadedArea.innerHTML = "";
    pdfViewer.src = "resource/Documents/preview.pdf";
}

function ocultar(div){
    div = document.getElementById(div)
    div.style.display="none";
}

function mostrar(div){
    div = document.getElementById(div)
    div.style.display="block";
}

function test(parametro){
    document.getElementById("saveFile").onclick=()=>saveFile(parametro);
}

function test2(parametro){
    console.log(parametro)
}