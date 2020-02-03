function validacion() {
    if ($('#cedula').val() == '') {
        alert("Por favor ingrese su Cedula");
        return false;
    } else if ($('#nombre').val() == '') {
        alert("Por favor ingrese su Nombre");
        return false;
    }  else if ($('#cargo').val() == '') {
        alert("Por favor ingrese su Cargo");
        return false;
    }else if ($('#correo').val() == '') {
        alert("Por favor ingrese su Correo electrónico");
        return false;
    } else if ($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1) {
        alert("email invalido");
        return false;
    } else if ($('#telefono').val() == '') {
        alert("Por favor ingrese su Télefono o celular");
        return false;
    } else if ($('#user').val() == '') {
        alert("Por favor ingrese su Usuario");
        return false;
    }else if ($('#pass').val() != '' && $('#passNew').val() == '') {
        alert("Por favor escriba la contraseña nueva");
        return false;
    } else if ($('#pass').val() == '' && $('#passNew').val() != '') {
        alert("Para poder actualizar la contraseña debe escribir la anterior.");
        return false;
    }else {
        return true;
    }
}

//Validar solo letras
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla == 8) return true; // 3
    patron = /[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
//validar solo numeros
window.addEventListener("load", function () {
    cedula = document.getElementById("cedula");
    telefono = document.getElementById("telefono");
    cedula.addEventListener("keypress", soloNumeros, false);
    telefono.addEventListener("keypress", soloNumeros, false);
});

//Solo permite introducir numeros.
function soloNumeros(e) {
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        e.preventDefault();
    }
}


$('.update-user-emp').click(function () {
    if(validacion() == true){
        var datos = $('#formActualizarEmp').serialize();
        $.ajax({
            url: "updatePerfil.php",
            type: "POST",
            data: datos,
            dataType: "html",
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    alert("Usuario actualizado éxitosamente");
                    reload();
                } else if (data == 2){
                    alert("Hubo un problema al actualizar en la tabla empleados");
                    reload();
                } else if (data == 3){
                    alert("Hubo un problema al actualizar en la tabla Usuarios");
                    reload();
                }else if (data == 4){
                    alert("La contraseña que ingresó no coincide con su antigua");
                    reload();
                }else {
                    alert("Lo sentimos los datos no se pudieron actualizar.");
                    reload();
                }
                function reload() {
                    location.reload();
                }
            }
        });
    }
    return false;
  });

$(".unisinu-header__options-ul").click(function () {
    $("#unisinu-user").toggleClass("hide");
})