function llenar_tabla(id_area){   
    $.ajax({
        url:"llenarLista.php",
        type:"POST",
        dateType:"html",
        data:{'id_area':id_area},
        success:function(respuesta){
            $("#pantalla").html(respuesta);
            $("#pantalla").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    })
}

function ver_alta(){
    // preCarga(800,4);
    $("#frmAlta")[0].reset();
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#nombre").focus();
}

function ver_lista(){
    $("#alta").slideUp('low');
    $("#lista").slideDown('low');
}

$('#btnLista').on('click',function(){
    llenar_lista();
    ver_lista();
});

$("#frmAlta").submit(function(e){
  
    var id_paciente    = $("#id_paciente").val();
    var id_consultorio = $("#id_consultorio").val();
    var fecha          = $("#fecha").val();
    var hora           = $("#hora").val();

    if(id_paciente == 0){
        alertify.error("Selecciona Paciente");
        return false;
    }
    if(id_consultorio == 0){
        alertify.error("Selecciona Consultorio");
        return false;
    }

        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'id_paciente':id_paciente,
                    'id_consultorio':id_consultorio,
                    'fecha':fecha,
                    'hora':hora
                 },
            success:function(respuesta){
                if(respuesta == "ok"){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Se ha guardado el registro' );
                    llenar_lista();
                    ver_lista();
                }else if(respuesta = "duplicado"){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('Ya cuenta con una Cita' );
                }
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(idCita,idPaciente,idConsultorio,fechaCita,horaCita){
   
    $("#frmActuliza")[0].reset();

    $("#idE").val(idCita);
    combo_pacientesE(idPaciente);
    combo_consultoriosE(idConsultorio);
    $('#fechaE').val(fechaCita);
    $('#horaE').val(horaCita);
    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#id_pacienteE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var id_consultorioE = $("#id_consultorioE").val();
    var fechaE          = $("#fechaE").val();
    var horaE           = $("#horaE").val();
    var ide             = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'id_consultorioE':id_consultorioE,
                    'fechaE':fechaE,
                    'horaE':horaE,
                    'ide':ide
                 },
            success:function(respuesta){
                if(respuesta == "ok"){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Se ha actualizado el registro' );
                    $("#frmActuliza")[0].reset();
                    $("#modalEditar").modal("hide");
                    llenar_lista();
                }else{
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Ha Ocurrido un Error' );
                }
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function status(concecutivo,id){
    var nomToggle = "#interruptor"+concecutivo;
    var nomBoton  = "#boton"+concecutivo;
    var numero    = "#tConsecutivo"+concecutivo;
    var nPaciente = "#tpaciente"+concecutivo;
    var Consultorio   = "#tConsultorio"+concecutivo;
    var Fecha  = "#tFecha"+concecutivo;
    var Hora  = "#tHora"+concecutivo;
    var nomBotonR  = "#botonR"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(nomBotonR).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(nPaciente).removeClass("desabilita");
        $(Consultorio).removeClass("desabilita");
        $(Fecha).removeClass("desabilita");
        $(Hora).removeClass("desabilita");

    }else{
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(nomBotonR).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(nPaciente).addClass("desabilita");
        $(Consultorio).addClass("desabilita");
        $(Fecha).addClass("desabilita");
        $(Hora).addClass("desabilita");
    }
    // console.log(concecutivo+' | '+id);
    $.ajax({
        url:"status.php",
        type:"POST",
        dateType:"html",
        data:{
                'valor':valor,
                'id':id
             },
        success:function(respuesta){
            // console.log(respuesta);
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}

function imprimir(){

    var titular = "Lista de Areas";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de areas activas";
    var link    = "pdfListaAreas.php?";

    alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
    alertify.confirm(
        titular, 
        mensaje, 
        function(){ 
            window.open(link,'_blank');
            }, 
        function(){ 
                alertify.error('Cancelar') ; 
                // console.log('cancelado')
              }
    ).set('labels',{ok:'Generar PDF',cancel:'Cancelar'}); 
  }