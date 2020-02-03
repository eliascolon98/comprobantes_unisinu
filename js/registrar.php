<?php
require_once 'conexion.php';
$con = con();
$usuario=$_POST["user"];
$pass=$_POST["pass"];
$nombre=$_POST["nombre"];
$cedula=$_POST["cedula"];
$cargo=$_POST["cargo"];
$correo=$_POST["correo"];
$telefono=$_POST["telefono"];
$pin = rand(1, 99999999);


$encoded_pass = password_hash($pass, PASSWORD_DEFAULT);
$sel="SELECT * FROM usuarios where usuario = '$usuario'";
$res=mysqli_query($con,$sel) or die(mysqli_error($con));

if (mysqli_num_rows($res) > 0){
    echo 3;
}else{
    $qry = "INSERT INTO usuarios (usuario, contrasenia) values ('$usuario', '$encoded_pass')";
    $sql = mysqli_query($con, $qry) or die(mysqli_error($con));

    $sel2 = "SELECT id_usuario from usuarios where usuario = '$usuario'";
    $qry2 = mysqli_query($con, $sel2) or die(mysqli_error($con));
    $res2 = mysqli_fetch_array($qry2);
    $id_user = $res2['id_usuario'];

    $insert = "INSERT into empleados (cedula, nombre, cargo, correo, telefono, id_usuario, pin) 
    values ('$cedula', '$nombre', '$cargo', '$correo', '$telefono', '$id_user', '$pin')";
    $query = mysqli_query($con, $insert) or die(mysqli_error($con));

    if(!$query){
        echo 2;
    }else{
        echo 1;
    }
}





?>