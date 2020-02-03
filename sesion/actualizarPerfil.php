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
$qry2="SELECT * FROM usuarios where id_usuario ='$user'";
$sql2=mysqli_query($con,$qry2);
$res2=  mysqli_fetch_array($sql2); 
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
                <li class="unisinu-user__li">
                  <i class="fas fa-user"></i>
                  <a href="actulizarPerfil.php">Perfil de Usuario</a>
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
            <h2 class="card__title">Actualizar datos personales</h2>
            
          </div>
          <div class="card__body body_emp" >
            <form id="formActualizarEmp" >
            <input type="hidden" name="id_user" id="id_user" value="<?php echo $res[6]?>">
              <div class="row">
              <label for="" class="label_update">Indentificación:</label>
                <input class="login-form__input" type="number" name="cedula"
                value="<?php echo $res['cedula'] ?>" id="cedula" placeholder="Identificación">
                <label for="" class="label_update">Nombre:</label>
                <input id="nombre" name="nombre" class="login-form__input"
                value="<?php echo $res['nombre'] ?>" type="text" placeholder="Nombre completo"
                  onkeypress="return validar(event)">
              </div>
              <div class="row">
              <label for="" class="label_update">Cargo:</label>
                <select name="cargo" id="cargo" class="login-form__input" value="<?php echo $res['cargo'] ?>">
                  <option value="">Seleccionse su cargo</option>
                  <option value="administrativo">Administrativo</option>
                  <option value="docente">Docente</option>
                </select>
                <label for="" class="label_update">Correo:</label>
                <input class="login-form__input" type="mail" name="correo"
                value="<?php echo $res['correo'] ?>" id="correo" placeholder="Correo electrónico">
              </div>
              <div class="row">
              <label for="" class="label_update">Telefono/Celular:</label>
                <input class="login-form__input" type="text" name="telefono" id="telefono"
                  placeholder="Telefono/Celular" value="<?php echo $res['telefono'] ?>">
                  <label for="" class="label_update">Usuario:</label>
                <input class="login-form__input" type="text" name="user" id="user"
                value="<?php echo $res2['usuario'] ?>" placeholder="Usuario">
                <label for="" class="label_update">Contraseña actual:</label>
                <input class="login-form__input" type="password" name="pass" id="pass"
                 placeholder="Contraseña actual.">
                 <label for="" class="label_update">Contraseña nueva:</label>
                 <input class="login-form__input" type="password" name="passNew" id="passNew"
                 placeholder="Contraseña nueva.">
              </div>
              <input value="Actualizar" class="login-form__submit submit_two update-user-emp" type="button">
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
            <a href="empleado.php"><i class="fas fa-home"></i>Inicio</a>
          </li>
          <li class="sidebar__menu-set-li sidebar2__menu-set-li--active sidebar2">
            <a href="actulizarPerfil.php"><i class="fas fa-list-ul"></i>Perfil de Usuario</a>
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
  <script src="../js/validarUpdate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>

</body>

</html>