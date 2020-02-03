<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$mail = new PHPMailer(true);

require("conexion.php");
    $con=con();

    $email = $_POST['email'];
    $sel="SELECT * FROM empleados where correo = '$email'";
    $res=mysqli_query($con,$sel) or die(mysqli_error($con));
    $row = mysqli_fetch_array($res);
    
    $id_user = $row['id_usuario'];

    if (mysqli_num_rows($res) > 0){
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'Usuario';                     // SMTP username
            $mail->Password   = 'Password';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('correo de quien envia', 'Nombre');
            $mail->addAddress($email, $row[2]);     // Add a recipient
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Pin para reestablecer clave';
            $mail->Body    = '<html>
            <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>Correo de recuperación de contraseña</title>
             <link rel="stylesheet" href="http://biinyugames.com/comprobantes/css/login-styles.css" />
            </head>
            <body style="height: 100vh;
            background-color: #850c0d;
            background-image: url("http://biinyugames.com/comprobantes/assets/img/sidebar-backgroud.png");
            background-repeat: no-repeat;
            background-position: left bottom;
            background-size: cover;">
            <link rel="stylesheet" href="http://biinyugames.com/comprobantes/css/login-styles.css" />
            <div class="login-wrapper">
            <div id="login" class="login-form">
                <div id="login-form-w" class="login-form__wrapper">
                    <h3 class="login-form__title" style="color: white;
                    text-align: center;
                    font-size: 23px;
                    padding: 20px;">Correo para validar clave</h3>
                    <small class="login-form__description" style=" color: white;
                    text-align: center;
                    font-size: 17px;
                    padding-left: 10%;">
                        Por favor haga copie el pin y haga clic en el boton de abajo para reestablecer su clave.
                    </small>
                    <form method="POST" action="">
                    
                    <div class="login-form__fields">
                    <h4 style="background: white;padding: 20px;font-size: 20px;">
                    Pin para cambiar clave: '. $row['pin'].' </h4>      
                    </div>
                       <br><br>
                       <a class="login-form__submit submit_two btn-register" type="submit"
                       style="font-size: .875rem;
                       margin-left: 40%;
                       background: blanchedalmond;
                       padding: 7px 30px;
                       margin-bottom: 65px;
                       border: 0;
                       border-radius: 5px;
                       cursor: pointer;
                       text-decoration: none;
                       color: black;" href="http://biinyugames.com/comprobantes/recuperarPass.html">
                       Confirmar y cambiar clave.
                    </a>
                    <br><br><br>
                    </form>
                </div>
            </div>
        </div>
        <style>
        body {
 

          }
        
        </style>
            </body>
            </html>';
        
            $mail->send();
            
            echo 1;

        } catch (Exception $e) {
            echo 3;
        }
    }else{
        echo 2;
    }



