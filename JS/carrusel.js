var urlI = "php/Interfaz.php";
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

function showCarousel(){
  var datos = new FormData();
  var sol = new XMLHttpRequest;

  var carouselImage = document.getElementById("carousel-image");
  var carouselNumber = document.getElementById("carousel-number");

  datos.append("opc", "carrusel");
  datos.append("acc", "mostrar");
  sol.addEventListener("load", function(e) {
    //console.log(e.target.responseText) //respuesta de php
    cleanCarousel();
    var cadena = e.target.responseText;
    cadena=cadena.split("-@-");
    var slideNumber = 0
    for (let x = cadena.length-2; x >= 0; x--) {
      var js = JSON.parse(cadena[x]);
      if (js.hiper!="") {
        if (slideNumber == 0) {
          carouselImage.innerHTML = `<div class='carousel-item active'>
                                      <a href="${js.hiper}" target="_blank"><img class='d-block w-100 carousel-img' src='${'php/files/'+js.nombre}' alt='Slide'><img/></a>
                                    </div>`
          carouselNumber.innerHTML += `<li style="background-color: #cccc" data-target='#carouselExampleIndicators' data-slide-to='${slideNumber}'></li>`;
        }else{
          carouselImage.innerHTML +=  `<div class='carousel-item'>
                                        <a href="${js.hiper}" target="_blank"><img class='d-block w-100 carousel-img' src='${'php/files/'+js.nombre}' alt='Slide'></img></a>
                                      </div>`;
          carouselNumber.innerHTML += `<li data-target='#carouselExampleIndicators' data-slide-to='${slideNumber}'></li>`;
        }
        slideNumber++;
      }else{
        if (slideNumber == 0) {
          carouselImage.innerHTML = `<div class='carousel-item active'>
                                      <img class='d-block w-100 carousel-img' src='${'php/files/'+js.nombre}' alt='Slide'><img/>
                                    </div>`
          carouselNumber.innerHTML += `<li data-target='#carouselExampleIndicators' data-slide-to='${slideNumber}'></li>`;
        }else{
          carouselImage.innerHTML +=  `<div class='carousel-item'>
                                          <img class='d-block w-100 carousel-img' src='${'php/files/'+js.nombre}' alt='Slide'/>
                                      </div>`;
          carouselNumber.innerHTML += `<li data-target='#carouselExampleIndicators' data-slide-to='${slideNumber}'></li>`;
        }
        slideNumber++;
      }
    }
  })

  sol.open("POST", urlP);
  sol.send(datos);  
}

function cleanCarousel(){
  var carouselImage = document.getElementById("carousel-image");
  var carouselNumber = document.getElementById("carousel-number");
  carouselImage.innerHTML = "";
  carouselNumber.innerHTML = "";
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
    showCarousel();
    listImage();
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
      console.log(e.target.responseText)
      if (e.target.responseText == "existe") {
        alert("existe")
      }else{
        saveFile();
      }
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
    for (let x = cadena.length-2; x >= 0; x--) {
      var js = JSON.parse(cadena[x]);
      if (js.hiper=="") {
        js.hiper = "..."
      }
      tabla.innerHTML +=  `<tr>
                            <td id=${js.id} width="160px"><div style="overflow-x:auto; width:160px">${js.nombre}</th>
                            <td width="200px"><div class="scroll" style="overflow-x:auto; width:200px">${js.hiper}</div></td> 
                            <td>
                              <a href="#modify${js.id}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                              <div id="modify${js.id}" class="modals fade"  role="dialog">
                                <div class="modal-contenido">
                                  <div class="modal-header">
                                      <h5 class="modal-title">Modificar imagen</h2>
                                      <a href="#">
                                          <button type="button" class="close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </a>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nombre-m${js.id}">Nombre:</label>
                                      <input type="text" class="form-control" id="nombre-m${js.id}" value="${js.nombre}">
                                      <label for="hiper-m${js.id}">Hipervinculo:</label>
                                      <input type="text" class="form-control" id="hiper-m${js.id}" value="${js.hiper}">
                                    
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                      <a href="#"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                      <a href="#saveChanges${js.id}"><button type="button" class="btn btn-warning">Modificar</button></a>
                                  </div>
                                </div>  
                              </div>
                              <div id="saveChanges${js.id}" class="modals fade"  role="dialog">
                                <div class="modal-contenido">
                                  <div class="modal-header">
                                    <h5 class="modal-title">¿Desea modificar esta imagen?</h2>
                                      <a href="#">
                                        <button type="button" class="close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </a>
                                  </div>
                                  <div class="modal-body">
                                    <p>Los cambios no podrán deshacerse.</p>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="#modify${js.id}"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                    <a href="#"><button type="button" class="btn btn-primary" onclick="javascript:modifyImage(${js.id});">Guardar Cambios</button></a>
                                  </div>
                                </div>  
                              </div>
                            </td>
                            <td>
                              <a href="#delete${js.id}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <div id="delete${js.id}" class="modals fade"  role="dialog">
                                <div class="modal-contenido">
                                  <div class="modal-header">
                                      <h5 class="modal-title">¿Desea eliminar esta imagen?</h2>
                                      <a href="#">
                                          <button type="button" class="close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </a>
                                  </div>
                                  <div class="modal-body">
                                      <p>El archivo no podrá recuperarse.</p>
                                  </div>
                                  <div class="modal-footer">
                                      <a href="#"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                      <a href="#"><button type="button" class="btn btn-primary" onclick="javascript:deleteImage(${js.id});">Eliminar</button></a>
                                  </div>
                                </div>  
                              </div>
                            </td>
                          </tr>`
    }
    //<button type="button" class="btn btn-primary" onclick="javascript:deleteImage(${js.id});">Eliminar</button>
  })

  sol.open("POST", urlP);
  sol.send(datos);  
}

function modifyImage(id){
  var datos = new FormData();
  var sol = new XMLHttpRequest;

  var newName = document.getElementById("nombre-m"+id);
  var newHiper = document.getElementById("hiper-m"+id);

  datos.append("opc", "carrusel");
  datos.append("acc", "modificar");
  datos.append("id", id);
  datos.append("newName", newName.value);
  datos.append("newHiper", newHiper.value);

  sol.addEventListener("load", function(e) {
    console.log(e.target.responseText)
      setTimeout(function(){
        listImage();
        showCarousel();
      },500);
  })
  sol.open("POST", urlP);
  sol.send(datos);  
}

function deleteImage(id){
  var datos = new FormData();
  var sol = new XMLHttpRequest;
  console.log(id+" deleted");

  var nombre = document.getElementById(id);

  datos.append("opc", "carrusel");
  datos.append("acc", "eliminar");
  datos.append("id", id);
  datos.append("nombre", nombre.innerText);

  sol.addEventListener("load", function(e) {
    console.log(e.target.responseText)
      setTimeout(function(){
        listImage();
        showCarousel();
      },500);
  })
  sol.open("POST", urlP);
  sol.send(datos);  
}