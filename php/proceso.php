<?PHP
    require_once("carrusel.lib.php");
    
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
                    case 'eliminar':
                        echo $image->eliminar($_POST);
                        break;
                }
            break;
        }
    }
?>