var urlI = "php/Interfaz.php";
var urlP = "php/proceso.php";

var carrera = document.getElementById("carrera");
var numero = document.getElementById("numero");
var curp = document.getElementById("curp");
var nombre = document.getElementById("nombre");
var grupo = document.getElementById("grupo");
var fem = document.getElementById("f");
var mas = document.getElementById("m");
var estatus = document.getElementById("estatus");
var hiper = document.getElementById("hiper");

function filter() {
    var input, filter, table, tr, td, i, j, visible;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("tableAlumnos");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        visible = false;
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                visible = true;
            }
        }
        if (visible === true) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

function listAlumnos(){
    var datos = new FormData();
    var sol = new XMLHttpRequest;

    var tabla = document.getElementById("bodyAlumnos")
    tabla.innerHTML="";
  
    datos.append("opc", "alumnos");
    datos.append("acc", "listar");
    
    sol.addEventListener("load", function(e) {
        var cadena = e.target.responseText;
        cadena=cadena.split("-@-");
        for (let x = cadena.length-2; x >= 0; x--) {
          var js = JSON.parse(cadena[x]);
          console.log(js.sexo+ "jjjj")
          tabla.innerHTML +=  `<tr>
                                <td width="150px"><div style="overflow-x:auto; width:150px;">${js.carrera}</div></td>
                                <td width="100px"><div>${js.no_control}</div></td> 
                                <td width="190px"><div style="overflow-x:auto; width:190px;">${js.curp}</div></td>
                                <td width="160px"><div style="overflow-x:auto; width:160px;">${js.nombre}</div></td> 
                                <td width="100px"><div>${js.grupo}</div></td>
                                <td width="100px"><div>${js.sexo}</div></td> 
                                <td width="150px"><div>${js.estatus}</div></td>
                                <td width="160px"><div style="overflow-x:auto; width:160px">${js.hiper}</div></td> 
                                <td>
                                    <a href="#modifyAlumno${js.id}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <div id="modifyAlumno${js.id}" class="modals fade"  role="dialog">
                                        <div class="modal-contenido">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modificar Alumno</h2>
                                            <a href="#">
                                                <button type="button" class="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="carreraA-m${js.id}">Carrera</label>
                                                <select id="carreraA-m${js.id}" class="form-control">
                                                    <option selected disabled>${js.carrera}</option>
                                                    <option>Programación</option>
                                                    <option>Contabilidad</option>
                                                    <option>Trabajo Social</option>
                                                    <option>Laboratorista Químico</option>
                                                    <option>Ofimática</option>
                                                    <option>Mantenimiento Automotriz</option>
                                                </select>
                                                <label for="numeroA-m${js.id}">Numero de Control:</label>
                                                <input type="text" class="form-control" id="numeroA-m${js.id}" value="${js.no_control}">
                                                <label for="curpA-m${js.id}">CURP:</label>
                                                <input type="text" class="form-control" id="curpA-m${js.id}" value="${js.curp}">
                                                <label for="nombreA-m${js.id}">Nombre:</label>
                                                <input type="text" class="form-control" id="nombreA-m${js.id}" value="${js.nombre}">
                                                <label for="grupoA-m${js.id}">Grupo</label>
                                                <select id="grupoA-m${js.id}" class="form-control">
                                                    <option selected disabled>${js.grupo}</option>
                                                    <option>Programación</option>
                                                    <option>Contabilidad</option>
                                                    <option>Trabajo Social</option>
                                                    <option>Laboratorista Químico</option>
                                                    <option>Ofimática</option>
                                                    <option>Mantenimiento Automotriz</option>
                                                </select>
                                                <label for="sexo">Sexo</label>
                                                <p class="mt-1">
                                                    <input type="radio" id="H${js.id}" name="hm" value="h" required> Hombre
                                                    <input type="radio" id="M${js.id}" name="hm" value="m" required> Mujer
                                                </p>
                                                <label for="estatusA-m${js.id}">Estatus</label>
                                                <select id="estatusA-m${js.id}" class="form-control">
                                                    <option selected disabled>${js.estatus}</option>
                                                    <option>Regular</option>
                                                    <option>Irregular</option>
                                                </select>
                                                <label for="hiperA-m${js.id}">Hipervinculo:</label>
                                                <input type="text" class="form-control" id="hiperA-m${js.id}" value="${js.hiper}">

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
                                            <h5 class="modal-title">¿Desea modificar este registro?</h2>
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
                                            <a href="#modifyAlumno${js.id}"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                            <a href="#"><button type="button" class="btn btn-primary" onclick="javascript:modifyAlumno(${js.id});">Guardar Cambios</button></a>
                                        </div>
                                        </div>  
                                    </div>
                                    </td>
                                    <td>
                                    <a href="#deleteAlumno${js.id}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <div id="deleteAlumno${js.id}" class="modals fade"  role="dialog">
                                        <div class="modal-contenido">
                                        <div class="modal-header">
                                            <h5 class="modal-title">¿Desea eliminar este registro?</h2>
                                            <a href="#">
                                                <button type="button" class="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p>Los datos no podrán recuperarse.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                            <a href="#"><button type="button" class="btn btn-primary" onclick="javascript:deleteAlumno(${js.id});">Eliminar</button></a>
                                        </div>
                                        </div>  
                                    </div>
                                </td>
                              </tr>` 
                             //(js.sexo==="M" ? document.getElementById("M").checked = true : document.getElementById("H").checked = true)
                             if (js.sexo=="M"){
                                document.getElementById("M"+js.id).checked = true
                             }else{
                                document.getElementById("H"+js.id).checked = true
                             }
        }
                              
      
    })
  
    sol.open("POST", urlP);
    sol.send(datos);  
}

