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
    <link rel="stylesheet" type="text/css" href="css/Informacion.css">
    <script type="text/javascript" src="JS/informacion.js"></script>
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
            <a class="navbar-brand" aria-current="page" href="javascript:navigate('informacion.php');">Información</a>  
            <form id="logout" name="logout">
                <li><a href="session_destruir.php" id="cerrar sesion" class="navbar-brand navbar-right">Cerrar Sesión</a></li>
            </form> 
        </ul>
        </nav>
    </div>
    <div id="alert-s" class="alert alert-success" role="alert" style="display: none;"></div>
    <div id="alert-w" class="alert alert-danger" role="alert" style="display: none;"></div>

    <div class="row pl-2 pt-1 pb-0">
        <div class="col-5 pt-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="horarios-tab" data-toggle="tab" data-target="#tab-horarios" type="button" role="tab" aria-controls="horarios" aria-selected="true" onclick="test('horario');">Horarios</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="servicio-tab" data-toggle="tab" data-target="#tab-servicio" type="button" role="tab" aria-controls="servicio" aria-selected="false" onclick="test('servicio');">Servicio Social</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="practicas-tab" data-toggle="tab" data-target="#tab-practicas" type="button" role="tab" aria-controls="practicas" aria-selected="false" onclick="test('practicas');">Practicas</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-horarios" role="tabpanel" aria-labelledby="horarios-tab">
                    <div class="row">
                        <div class="col-3">
                            <label for="periodo">Periodo</label>    
                            <label class="mt-3" for="carrera">Carrera</label>
                            <label class="mt-3" for="semestre">Semestre</label>
                        </div>
                        <div class="col-8">   
                            <select id="periodo" class="form-control" onchange="getPeriodo()">
                                <option selected disabled>Selecciona una opción</option>
                                <option>ENE - JUL</option>
                                <option>AGO - DIC</option>
                            </select>                 
                            <select id="carrera" class="form-control mt-2">
                                <option selected disabled>Selecciona una opción</option>
                                <option>Ofimatica</option>
                                <option>Trabajo Social</option>
                                <option>Mantenimiento Automotriz</option>
                                <option>Programacion</option>
                                <option>Laboratorista Quimico</option>
                                <option>Contabilidad</option>
                            </select>
                            <select id="semestre" class="form-control mt-2 mb-2"></select>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-servicio" role="tabpanel" aria-labelledby="servicio-tab">
                    <div class="row">
                        <div class="col-3">
                            <label for="servicio">Formato</label>    
                        </div>
                        <div class="col-8">   
                            <select id="servicio" class="form-control">
                                <option selected disabled>Selecciona una opción</option>
                                <option>Solicitud de servicio social</option>
                                <option>Carta compromiso Servicio Social</option>
                                <option>Informe Bimestral de actividades</option>
                                <option>Informe final de actividades</option>
                            </select>   
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-practicas" role="tabpanel" aria-labelledby="practicas-tab">
                    <div class="row">
                        <div class="col-3">
                            <label for="practicas">Formato</label>    
                        </div>
                        <div class="col-8">   
                            <select id="practicas" class="form-control">
                                <option selected disabled>Selecciona una opción</option>
                                <option>Solicitud de practicas</option>
                                <option>Informe mensual de practicas</option>
                                <option>Informe final de practicas</option>
                            </select>   
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt-0" style="width: 500px">
                <div id="fileUploader" class="wrapper" style="margin-left: 5%;">
                    <form id="file" action="#" onclick="selectFile();">
                        <input class="file-input" type="file" name="file" hidden>
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Clic aqui para seleccionar el archivo</p>
                    </form>
                </div>
                <section id="uploaded-area" class="uploaded-area" style="width: 500px; margin-left: 10%;"></section>

                <button class="btn btn-block btn-danger col-4 mt-4" style="margin-left: 15%;" type="button" onclick="clean();">Cancelar</button>

                <button class="btn btn-block btn-success col-4 mt-4" style="margin-left: 10%;" type="button" data-toggle="modal" data-target="#saveHorario">Guardar</button>
                <div class="modal fade" id="saveHorario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">¿Está seguro de cargar el archivo?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">No se podrán deshacer los cambios</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="saveFile('horario');" id="saveFile" data-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 pt-2" style="height: 600px;">
            <iframe id="pdf-viewer" class="pdf-viewer" src="resource/Documents/preview.pdf"></iframe>
        </div>  
    </div>    
</body>
</html>