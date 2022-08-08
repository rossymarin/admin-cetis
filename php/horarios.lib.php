<?PHP 
require_once("conexion.lib.php");
class Horario extends Conexion{

    function __construct(){
        $this->open();
    }

    function guardar($datos){
        $file_name =  $_FILES['file']['name']; 
        $tmp_name = $_FILES['file']['tmp_name']; 
        if(move_uploaded_file($tmp_name, "../resource/Documents/Horarios/".$datos['carrera']."/".$datos['semestre']."/".$file_name)){
            rename("../resource/Documents/Horarios/".$datos['carrera']."/".$datos['semestre']."/".$file_name, "../resource/Documents/Horarios/".$datos['carrera']."/".$datos['semestre']."/".$datos['carrera']."S".$datos['semestre'].".pdf"); 
            echo("exito");
        }else{
            echo("error");
        }  
    }
}

?>