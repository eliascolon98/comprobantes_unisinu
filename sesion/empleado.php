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


?> 
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>unisinu</title>
  <link rel="stylesheet" href="../css/normalize.css" />
  <link rel="stylesheet" href="../assets/fonts/fontawesome-5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.min.css" />
  <link rel="stylesheet" href="../css/comprobantes-style.css" />
  <link rel="stylesheet" href="../css/layout-tools.css" />
</head>

<body class="">
  <div class="main-wrapper">
    <header id="unisinu-header" class="unisinu-header">
      <div class="unisinu-header__title">
        <span id="menu-sw" class="unisinu-header__menu-sw"><i class="fas fa-bars"></i></span>
        <span class="hidable">Bienvenido
          <span id="user-name" class="unisinu-header__user-name"><?php echo $res['nombre'] ?></span></span>
        <span class="unisinu-header__unisinu-label">unisinu</span>
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
                <li class="unisinu-user__li update-user-emp">
                  <i class="fas fa-user"></i>
                  <a href="actualizarPerfil.php">Perfil de Usuario</a>
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
      <div id="main-flex-wrapper" class="main-flex-wrapper full-main main-emp">
        <div id="main-card" class="card-2">
          <div class="card__header">
            <h2 class="card__title">Filtrar</h2>
            <input type="hidden" name="cedula" id="cedula" value="<?php echo $res['cedula']?>">
            <select name="mes" class="login_form_input">
              <option value="">Seleccione el mes</option>
              <option value="01">Enero</option>
              <option value="02">Febrero</option>
              <option value="03">Marzo</option>
              <option value="04">Abril</option>
              <option value="05">Mayo</option>
              <option value="06">Junio</option>
              <option value="07">Julio</option>
              <option value="08">Agosto</option>
              <option value="09">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>
            </select>
            <select name="anio" id="ano" class="login_form_input">
            </select>
          </div>
          <div class="card__body body_emp" id="datos_empleado">
            

          </div>
        </div>
        <div id="side-card" class="card-2 ml-20 col-5">
          <div class="card__header">
            <h2 class="card__title">Información personal</h2>
          </div>
          <div class="card__body ">
            <form>
              <div class="input-wrapper">
                <span class="input-wrapper__icon"><i class="fas fa-user"></i></span>
                <input class="input-wrapper__input" type="text" placeholder="<?php echo $res['nombre']?>" readonly>
              </div>

              <div class="input-wrapper">
                <span class="input-wrapper__icon"><i class="fas fa-id-card"></i></span>
                <input class="input-wrapper__input" type="text" placeholder="<?php echo $res['cedula']?>" readonly>
              </div>

              <div class="input-wrapper">
                <span class="input-wrapper__icon"><i class="fas fa-envelope"></i></span>
                <input class="input-wrapper__input" type="email" placeholder="<?php echo $res['correo']?>" readonly>
              </div>

              <div class="input-wrapper">
                <span class="input-wrapper__icon"><i class="fas fa-phone"></i></span>
                <input class="input-wrapper__input" type="tel" placeholder="<?php echo $res['telefono']?>" readonly>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="sidebar" class="sidebar bg_sidebar__menu_2">
    <div class="sidebar__header sidebar__header2">
      <span class="sidebar__header__user-rol"><img src="../assets/img/logoLargo.png" alt="" clas="img-logo-l"> <i
          class="fas fa-caret-right"></i></span>
    </div>
    <div class="sidebar__menu ">
      <div class="sidebar__menu-set">
        <ul class="sidebar__menu-set-ul">
          <li class="sidebar__menu-set-li sidebar2">
            <a href="#"><i class="fas fa-home"></i>Inicio</a>
          </li>
          <li class="sidebar__menu-set-li sidebar2__menu-set-li--active sidebar2">
            <a href="#"><i class="fas fa-list-ul"></i>Consultar mi volante</a>
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
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>

</body>

</html>