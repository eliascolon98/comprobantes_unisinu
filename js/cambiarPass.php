<?php
require("conexion.php");
$con=con();
/*Recuperamos los datos enviados por el metodo POST*/
$pin = $_POST['pin'];
$pass =$_POST['pass'];
$confirmarPass = $_POST['confirmarPass'];

/*Hacemos una consulta que nos permite seleccionar el usuario especifico
que envió la información para cambiar su contraseña, esto los validamos 
con un PIN que se envía a su correo*/
$sel="SELECT * FROM empleados where pin = '$pin'";
$res=mysqli_query($con,$sel) or die(mysqli_error($con));
$row = mysqli_fetch_array($res);
$id = $row['id_usuario'];


/*Aquí validamos que si el PIN es mayor a 0 este no existe, es decir que si  el
usuario ya usó o no tiene un PIN enviaremos un numero especifico que a la
hora de enviar el formulario un AJAX tomará ese numero y mostrará un alerta
especificando que tipo de error ocurrió o si todo salió bien*/
if (mysqli_num_rows($res) > 0){
    if($pass == $confirmarPass){
        /*Con esta línea de código encriptamos la contraseña por el metodo HASH*/
        $encoded_pass = password_hash($confirmarPass, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios set contrasenia = '$encoded_pass' where id_usuario = '$id'";
        $qry = mysqli_query($con, $sql) or die (mysqli_error($con));
        if($qry){
            /*Si todo sale bien y el usuario reestablece su contraseña
            el pin se eliminará automaticamente*/
            $del = "UPDATE empleados set pin = '' where id_usuario = '$id'";
            $qryDel = mysqli_query($con, $del) or die (mysqli_error($con));
            echo 1;
        }else{
            echo "error";
        }
    }else{
        echo 2;
    }
}else{
    echo 3;
}
