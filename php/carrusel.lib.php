<?PHP 
require_once("conexion.lib.php");
class Carrusel extends Conexion{

    function __construct(){
        $this->open();
    }

    function listImages(){
		$cad = "";
		$qry = "SELECT * FROM carrusel";
        $consul = $this->select($qry);

		while ($ren = $consul->fetch_array(MYSQLI_ASSOC)) {
			$cad.= json_encode($ren)."-@-";
		}
		echo $cad;
	}

    function agregar($datos){
        $cad = "";
        if ($datos['nombre']!="" ) {
            $insert = 'INSERT INTO carrusel VALUES (NULL, "'.$datos['nombre'].'", "'.$datos['hiper'].'")';
            $consul = $this -> select($insert);
            $cad = "Guardado con Exito";
        }else{
            $cad = "Datos incompletos";
        }
        echo $cad;
    }

    function guardar(){
        $file_name =  $_FILES['file']['name']; //getting file name
        $tmp_name = $_FILES['file']['tmp_name']; //getting temp_name of file
        $file_up_name = time().$file_name; //making file name dynamic by adding time before file name
        move_uploaded_file($tmp_name, "files/".$file_name); //moving file to the specified folder with dynamic name      
    }

}

?>