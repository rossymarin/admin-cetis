<?PHP
    require_once("carrusel.lib.php");
    require_once("alumnos.lib.php");
    require_once("horarios.lib.php");
    
    if(isset($_POST['opc'])){
        switch($_POST['opc']){
            case 'carrusel':
                $image = new Carrusel();
                switch($_POST['acc']){
                    case 'agregar':
                        echo $image->agregar($_POST);
						//echo $_POST['hiper'];
                    break;
					case 'guardar':
						echo $image->guardar();
						break;
                    case 'listar':
                        echo $image->listImages();
                        break;
                    case 'guardar':
                        echo $image->modificar($_POST);
                        break;
                    case 'eliminar':
                        echo $image->eliminar($_POST);
                        break;
                    case 'mostrar':
                        echo $image->listImages($_POST);
                        break;
                    case 'modificar':
                        echo $image->modificar($_POST);
                }
            break;
            case 'alumnos':
                $alumno = new Alumnos();
                switch($_POST['acc']){
                    case 'listar':
                        echo $alumno->listar($_POST);
                    break;
                    case 'agregar':
                        echo $alumno->agregar($_POST);
                    break;
                    case 'modificar':
                        echo $alumno->modificar($_POST);
                    break;
                    case 'eliminar':
                        echo $alumno->eliminar($_POST);
                    break;
                }
            break;
            case 'horarios':
                $horario = new Horario();
                switch($_POST['acc']){
                    case 'guardar':
                        echo $horario->guardar($_POST);
                    break;
                }
            break;
        }
    }
?>