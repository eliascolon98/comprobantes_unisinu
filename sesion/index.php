<!DOCTYPE html>
<?php 
require("seguridad.php"); 
require_once("../js/conexion.php");
@session_start(); 
$user= $_SESSION["usuarioactual"];
$con=con();
$qry="SELECT * FROM empleados where id_usuario ='$user'";
$sql=mysqli_query($con,$qry);
$res=  mysqli_fetch_array($sql); 
$res[3] = ($res[3] == 'admin') ? "": header("Location: ../index.html");

?> 
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Comprobantes</title>
  <link rel="stylesheet" href="../css/normalize.css" />
  <link rel="stylesheet" href="../assets/fonts/fontawesome-5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.min.css" />
  <link rel="stylesheet" href="../css/comprobantes-style.css" />
  <link rel="stylesheet" href="../css/layout-tools.css" />
  <script src="../js/main.js"></script>
</head>

<body class="">
  <div class="main-wrapper">
    <header id="unisinu-header" class="unisinu-header">
      <div class="unisinu-header__title">
        <span id="menu-sw" class="unisinu-header__menu-sw"><i class="fas fa-bars"></i></span>
        <span class="hidable">Bienvenido
          <span id="user-name" class="unisinu-header__user-name"><?php echo $res['nombre'] ?></span></span>
        <span class="unisinu-header__unisinu-label">Universidad del sinú seccional Cartagena</span>
      </div>
      <div class="unisinu-header__menu-options">
        <ul class="unisinu-header__options-ul">
          <li id="unisinu-user-sw" class="unisinu-header__options-li">
            <a href="#"><i class="fas fa-user"></i></a>
            <div id="unisinu-user" class="unisinu-user hide">
              <img class="unisinu-user__photo" src="" alt="">
              <h3 class="unisinu-user__name"><?php echo $res['nombre'] ?></h3>
              <h3 class="unisinu-user__info"><?php echo $res['correo'] ?></h3>
              <ul class="unisinu-user__menu">
                <li class="unisinu-user__li update-user-adm">
                  <i class="fas fa-user"></i>
                  <a href="actualizarAdmin.php">Perfil de Usuario</a>
                </li>
                <li class="unisinu-user__li sign-out">
                  <i class="fas fa-sign-out-alt"></i>
                  <a href="../salir.php">Cerrar sesión</a>
                </li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
    </header>
    <div class="body-container" data-simplebar>
      <div id="main-flex-wrapper" class="main-flex-wrapper full-main">
        <div id="main-card" class="card">
          <div class="card__header">
            <h2 class="card__title">Volantes de pago</h2>
            <label for="caja_busqueda">Buscar por cedula</label>
            <input type="text" name="caja_busqueda" id="caja_busqueda"
             placeholder="" class="login_form_input">
            
          </div>
          <div class="card__body" id="tabla-adm">
            
          </div>
        </div>

      
      </div>
    </div>
  </div>
  <div id="sidebar" class="sidebar">
    <div class="sidebar__header">
      <span class="sidebar__header__user-rol">Administrador <i class="fas fa-caret-right"></i></span>
    </div>
    <div class="sidebar__menu">
      <div class="sidebar__menu-set">
        <ul class="sidebar__menu-set-ul">

          <li class="sidebar__menu-set-li sidebar__menu-set-li--active">
            <a href="index.php"><i class="fas fa-list-ul"></i>Consultar</a>
          </li>
          <li class="sidebar__menu-set-li">
            <a href="subir_archivos.php"><i class="fas fa-file-pdf"></i>Subir archivos</a>
          </li>
        </ul>
      </div>

    </div>
    <div class="sidebar__brand-container">
      <div class="sidebar__logo">
        <img src="../assets/img/logo.png" alt="" />
      </div>
      <div class="sidebar__copy">
        Copyright &copy; 2020 Unisinú Cartagena
        <br />
        Desarrollado por <span>Biinyu Games Studios</span>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>
  <script src="../js/jquery-3.1.1.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>