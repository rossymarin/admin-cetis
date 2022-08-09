<?PHP 
require_once("conexion.lib.php");
class Informacion extends Conexion{

    function __construct(){
        $this->open();
    }

    function guardarHorario($datos){
        $file_name =  $_FILES['file']['name']; 
        $tmp_name = $_FILES['file']['tmp_name']; 
        if(move_uploaded_file($tmp_name, "../resource/Documents/Horarios/".$datos['carrera']."/".$datos['semestre']."/".$file_name)){
            rename("../resource/Documents/Horarios/".$datos['carrera']."/".$datos['semestre']."/".$file_name, "../resource/Documents/Horarios/".$datos['carrera']."/".$datos['semestre']."/".$datos['carrera']."S".$datos['semestre'].".pdf"); 
            echo("exito");
        }else{
            echo("error");
        }  
    }

    function guardarFormatoServicio($datos){
        $file_name =  $_FILES['file']['name']; 
        $tmp_name = $_FILES['file']['tmp_name']; 
        if(move_uploaded_file($tmp_name, "../resource/Documents/Servicio/".$file_name)){
            rename("../resource/Documents/Servicio/".$file_name, "../resource/Documents/Servicio/".$datos['formato'].".pdf"); 
            echo("exito");
        }else{
            echo("error");
        }  
    }

    function guardarFormatoPracticas($datos){
        $file_name =  $_FILES['file']['name']; 
        $tmp_name = $_FILES['file']['tmp_name']; 
        if(move_uploaded_file($tmp_name, "../resource/Documents/Practicas/".$file_name)){
            rename("../resource/Documents/Practicas/".$file_name, "../resource/Documents/Practicas/".$datos['formato'].".pdf"); 
            echo("exito");
        }else{
            echo("error");
        }  
    }
}

?>