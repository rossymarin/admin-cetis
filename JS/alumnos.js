var urlI = "php/Interfaz.php";
var urlP = "php/proceso.php";

function filter() {
    // Declare variables 
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
          tabla.innerHTML +=  `<tr>
                                <td width="150px"><div style="overflow-x:auto; width:150px">${js.carrera}</div></td>
                                <td width="100px"><div>${js.no_control}</div></td> 
                                <td width="190px"><div style="overflow-x:auto; width:190px">${js.curp}</div></td>
                                <td width="160px"><div style="overflow-x:auto; width:160px">${js.nombre}</div></td> 
                                <td width="100px"><div>${js.grupo}</div></td>
                                <td width="100px"><div>${js.sexo}</div></td> 
                                <td width="150px"><div>${js.estatus}</div></td>
                                <td width="160px"><div style="overflow-x:auto; width:160px">${js.hiper}</div></td> 
                              </tr>`
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
    var mas = document.getElementById("m");
    var estatus = document.getElementById("estatus");
    var hiper = document.getElementById("hiper");

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
      console.log(e.target.responseText)
      if (e.target.responseText == "existe") {
        alert("existe")
      }else{
        alert("Agregado con exito")
        listAlumnos();
      }
    })

    sol.open("POST", urlP);
    sol.send(datos);  
}