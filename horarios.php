<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script async src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/Header.css">
    <link rel="stylesheet" type="text/css" href="css/Navbar.css">
    <link rel="stylesheet" type="text/css" href="css/Content.css">
    <link rel="stylesheet" type="text/css" href="css/Horarios.css">
    <script type="text/javascript" src="JS/horarios.js"></script>
    <script type="text/javascript" src="JS/navbar.js"></script>
    <title>Document</title>
</head>
<body onload="getPeriodo();">
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
            <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <a class="navbar-brand" aria-current="page" href="javascript:navigate('dashboard.php');">Carrusel</a>
            <a class="navbar-brand" aria-current="page" href="javascript:navigate('alumnos.php');">Alumnos</a>
            <a class="navbar-brand" aria-current="page" href="javascript:navigate('horarios.php');">Horarios</a>
            <a class="navbar-brand" aria-current="page" href="javascript:viewsPag('index');">Tramites</a>  
            <form id="logout" name="logout">
                <li><a href="session_destruir.php" id="cerrar sesion" class="navbar-brand navbar-right">Cerrar Sesión</a></li>
            </form> 
        </ul>
        </nav>
    </div>
    <div id="alert-s" class="alert alert-success" role="alert" style="display: none;"></div>
    <div id="alert-w" class="alert alert-danger" role="alert" style="display: none;"></div>

   
    <div class="row ml-2 pt-1">
        <div class="col-5 pt-3">
            <div class="row">
                <div class="col-3">
                    <label for="periodo">Periodo</label>    
                    <label class="mt-3" for="periodo">Carrera</label>
                    <label class="mt-3" for="periodo">Semestre</label>
                </div>
                <div class="col-8">                    
                    <select id="carrera" class="form-control" onchange="getPeriodo()">
                        <option selected disabled>Selecciona una opción</option>
                        <option>Ofimatica</option>
                        <option>Trabajo Social</option>
                        <option>Mantenimiento Automotriz</option>
                        <option>Programacion</option>
                        <option>Laboratorista Quimico</option>
                    </select>
                    <select id="periodo" class="form-control mt-2" onchange="getPeriodo()">
                        <option selected disabled>Selecciona una opción</option>
                        <option>ENE - JUL</option>
                        <option>AGO - DIC</option>
                    </select>
                    <select id="semestre" class="form-control mt-2 mb-2" onchange="getPeriodo()"></select>
                </div>
            </div>
            <div class="row pt-0">
                <div id="fileUploader" class="wrapper" style="margin-left: 5%;">
                    <form id="file" action="#" onclick="selectFile();">
                        <input class="file-input" type="file" name="file" hidden>
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Clic aqui para seleccionar el archivo</p>
                    </form>
                </div>
                <section class="progress-area"></section>
                <section id="uploaded-area" class="uploaded-area"></section>
                <button class="btn btn-block btn-success col-4 mt-5" style="margin-left: 30%;" type="button">Guardar</button>
            </div>
        </div>
        <div class="col-7" style="height: 580px;">
            <iframe class="pdf-viewer" src="test.pdf"></iframe>
        </div>  
    </div>    
</body>
</html>