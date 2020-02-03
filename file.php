<?php
$con = mysqli_connect("localhost", "root", "", "comprobantes");
$ds = DIRECTORY_SEPARATOR;

$storeFolder = 'docs';

if (!file_exists($storeFolder)) {
    mkdir($storeFolder, 0777, true);
}
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];                  
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;    
    $targetFile =  $targetPath. $_FILES['file']['name'];  
    $upload_success = move_uploaded_file($tempFile,$targetFile); 

    $nombre = $_FILES['file']['name'];
    $sel="SELECT ruta FROM comprobantes where ruta ='$nombre'";
    $res=mysqli_query($con,$sel);
    $resultS = mysqli_fetch_array($res);
    
    if (count($resultS) > 0){
        echo "ya existe";
    }else{
        $sql = "INSERT into comprobantes (ruta) values ('$nombre')";
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));
    }

    
    // $file= "SELECT * FROM comprobantes";
    // $fileqry = mysqli_query($con, $file) or die (mysqli_error($con));
    // $fileres = mysqli_fetch_array($fileqry);

    // $file_list = json_decode($fileres['ruta'], true);
    // $new_file_list = array("name"=>$_FILES['file']['name']);

    // array_push($file_list, $new_file_list);
    // $encode_file = json_encode($file_list);

    // $sql = "UPDATE comprobantes set ruta = '$encode_file'";
    // $query = mysqli_query($con, $sql) or die(mysqli_error($con));

    /* TEST */


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