function llenarPanel() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/panel.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
        ocultarSec();
      $("#panel").html(respuesta);
      $("#panel").hide();
      $("#panel").fadeIn("slow");
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}

function ocultarSec(){
    $("#panel").hide();
    $("#misDatos").hide();
    $("#miFoto").hide();
    $("#miPass").hide();
}

function QuitarClass(){
  $("#linkMisDatos").removeClass("activo");
  $("#linkPanel").removeClass("activo");
  $("#linkMifoto").removeClass("activo");
  $("#linkCambiarPass").removeClass("activo");
}

$("#linkMisDatos").on("click", function() {
  llenarMisDatos();
  QuitarClass();
  $("#linkMisDatos").addClass("activo");
});
function mllenardatos(){
  llenarMisDatos();
  QuitarClass();
  $("#linkMisDatos").addClass("activo");
}

$("#linkPanel").on("click", function() {
  llenarPanel();
  QuitarClass();
  $("#linkPanel").addClass("activo");
});

$("#linkMifoto").on("click", function() {
  llenarFoto();
  QuitarClass();
  $("#linkMifoto").addClass("activo");
});
$("#linkCambiarPass").on("click", function() {
  llenarPass();
  QuitarClass();
  $("#linkCambiarPass").addClass("activo");
});