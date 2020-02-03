$(document).ready(function () {
  $(buscar_datos());
  function buscar_datos(consulta) {
    $.ajax({
      url: "busqueda.php",
      type: "POST",
      data: { consulta: consulta },
      dataType: "html",
    })
      .done(function (resultado) {
        $("#tabla-adm").html(resultado);
      })
      .fail(function () {
        console.log("Error");
      })
  }

  $("#caja_busqueda").keyup(function (event) {
    buscar();
  });

  function buscar() {
    var valorBusqueda = $("#caja_busqueda").val();
    if (valorBusqueda != "") {
      buscar_datos(valorBusqueda);
    } else {
      buscar_datos();
    }
  }

})

$(document).ready(function () {
  $(buscar_por_fecha());
  function buscar_por_fecha(cedula) {
    var cedula = $("#cedula").val();
    $.ajax({
      url: "busquedaUser.php",
      type: "POST",
      data: { cedula: cedula },
      dataType: "html",
    })
      .done(function (resultado) {
        $("#datos_empleado").html(resultado);
      })
  }

  $("select[name=mes]").change(function () {
    var cedula = $("#cedula").val();
    var ano = $("select[name=anio]").val();
    var mes = $("select[name=mes]").val();
    var fecha = ano + "-" + mes;

    $.ajax({
      url: "busquedaUser.php",
      type: "POST",
      data: { consulta: fecha, cedula: cedula },
      dataType: "html",
    })
      .done(function (resultado) {
        $("#datos_empleado").html(resultado);
      })
  })
  $("select[name=anio]").change(function () {
    var cedula = $("#cedula").val();
    var ano = $("select[name=anio]").val();
    var mes = $("select[name=mes]").val();
    var fecha = ano + "-" + mes;

    $.ajax({
      url: "busquedaUser.php",
      type: "POST",
      data: { consulta: fecha, cedula: cedula },
      dataType: "html",
    })
      .done(function (resultado) {
        $("#datos_empleado").html(resultado);
      })
  })

});

$(".unisinu-header__options-ul").click(function () {
  $("#unisinu-user").toggleClass("hide");
})
$(".sign-out").click(function () {
  location.href = "../salir.php";
});

$(document).ready(function () {
  ComboAno();
})


function ComboAno() {
  var d = new Date();
  var n = d.getFullYear();
  var select = document.getElementById("ano");
  for (var i = n; i >= 1900; i--) {
    var opc = document.createElement("option");
    opc.text = i;
    opc.value = i;
    select.add(opc)
  }
}

function reload() {
  location.href = "../index.html";
}

$(".update-user-emp").click(function(){
  location.href="actualizarPerfil.php";
})