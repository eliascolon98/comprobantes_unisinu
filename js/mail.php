<?php
    require("conexion.php");
    $con=con();

    $email = $_POST['email'];
    $sel="SELECT * FROM empleados where correo = '$email'";
    $res=mysqli_query($con,$sel) or die(mysqli_error($con));
    $row = mysqli_fetch_array($res);
    
    $id_user = $row['id_usuario'];

    if (mysqli_num_rows($res) > 0){
        if (isset($_POST['email'])) {
            $email_from = 'e.colon@biinyu.com.co';
            $email_to = $email;
            $message = '<html>
            <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>Correo de recuperación de contraseña</title>
             <link rel="stylesheet" href="../css/login-styles.css" />
            </head>
            <body>
            <div class="login-wrapper">
            <div id="login" class="login-form">
                <div id="login-form-w" class="login-form__wrapper">
                    <h3 class="login-form__title">Correo de verificación</h3>
                    <small class="login-form__description">
                        Por favor verifique que estos datos sean los de usted sino son reenvienos este correo con su información.
                    </small>
                    <form method="POST" action="../recuperarpass.php">
                    <input type="hidden" value="'. $row['pin'].'" name="pin">
                    <div class="login-form__fields">
                    <input class="login-form__input" type="hidden" placeholder="'. $row['correo'].'" readonl name="correo">
                    <label class="login-form__label" for="">Nombre</label>
                    <span class="login-form__input--password-eye-mask"><input id="user-pass" name="pass"
                    class="login-form__input" type="password" placeholder="'. $row['nombre'].'" readonly>
                    <span id="eye-password-sw" class="login-form__input--password-eye"><i id="pass-eye-icon"
                    class="fas fa-eye"></i></span></span>   
                    <label class="login-form__label" for="">Cargo</label>
                    <input class="login-form__input" type="text" name="cargo"
                        placeholder="'. $row['cargo'].'" readonly>
                        <label class="login-form__label" for="">Teléfono/Celular</label>
                    <input class="login-form__input" type="text" name="telefono"
                        placeholder="'. $row['telefono'].'" readonly>                
                    </div>
                       <br><br>
                       <button class="login-form__submit submit_two btn-register" type="submit">
                       Cambiar contraseña
                    </button>
                    </form>
                </div>
            </div>
        </div>
            </body>
            </html>';
             
             // create email headers
          $headers = 'MIME-Version: 1.0' . "\r\n";
             $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n".
                         'Reply-To:'. $email_from . "\r\n" .
                         'From:' . $email_from . "\r\n" .
                         'X-Mailer: PHP/' . phpversion();
             $email = @mail($email_to, "FABCOM", wordwrap($message), $headers);
             if ($email) {
                 echo   1;
             
             } else {
                $pinRand = rand(0, 99999999);
                $sql="UPDATE empleados set pin = '$pinRand' where correo = '$row[4]'";
                $res=mysqli_query($con,$sql) or die(mysqli_error($con));
                echo 3;
             }
         } else {
             echo 4;
         }
    }else{
        echo 2;
    }


?>