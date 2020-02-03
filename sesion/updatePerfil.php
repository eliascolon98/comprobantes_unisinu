<?php
require_once '../js/conexion.php';
$con = con();
$id_user=$_POST["id_user"];
$usuario=$_POST["user"];
$pass=$_POST["pass"];
$passNew=$_POST["passNew"];
$nombre=$_POST["nombre"];
$cedula=$_POST["cedula"];
$cargo=$_POST["cargo"];
$correo=$_POST["correo"];
$telefono=$_POST["telefono"];
$encoded_pass = password_hash($pass, PASSWORD_DEFAULT);
$encoded_passNew = password_hash($passNew, PASSWORD_DEFAULT);




if($pass == "" && $passNew == ""){
    $qry = ("UPDATE usuarios set usuario='$usuario' where id_usuario = '$id_user'");
    $sql = mysqli_query($con, $qry) or die(mysqli_error($con));
    if($sql){
        $insert = "UPDATE empleados set cedula = '$cedula', nombre = '$nombre',
        cargo = '$cargo', correo = '$correo', telefono = '$telefono'
        where id_usuario = '$id_user'";
        $query = mysqli_query($con, $insert) or die(mysqli_error($con));
        if($query){
            echo 1;
        }else{
            echo 2;
        }
    }else{
        echo 3;
    }
}else if($pass != "" && $passNew != ""){
    $validar="SELECT * FROM usuarios WHERE id_usuario = '$id_user'";
    $valSql=mysqli_query($con,$validar);
    $validarPass = mysqli_fetch_row($valSql);
    if(password_verify($pass, $validarPass[2])){  
        $qry = ("UPDATE usuarios set contrasenia='$encoded_passNew'
        where id_usuario = '$id_user'");
        $sql = mysqli_query($con, $qry) or die(mysqli_error($con));
        echo 1;
    }else{
        echo 4;
    }
}else{
    echo 5;
}







