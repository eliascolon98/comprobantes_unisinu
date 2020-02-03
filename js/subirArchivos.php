<?php
$con = mysqli_connect("localhost", "root", "", "modulo_noticias");


$nombre_ar = $_FILES['arc']['name'];
$num_archivos = count($nombre_ar);

for($i = 0; $i <= $num_archivos; $i++){
    if(!empty($_FILES['arc']['name'][$i])){
        $tipo = $_FILES['arc']['type'][$i];
        $tamanio = $_FILES['arc']['size'][$i];
        $rutas = $_FILES['arc']['tmp_name'][$i];
        $nombre_archivo = str_replace(" ","-",$nombre_ar);
        $destino_arc = "files/".$nombre_archivo[$i];
        if(file_exists($destino_arc)){
            echo "El archivo" . $nombre_ar[$i] . " Ya se ecuentra <br>";
        }else{
            if($tipo == 'application/pdf'){
                copy($rutas,$destino_arc);
                $sql = "INSERT INTO hoja_devida (archivo) values ('$nombre_archivo[$i]')";
                $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                echo "El archivo" . $nombre_archivo[$i] . " se subioooo <br>";
            }else{
                echo "Solo se permiten archivos PDF";
            }
        }
    }
}




