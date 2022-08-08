var urlP = "php/proceso.php";

function getPeriodo(){
    selectPeriodo = document.getElementById("periodo")
    periodo = selectPeriodo.options[selectPeriodo.selectedIndex].value

    if (periodo == "AGO - DIC") {
        document.getElementById("semestre").innerHTML = `
            <option selected disabled>Selecciona una opción</option>
            <option>1ro</option>
            <option>3ro</option>
            <option>5to</option>
        `;
    }else if(periodo == "ENE - JUL") {
        document.getElementById("semestre").innerHTML = `
            <option selected disabled>Selecciona una opción</option>
            <option>2do</option>
            <option>4to</option>
            <option>6to</option>
        `;
    }else{
        document.getElementById("semestre").innerHTML = `
            <option selected disabled>Selecciona un periodo</option>
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

function saveFile(){
    const form = document.getElementById("file");
  
    let datos = new FormData(form);
    let sol = new XMLHttpRequest();
    
    datos.append("opc", "horarios");
    datos.append("acc", "guardar");
  
    sol.addEventListener("load", function(e){
      console.log("listo")
    });
    sol.open("POST", urlP);
    sol.send(datos); 
  }

function ocultar(div){
    console.log(div)
    div = document.getElementById(div)
    div.style.display="none";
}