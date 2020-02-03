<?php 
require_once("../js/conexion.php");
$con = con();
$cedula = $_POST['cedula'];
$salida = "";
$query = "SELECT * FROM comprobantes order by id_comprobante DESC";

if(isset($_POST['consulta'])){
    $q = $con->real_escape_string($_POST['consulta']);
    $query = "SELECT * from comprobantes where fecha like '". $q ."%'";
}

$res = $con->query($query);
if($res->num_rows > 0){
    $salida.= "<table>
                    <thead class='emp-th'>
                        <tr>
                            <th>Identificación</th>
                            <th>Fecha</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                <tbody class='emp-td'>";
    while($fileres = $res->fetch_assoc()){
        $letter= ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
            'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u',
            'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K','L', 'M', 'N', 'Ñ', 'O', 'P',
            'Q', 'R', 'S', 'T', 'U','V', 'W', 'X', 'Y', 'Z', '-', '.'];
            $result = str_replace($letter, "", $fileres['ruta']);
            $fecha = substr($fileres['fecha'], 0, -9);
            if($result == $cedula){  
                $salida .=
                '<tr>
                    <td>'. $result .'</td>
                    <td>'. $fecha .'</td>
                    <td><a download href="../docs/'.$fileres['ruta'].'"><img src="../assets/img/Imgcomprobante.png"></a></td>
                </tr>';
            }     
        }
    $salida .= "</tbody></table>";
                
}else{
    $salida .= "Lo sentimos, no se encuentran archivos para esta fecha.";
}

echo $salida;
$con->close();