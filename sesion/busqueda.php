<?php 
require_once("../js/conexion.php");
$con = con();

$salida = "";
$query = "SELECT * FROM comprobantes order by id_comprobante DESC";



if(isset($_POST['consulta'])){
    $q = $con->real_escape_string($_POST['consulta']);
    $query = "SELECT * from comprobantes where
     id_comprobante like '%". $q ."%' or ruta like '%". $q ."%' or fecha like '%". $q ."%'";
}

$res = $con->query($query);
if($res->num_rows > 0){
    $salida.= "<table bordered>
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Cargo</th>
                            <th>correo</th>
                            <th>Comprobante</th>
                        </tr>
                    </thead>
                <tbody>";
    while($fila = $res->fetch_assoc()){       
        $letter= ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
            'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u',
            'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K','L', 'M', 'N', 'Ñ', 'O', 'P',
            'Q', 'R', 'S', 'T', 'U','V', 'W', 'X', 'Y', 'Z', '-', '.'];
            $result = str_replace($letter, "", $fila['ruta']);

            $query2 = "SELECT * FROM empleados where cedula = '$result'";
            $res2 = mysqli_query($con, $query2) or die(mysqli_error($con));
            $fila2 = $res2->fetch_assoc();
                $salida .= "<tr>
                <td>".$result."</td>
                <td>".$fila2['nombre']."</td>
                <td>".$fila2['telefono']."</td>
                <td>".$fila2['cargo']."</td>
                <td>".$fila2['correo']."</td>
                <td><a download href='../docs/".$fila['ruta']."'><img src='../assets/img/Imgcomprobante.png'></a></td>
            </tr>";
            
    }
    $salida .= "</tbody></table>";
                
}else{
    $salida .= "No hay datos";
}

echo $salida;
$con->close();