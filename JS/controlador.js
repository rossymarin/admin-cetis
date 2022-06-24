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
      if (slideNumber == 0) {
        carouselImage.innerHTML = `<div class='carousel-item active'>
                                      <img class='d-block w-100 carousel-img' src='${'php/files/'+js.nombre}' alt='Slide'/>
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
                            <td id=${js.id}>${js.nombre}</th>
                            <td>${js.hiper}</td> 
                            <td>
                           <button type="button" class="btn btn-primary" onclick="javascript:deleteImage(${js.id});">Eliminar</button>
                              
                            </td>
                          </tr>`
                          console.log(js.id)
    }
  })

  sol.open("POST", urlP);
  sol.send(datos);  
}

function deleteImage(id){
  var datos = new FormData();
  var sol = new XMLHttpRequest;
  console.log(id);

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