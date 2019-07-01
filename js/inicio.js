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

function llenarMisDatos() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/misDatos.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
        ocultarSec();
      $("#misDatos").html(respuesta);
      $("#misDatos").hide();
      $("#misDatos").fadeIn("slow");
      consulta_datos();
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}

function consulta_datos(){
  $.ajax({
    url: "../inicio/datos_persona.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
        var array = eval(respuesta);
        $('#nombre').val(array[0]);
        $('#paterno').val(array[1]);
        $('#materno').val(array[2]);
        $('#direccion').val(array[3]);
        $('#sexo').val(array[4]).change();
        $('#telefono').val(array[5]);
        $('#fecha_nac').val(array[6]);
        $('#correo').val(array[7]);
        $('#tipo').val(array[8]).change();
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}

function llenarFoto() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/miFoto.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
      ocultarSec();
      $("#miFoto").html(respuesta);
      $("#miFoto").hide();
      $("#miFoto").fadeIn("slow");
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}
function llenarPass() {
  // console.log("Se debe de llenar las etiquetas");
  $.ajax({
    url: "../inicio/cambiarPass.php",
    data: {},
    type: "POST",
    dataType: "html",
    success: function(respuesta) {
      ocultarSec();
      $("#miPass").html(respuesta);
      $("#miPass").hide();
      $("#miPass").fadeIn("slow");
    },
    error: function(xhr, status) {
      alert("no se muestra");
    }
  });
}
function verificar_pass(){
  var pass1 = $('#pass').val();
  var pass2 = $('#pass1').val();

  if(pass1.trim() != "" && pass2.trim() !=""){
    if(pass1 == pass2){
      $('#btn_actualizar_pass').removeAttr('disabled');
    }else{
      $('#btn_actualizar_pass').attr('disabled', 'disabled');
    }
  }else{
    $('#btn_actualizar_pass').attr('disabled', 'disabled');
  }
}
function actualizar_pass(){
  var pass   = $("#pass").val();
  $.ajax({
    url:"../sesiones/actualizar_pass.php",
    type:"POST",
    dateType:"html",
    data:{
      'pass':pass
    },
    success:function(respuesta){
    if (respuesta == "ok"){
      alertify.set('notifier','position', 'bottom-right');
      alertify.success('Se ha actualizado la contraseña' );
      $("#frmContra")[0].reset();
      $("#modalContra").modal("hide");
    }else{
      alertify.set('notifier','position', 'bottom-right');
      alertify.error('La contraseña es igual a la Anterior' );
    }
    },
    error:function(xhr,status){
      alert(xhr);
    },
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
function actualizar_datos(){
  $.ajax({
    url:"../inicio/actualizar_datos.php",
    type:"POST",
    dateType:"html",
    data:$('#frmAlta').serialize(),
    success:function(respuesta){
      if (respuesta == "ok"){
        alertify.set('notifier','position', 'bottom-right');
        alertify.success('Se ha actualizado el registro' );
        llenarMisDatos();
      }else{
        alertify.set('notifier','position', 'bottom-right');
        alertify.error('Ha Ocurrido un Error' );
     }
    },
    error:function(xhr,status){
      alert(xhr);
    },
  });
}
function subir_imagen(){
  var formData = new FormData();
  var files    = $('#image')[0].files[0];

  formData.append('file',files);

  $.ajax({
    url: 'upload.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      if (response != 0) {     
        d = new Date();
        $("#imagen_persona").removeAttr("src").attr("src", response);
        $('#frmImagen')[0].reset();
        alertify.success('La imagen ha sido cargada con exito.');
      } else {
        alertify.error('Formato de imagen incorrecto.');
      }
    },
    error:function(xhr,status){
      alertify.error('Error en proceso');
    },
  });
  return false;
}