function saveAlumnos(){
    var carrera = document.getElementById("carrera");
    var numero = document.getElementById("numero");
    var curp = document.getElementById("curp");
    var nombre = document.getElementById("nombre");
    var grupo = document.getElementById("grupo");
    var fem = document.getElementById("f");
    var estatus = document.getElementById("estatus");
    var hiper = document.getElementById("hiper");
    var alertSuccess = document.getElementById("alert-s");
    var alertWarning = document.getElementById("alert-w");

    var datos = new FormData();
    var sol = new XMLHttpRequest;

    if (fem.checked) {
        sexo="M"
    }else{
        sexo="H"
    }

    datos.append("opc", "alumnos");
    datos.append("acc", "agregar");
    datos.append("carrera", carrera.options[carrera.selectedIndex].value);
    datos.append("numero", numero.value);
    datos.append("curp", curp.value);
    datos.append("nombre", nombre.value);
    datos.append("grupo", grupo.options[grupo.selectedIndex].value);
    datos.append("sexo", sexo);
    datos.append("estatus", estatus.options[estatus.selectedIndex].value);
    datos.append("hiper", hiper.value);
    
    sol.addEventListener("load", function(e) {
        if (e.target.responseText == "existe") {
            alertWarning.innerHTML ="Este alumno ya está registrado"
            mostrar("alert-w");
        }else if(e.target.responseText == "exito"){
            alertSuccess.innerHTML="Agregado con exito"
            mostrar("alert-s");
            listAlumnos();
            cleanRegister();
        }else{
            alertWarning.innerHTML="Datos invalidos"
            mostrar("alert-w");
        }
        setTimeout(function(){
            ocultar("alert-s");
            ocultar("alert-w");
        },2500);
    })

    sol.open("POST", urlP);
    sol.send(datos);  
}

function modifyAlumno(id){
    var datos = new FormData();
    var sol = new XMLHttpRequest;
  
    var newCarrera = document.getElementById("carreraA-m"+id);
    var newNumero = document.getElementById("numeroA-m"+id);
    var newCurp = document.getElementById("curpA-m"+id);
    var newName = document.getElementById("nombreA-m"+id);
    var newGrupo = document.getElementById("grupoA-m"+id);
    var newEstatus = document.getElementById("estatusA-m"+id);
    var newHiper = document.getElementById("hiperA-m"+id);
    var fem = document.getElementById("M"+id);
    var alertSuccess = document.getElementById("alert-s");
    var alertWarning = document.getElementById("alert-w");

    if (fem.checked) {
        sexo="M"
    }else{
        sexo="H"
    }
  
    datos.append("opc", "alumnos");
    datos.append("acc", "modificar");
    datos.append("id", id);
    datos.append("newCarrera", newCarrera.options[newCarrera.selectedIndex].value);
    datos.append("newNumero", newNumero.value);
    datos.append("newCurp", newCurp.value);
    datos.append("newName", newName.value);
    datos.append("newGrupo", newGrupo.options[newGrupo.selectedIndex].value);
    datos.append("newEstatus", newEstatus.options[newEstatus.selectedIndex].value);
    datos.append("newSexo", sexo);
    datos.append("newHiper", newHiper.value);
  
    sol.addEventListener("load", function(e) {
        if(e.target.responseText == "exito"){
            alertSuccess.innerHTML="Modificado con exito"
            mostrar("alert-s");
            listAlumnos();
            cleanRegister();
        }else{
            alertWarning.innerHTML="Algo salió mal"
            mostrar("alert-w");
        }
        setTimeout(function(){
            ocultar("alert-s");
            ocultar("alert-w");
        },2500);
    })
    sol.open("POST", urlP);
    sol.send(datos);  
  }
  
  function deleteAlumno(id){
    var datos = new FormData();
    var sol = new XMLHttpRequest;
    console.log(id+" deleted");
  
    var alertSuccess = document.getElementById("alert-s");
    var alertWarning = document.getElementById("alert-w");
  
    datos.append("opc", "alumnos");
    datos.append("acc", "eliminar");
    datos.append("id", id);
  
    sol.addEventListener("load", function(e) {
        if(e.target.responseText == "exito"){
            alertSuccess.innerHTML="Eliminado con exito"
            mostrar("alert-s");
            listAlumnos();
            cleanRegister();
        }else{
            alertWarning.innerHTML="Algo salió mal"
            mostrar("alert-w");
        }
        setTimeout(function(){
            ocultar("alert-s");
            ocultar("alert-w");
        },2500);
    })
    sol.open("POST", urlP);
    sol.send(datos);  
  }

function cleanRegister(){
    
}

function mostrar(div){
    div = document.getElementById(div)
    div.style.display="block";
}

function ocultar(div){
    div = document.getElementById(div)
    div.style.display="none";
}