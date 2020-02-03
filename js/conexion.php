<?php
/*Funcion que nos permite crear la conexión a la base de datos*/
function con()
{ 
$echo = mysqli_connect("localhost","root","","comprobantes");

    return $echo;
}

?>
