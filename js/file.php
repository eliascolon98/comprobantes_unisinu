<?php
require("conexion.php");
$con=con();
/*Este código nos permite subir multiples archivos
creando un JSON el cual el damos una ruta y recuperamos
su nombre y tamaño para luego agregarlo a la BD*/
$ds = DIRECTORY_SEPARATOR;
$storeFolder = '../docs';

if (!file_exists($storeFolder)) {
    mkdir($storeFolder, 0777, true);
}
 /*Validamos si el archivo no está vacío*/
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                  
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name'];  
    $upload_success = move_uploaded_file($tempFile,$targetFile); 

    $nombre = $_FILES['file']['name'];
    $sel="SELECT ruta FROM comprobantes where ruta ='$nombre'";
    $res=mysqli_query($con,$sel);
    $resultS = mysqli_fetch_array($res);

    /*Validamos si el archivo ya existe nos mandará un mensaje
    sino lo guardará en la BD*/
    if (count($resultS) > 0){
        echo "ya existe";
    }else{
        $sql = "INSERT into comprobantes (ruta) values ('$nombre')";
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));
    }

    /*Creamos un arreglo que nos permite recorrer cada uno de los 
    archivos subidos y mostrar su información en la ventana*/
    $success_message = array( 
        'name' => $_FILES['file']['name'],
        'filesize' => $_FILES['file']['size']
    );

    if( $upload_success ) {
        return json_encode($success_message);
    } else {
        return Response::json('error', 400);
    }
     
} else {
      /*Validamos si tiene un archivo, buscamos en nuetra carpeta
      si existe no se vuelve  subir en el servir y sino se cargará*/                                                        
    $result  = array();
    $files = scandir($storeFolder);                 
    if ( false!==$files ) {
        foreach ( $files as $file ) {        
            if ( '.'!=$file && '..' !=$file && strpos($file, '.') !== false) {       
                $obj['name'] = $file;
                $obj['size'] = filesize($storeFolder.$ds.$file);
                $result[] = $obj;
                
            }
        }
    }
     
    header('Content-type: text/json');             
    header('Content-type: application/json');
    echo json_encode($result);
}
?>     