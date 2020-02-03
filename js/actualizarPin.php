<?php
require("conexion.php");
$con=con();
/*Recuperamos los dato enviados*/
$res = $_POST['request'];
$email = $_POST['email'];

/*Validamos que si el dato enviado es SEND el PIN del
usuario que ingresó su correo se le actualizará*/
if($res == "send"){
    echo $pinRand = rand(0, 99999999);
    $sql="UPDATE empleados set pin = '$pinRand' where correo = '$email'";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
}





