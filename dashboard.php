<?PHP 
     /*header('Content-Type: text/html; charset=UTF-8');
     //Iniciar una nueva sesión o reanudar la existente.
     session_start();
     //Si existe la sesión "cliente"..., la guardamos en una variable.
     if (isset($_SESSION['cliente'])){
         $cliente = $_SESSION['cliente'];
     }else{
  header('Location: index.php');//Aqui lo redireccionas al lugar que quieras.
      die() ;
 
     }*/
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/Header.css">
    <link rel="stylesheet" type="text/css" href="css/Carousel.css">
    <link rel="stylesheet" type="text/css" href="css/Navbar.css">
    <link rel="stylesheet" type="text/css" href="css/Footer.css">
    <link rel="stylesheet" type="text/css" href="css/Content.css">
    <link rel="stylesheet" type="text/css" href="css/Modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!--Carrusel-->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script async src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="JS/controlador.js"></script>
    <title>CETis 28</title>
</head>
<body onload="javascript:showCarousel(), selectImage(), listImage();">
    <div class="header">
        <img width="250px" class="header_logo ml-50" src="resource/Image/Logos/logo-sep.png" alt="header"/>
        <div class="div header_logo">
            <img class="img" src="resource/Image/Logos/portada-halcones2.png" alt="header"/>
        </div>
        <img class="header_logo mr-50" src="resource/Image/Logos/logo-dgeti.png" alt="header"/>
    </div>

    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="nav navbar-nav">
                <a class="navbar-brand" aria-current="page" href="javascript:viewsPag('index');">Inicio</a>
                <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <a class="navbar-brand" aria-current="page" href="javascript:viewsPag('index');">Carrusel</a>
                <a class="navbar-brand" aria-current="page" href="javascript:viewsPag('index');">Alumnos</a>
                <a class="navbar-brand" aria-current="page" href="javascript:viewsPag('index');">Horarios</a>
                <a class="navbar-brand" aria-current="page" href="javascript:viewsPag('index');">Tramites</a>  
                <form id="logout" name="logout">
                    <li><a href="session_destruir.php" id="cerrar sesion" class="navbar-brand navbar-right">Cerrar Sesión</a></li>
                </form> 
            </ul>
        </nav>
    </div>
    <div class="row">
            <div class="col-6">
                <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                    <ol id='carousel-number' class='carousel-indicators'></ol>
                    <div id="carousel-image" class='carousel-inner'></div>
                    <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Anterior</span>
                    </a>
                    <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Siguiente</span>
                    </a>
                </div>
            </div>
            <div class="col-5" id="tableImages">
                <table class="table" scrollable="true">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Imagenes</th>
                            <th scope="col">Hipervinculo</th>
                            <th scope="col" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="deleteTable"></tbody>
                </table>
            </div>

            <div class="col-1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsert">Agregar</button>
                <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalInsertTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Imagen</h5>
                                <button type="button" class="close" onclick="javascript:cleanUploader();" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <div id="fileUploader" class="wrapper">
                                <header>Agregar imagen al carrusel</header>
                                <form id="file" action="#">
                                    <input class="file-input" type="file" name="file" hidden>
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Clic aqui para seleccionar</p>
                                </form>
                            </div>
                            <section class="progress-area"></section>
                            <section class="uploaded-area"></section>
                            
                            <br>
                            <input type="checkbox" name="check-link" id="check-link" onclick="javascript:mostrar('c-link');"/>
                            <label for="check-link">Agregar hipervinculo</label>
                            <div id="c-link" style="display: none">
                                <label for="link">Ingresa el hipervinculo</label>
                                <input type="text" id="link" name="link"/>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="javascript:cleanUploader();" data-dismiss="modal">Cancelar</button>
                                <input type="button" id="insertImage" class="btn btn-primary" value="Guardar" onclick="javascript:guardarImagen();" data-dismiss="modal"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="page-footer font-small">
        <div class="footer-copyright text-center py-2 footer">
            Centro de Estudios Tecnológicos Industrial y de Servicio N° 28
            "Ignacio Allende"
            <p class="text-foot">Km. 108 carr. Fed. No.15 , Zirahuato de los Bernal, Zitácuaro, Mich, C.P.61500</p>
        </div>
    </footer>

</body>
</html>