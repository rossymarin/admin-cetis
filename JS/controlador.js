var urlI = "../php/Interfaz.php";
var urlP = "php/proceso.php";

function viewsPag(menu,vista,sub) {
    var datos = new FormData();
    var sol = new XMLHttpRequest();
    datos.append("opc", menu);
    datos.append("acc",vista);
    datos.append("subacc",sub);
    sol.addEventListener("load", function(e){
        document.getElementById("root").innerHTML=e.target.responseText;
    });
    sol.open("POST",urlI);
    sol.send(datos);
}

function consultarHistorial(){
    var datos = new FormData();
    var sol = new XMLHttpRequest();
    var curp = document.getElementById("curp").value;
    var nucontrol = document.getElementById("ncontrol").value;
    
    datos.append("opc", "alumno");
    datos.append("acc","consultar");
    datos.append("curp",curp);
    datos.append("ncontrol",nucontrol);

    sol.addEventListener("load", function(e){
        document.getElementById("hipper").style.visibility="visible";
        var cadena = e.target.responseText;
			cadena = cadena.split("-@-");
        
		for (var x=0; x <= cadena.length-2; x++){
			var js = JSON.parse(cadena[x]);
            if(js != null){
                var historial =js.hipper;
                document.getElementById("link").setAttribute("href",historial)
                document.getElementById("link").innerText="Historial "+curp;
            }else{
                alert("Los datos ingresados son incorrectos");
            }
        }
    });
    sol.open("POST",urlP);
    sol.send(datos);
}

function mostrar(div){
    div = document.getElementById(div)
    if (div.style.display==='none'){
        div.style.display="block";
    }else{
        div.style.display="none";
    }
    document.getElementById("link").value="";
}

function selectImage(){
  const form = document.getElementById("file"),
  fileInput = document.querySelector(".file-input");

  form.addEventListener("click", () =>{
    fileInput.click();
  });

  fileInput.onchange = ({target})=>{
  let file = target.files[0];
  if(file){
      let fileName = file.name; 
      console.log(fileName);
      uploadFile(fileName); 
    }
  }
}

function uploadFile(name){
  const form = document.getElementById("file"),
  fileUploader = document.getElementById("fileUploader"),
  uploadedArea = document.querySelector(".uploaded-area");
  let uploadedHTML = `<li class="row">
                        <div class="content upload">
                          <i class="fas fa-file-alt"></i>
                          <div class="details">
                            <span id="name" class="name">${name}</span>
                          </div>
                        </div>
                        <i class="fas fa-check"></i>
                      </li>`;
  fileUploader.style.display="none";
  uploadedArea.classList.remove("onprogress");
  uploadedArea.innerHTML = uploadedHTML; //uncomment this line if you don't want to show upload history
}

function saveFile(){
  const form = document.getElementById("file");

  let datos = new FormData(form);
  let sol = new XMLHttpRequest();
  
  datos.append("opc", "carrusel");
  datos.append("acc", "guardar");

  sol.addEventListener("load", function(e){
    cleanUploader();
  });
  sol.open("POST", urlP);
  sol.send(datos); 
}

function guardarImagen(){
    var nombre = document.getElementById("name");
    var link = document.getElementById("link");

    var datos = new FormData();
    var sol = new XMLHttpRequest;

    datos.append("opc", "carrusel");
    datos.append("acc", "agregar");
    datos.append("nombre", nombre.innerHTML);
    datos.append("hiper", link.value);
    
    sol.addEventListener("load", function(e) {
        saveFile();
    })

    sol.open("POST", urlP);
    sol.send(datos);  
}

function cleanUploader(){
  fileUploader = document.getElementById("fileUploader"),
  link = document.getElementById("c-link"),
  uploadedArea = document.querySelector(".uploaded-area");
  
  fileUploader.style.display = "block";
  uploadedArea.innerHTML = "";
  link.style.display = "none";
  document.getElementById("check-link").checked = false;
}

function listImage(){
  var datos = new FormData();
  var sol = new XMLHttpRequest;

  var tabla = document.getElementById("deleteTable")
  tabla.innerHTML="";

  datos.append("opc", "carrusel");
  datos.append("acc", "listar");
  
  sol.addEventListener("load", function(e) {
               
    var cadena = e.target.responseText;
    cadena=cadena.split("-@-");
    for (let x = 0; x < cadena.length-1; x++) {
      var js = JSON.parse(cadena[x]);
      tabla.innerHTML +=  `<tr>
                            <td>${js.nombre}</th>
                            <td>${js.hiper}</td> 
                            <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalConfirmDelete"><i class="fa fa-trash" style="color:red"></i></button></td>
                            <div class="modal modal-position fade" id="ModalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar esta imagen?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    La imagen no podra recuperarse.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript:deleteImage(${js.id})">Eliminar</button>
                                </div>
                                </div>
                            </div>
                            </div>
                          </tr>`
    }
  })

  sol.open("POST", urlP);
  sol.send(datos);  
}

function deleteImage(id){
  var datos = new FormData();
  var sol = new XMLHttpRequest;

  datos.append("opc", "carrusel");
  datos.append("acc", "eliminar");
  datos.append("id", id);

  sol.addEventListener("load", function(e) {
      setTimeout(function(){
        listImage();
      },500);
  })

  sol.open("POST", urlP);
  sol.send(datos);  
}