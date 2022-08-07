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

  <form>
    <div class="row">
      <div class="col-1">
        <label for="periodo">Periodo</label>
      </div>
      <div class="col-4">
        <select id="periodo" class="form-control" onchange="getPeriodo()">
          <option>ENE - JUL</option>
          <option>AGO - DIC</option>
        </select>
      </div>
    </div>
  </form>

  <div id="accordion" class="mt-2 ml-2 mr-2 col-6">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button id="accordion1" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"></button>
        </h5>
      </div>
      
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <table class="table">
            <tbody id="tableHorarios1"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button id="accordion2" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"></button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <table class="table">
            <tbody id="tableHorarios2"></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button id="accordion3" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"></button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          <table class="table">
            <tbody id="tableHorarios3"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
</div> 
</body>
</html>