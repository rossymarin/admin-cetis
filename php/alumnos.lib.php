<?PHP 
require_once("conexion.lib.php");
class Alumnos extends Conexion{

    function __construct(){
        $this->open();
    }

    function listar(){
		$cad = "";
		$qry = "SELECT * FROM alumnos";
        $consul = $this->select($qry);

		while ($ren = $consul->fetch_array(MYSQLI_ASSOC)) {
			$cad.= json_encode($ren)."-@-";
		}
		echo $cad;
	}

    function agregar($datos){
        $cad = "";
        $query = 'SELECT count(*) AS count FROM alumnos WHERE curp= "'. $datos['curp'].'"';
        $consul = $this -> select($query);
        $count = $consul->fetch_array(MYSQLI_ASSOC);
        if ($datos['nombre']!="") {
            if ($count['count'] > 0) {
                $cad = "existe";
            } else {  
                $insert = 'INSERT INTO alumnos VALUES (NULL, "'.$datos['carrera'].'", "'.$datos['numero'].'", "'.$datos['curp'].'", "'.$datos['nombre'].'", "'.$datos['grupo'].'", "'.$datos['sexo'].'", "'.$datos['estatus'].'",  "'.$datos['hiper'].'");';
                $consul = $this -> select($insert);
                $cad = "exito";
            }
        }else{
            $cad = "error";
        }
        echo $cad;
    }

    function guardar(){
        $file_name =  $_FILES['file']['name']; //getting file name
        $tmp_name = $_FILES['file']['tmp_name']; //getting temp_name of file
        $file_up_name = time().$file_name; //making file name dynamic by adding time before file name
        move_uploaded_file($tmp_name, "files/".$file_name); //moving file to the specified folder with dynamic name      
    }

    function modificar($datos){
        $cad = "";
        $query = 'SELECT nombre FROM carrusel WHERE id='.$datos['id'];
        $consul = $this -> select($query);
        $nombre = $consul->fetch_array(MYSQLI_ASSOC);

        if ($datos['id']!="" && rename("files/".$nombre['nombre'], "files/".$datos['newName'])) {
            $insert = "UPDATE carrusel SET nombre='".$datos['newName']."', hiper='".$datos['newHiper']."' WHERE id=".$datos['id'];
            $consul = $this -> select($insert);
            $cad = "Se ha modificado este producto";
        }else{
            $cad = "Error";
        }
        echo $nombre['nombre']." ".$datos['newName']." ".$datos['newHiper'];
    }

    function eliminar($datos){
        $cad = "";
        $id = $datos['id'];
        $nombre = $datos['nombre'];
        if ($datos['id']!="" && unlink('files/'.$nombre)) {
            $insert = "DELETE FROM carrusel WHERE id=$id";
            $consul = $this -> select($insert);
            $cad = "Se ha eliminado este producto ".$id;
        }else{
            $cad = "Error ".$nombre;
        }
        return $cad;
    }
}

?>