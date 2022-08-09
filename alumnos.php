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
    <link rel="stylesheet" type="text/css" href="css/Alumnos.css">
    <link rel="stylesheet" type="text/css" href="css/Navbar.css">
    <link rel="stylesheet" type="text/css" href="css/Content.css">
    <link rel="stylesheet" type="text/css" href="css/Modal.css">
    <script type="text/javascript" src="JS/alumnos.js"></script>
    <script type="text/javascript" src="JS/navbar.js"></script>
    <title>CETis 28</title>
</head>
<body onload="javascript:listAlumnos();">
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
    <div class="col-10 mt-2">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            </div>
            <input id="search" type="text" class="form-control" placeholder="Buscar" onkeyup="javascript:filter()">
        </div>
    </div>
    <div class="row">   
        <div class="col-10 scroll" id="tableAlumnos">
            <table id="tableAlumnos2" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Carrera</th>
                        <th scope="col">No. Control</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Hipervinculo</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody id="bodyAlumnos"></tbody>
            </table>
        </div>
        <div class="col-1">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsert">Agregar</button>
            <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalInsertTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Agregar Alumno</h5>
                            <button type="button" class="close" onclick="javascript:cleanUploader();" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="carrera">Carrera</label>
                                        <select id="carrera" class="form-control">
                                            <option selected disabled>Selecciona</option>
                                            <option>Programación</option>
                                            <option>Contabilidad</option>
                                            <option>Trabajo Social</option>
                                            <option>Laboratorista Químico</option>
                                            <option>Ofimática</option>
                                            <option>Mantenimiento Automotriz</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="numero">No. Control</label>
                                        <input id="numero" type="text" class="form-control" placeholder="Ingresa">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="curp">CURP</label>
                                        <input id="curp" type="text" class="form-control" placeholder="Ingresa">
                                    </div>
                                    <div class="col">
                                        <label for="nombre">Nombre</label>
                                        <input id="nombre" type="text" class="form-control" placeholder="Ingresa">
                                    </div>                                   
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="grupo">Grupo</label>
                                        <select id="grupo" class="form-control">
                                            <option selected disabled>Selecciona</option>
                                            <option>1A</option>
                                            <option>2A</option>
                                            <option>3A</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="sexo">Sexo</label>
                                        <p class="mt-1">
                                            <input type="radio" id="m" name="hm" value="h" required> Hombre
                                            <input type="radio" id="f" name="hm" value="m" required> Mujer
                                        </p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="estatus">Estatus</label>
                                        <select id="estatus" class="form-control">
                                            <option selected disabled>Selecciona</option>
                                            <option>Regular</option>
                                            <option>Irregular</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="hiper">Hipervinculo</label>
                                        <input id="hiper" type="text" class="form-control" placeholder="Ingresa">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="javascript:cleanRegister();" data-dismiss="modal">Cancelar</button>
                            <a href="#save"><button type="button" class="btn btn-primary">Guardar</button></a>
                            <div id="save" class="modals fade" role="dialog">
                                <div class="modal-contenido">
                                  <div class="modal-header">
                                    <h5 class="modal-title">¿Desea agregar este alumno?</h2>
                                      <a href="#">
                                        <button type="button" class="close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </a>
                                  </div>
                                  <div class="modal-body">
                                    <p>Se hará el registro en la base de datos.</p>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="#"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                                    <a href="#"><button type="button" class="btn btn-primary" onclick="javascript:saveAlumnos();">Aceptar</button></a>
                                  </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>