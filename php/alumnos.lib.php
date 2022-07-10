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

    function modificar($datos){
        $cad = "";
        if ($datos['id']!="") {
            $insert = "UPDATE alumnos SET carrera='".$datos['newCarrera']."', no_control='".$datos['newNumero']."', curp='".$datos['newCurp']."', nombre='".$datos['newName']."', grupo='".$datos['newGrupo']."', sexo='".$datos['newSexo']."', estatus='".$datos['newEstatus']."', hiper='".$datos['newHiper']."' WHERE id=".$datos['id'];
            $consul = $this -> select($insert);
            $cad = "exito";
        }else{
            $cad = "error";
        }
        echo $cad;
    }

    function eliminar($datos){
        $cad = "";
        $id = $datos['id'];
        if ($datos['id']!="") {
            $insert = "DELETE FROM alumnos WHERE id=$id";
            $consul = $this -> select($insert);
            $cad = "exito";
        }else{
            $cad = "error";
        }
        return $cad;
    }
}

?>