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
        if(file){
            let fileName = file.name; 
            document.getElementById("fileUploader").style.display = 'none';
            uploadFile(fileName); 
        }
    }
}

function uploadFile(name){
    uploadedArea = document.getElementById("uploaded-area");
    let uploadedHTML = `<li class="row">
                            <div class="content upload">
                            <i class="fas fa-file-alt"></i>
                            <div class="details">
                                <span id="name" class="name">${name}</span>
                            </div>
                            </div>
                            <i class="fas fa-check"></i>
                        </li>`;
    uploadedArea.innerHTML = uploadedHTML; //uncomment this line if you don't want to show upload history
}

function ocultar(div){
    console.log(div)
    div = document.getElementById(div)
    div.style.display="none";
}