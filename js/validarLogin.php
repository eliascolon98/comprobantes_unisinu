<?php

require("conexion.php");

$con=con();

$user= filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
$pass= filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

$qry="SELECT * FROM usuarios WHERE usuario ='$user'";
$sql=mysqli_query($con,$qry);
$row = mysqli_fetch_row($sql);

$qry2="SELECT * FROM empleados WHERE id_usuario ='$row[0]'";
$sql2=mysqli_query($con,$qry2);
$row2 = mysqli_fetch_row($sql2);

if (mysqli_num_rows($sql) > 0) {   
    // output data of each row
    if(password_verify($pass, $row[2])){
       session_start(); 

      if ($row2[3] == "admin") {
            //Guardamos dos variables de sesión que nos auxiliará 
            //para saber si se está o no "logueado" un usuario 
            $_SESSION["autentica"] = "SIP"; 
            $_SESSION["usuarioactual"] =  $row[0]; 
            header("Location: ../sesion/index.php");
        } else {
            //Guardamos dos variables de sesión que nos auxiliará 
            //para saber si se está o no "logueado" un usuario 
            $_SESSION["autentica"] = "SIP"; 
            $_SESSION["usuarioactual"] =  $row[0]; 
            header("Location: ../sesion/empleado.php");
        }
      //nombre del usuario logueado. 
      //Direccionamos a nuestra página principal del sistema. 
    }else{
      
      header ("Location: ../index.html#false");
      
    }

} else {  
   
 header ("Location: ../index.html#NotFound");
  
}
?>