function llenar_lista(){
     // console.log("Se ha llenado lista");
    // preCarga(1000,4);
    $.ajax({
        url:"llenarLista.php",
        type:"POST",
        dateType:"html",
        data:{},
        success:function(respuesta){
            $("#lista").html(respuesta);
            $("#lista").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    });	
}
function llenar_listaD(id_paciente){
     // console.log("Se ha llenado lista");
    // preCarga(1000,4);
    $.ajax({
        url:"llenarLista2.php",
        type:"POST",
        dateType:"html",
        data:{'id_paciente':id_paciente},
        success:function(respuesta){
            $("#lista2").html(respuesta);
            $("#lista2").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    }); 
}
function llenar_listaA(id_receta){
     // console.log("Se ha llenado lista");
    // preCarga(1000,4);
    $.ajax({
        url:"llenarListaA.php",
        type:"POST",
        dateType:"html",
        data:{'id_receta':id_receta},
        success:function(respuesta){
            $("#lista").html(respuesta);
            $("#lista").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    }); 
}
function eliminar(id_detalle){
    var id_receta = $('#id_receta').val();
    $.ajax({
        url:"eliminar_detalle.php",
        type:"POST",
        dateType:"html",
        data:{'id_detalle':id_detalle},
        success:function(respuesta){
            llenar_listaA(id_receta);
            alertify.error("Se ha Eliminado Correctamente");
        },    
        error:function(xhr,status){
            alert("no se muestra");
        }
    }); 
}

function combo_medicamentos(){
    $.ajax({
        url : 'combo_medicamentos.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#id_medicamento").empty();
            $("#id_medicamento").html(respuesta);
            $("#id_medicamento").select2();         
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function ver_alta(){
    // preCarga(800,4);
    $("#frmAlta")[0].reset();
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
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
    var id_cita        = $("#id_cita").val();
    var cantidad       = $("#cantidad").val();
    var comentario     = $("#comentario").val();
    var id_medicamento = $("#id_medicamento").val();
    var id_receta     = $("#id_receta").val();

    $.ajax({
        url:"guardar.php",
        type:"POST",
        dateType:"html",
        data:{
                'id_cita':id_cita,
                'cantidad':cantidad,
                'comentario':comentario,
                'id_medicamento':id_medicamento,
                'id_receta':id_receta
             },
        success:function(respuesta){
            if(respuesta == "ok"){
                alertify.set('notifier','position', 'bottom-right');
                alertify.success('Se ha guardado el registro' );
                $('#cantidad').val("");
                $('#comentario').val("");
                combo_medicamentos();

                llenar_listaA(id_receta);
                // ver_lista();
            }else{
                alertify.set('notifier','position', 'bottom-right');
                alertify.error('Registro Duplicado' );
            }
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
    e.preventDefault();
    return false;
}); 

function consultar(id_cita,id_paciente){
    ver_alta();
    combo_medicamentos();
    $("#id_cita").val(id_cita);
    $.ajax({
        url:"guardar_consulta.php",
        type:"POST",
        dateType:"html",
        data:{'id_cita':id_cita,'id_paciente':id_paciente},
        success:function(respuesta){
            var array = eval(respuesta);
            $('#nombre_paciente').val(array[0]);
            $('#id_receta').val(array[1]);
            $('#no_seguro').val(array[2]);
            $('#id_paciente').val(id_paciente);
            llenar_listaA(array[1]);
            $('#imagen_paciente').attr('src','../images_p/'+id_paciente+'.jpg');
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}
function terminar_consulta(){
    var id_cita = $('#id_cita').val();
    $.ajax({
        url:"terminar_consulta.php",
        type:"POST",
        dateType:"html",
        data:{'id_cita':id_cita},
        success:function(respuesta){
            alertify.success("Consulta Terminada");
            llenar_lista();
            ver_lista();
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}

function abrirModalEditar(idPaciente,idPersona,numero_seguro,tipo_sangre,estatura,peso){
   
    $("#frmActuliza")[0].reset();

    $("#idE").val(idPaciente);
    $('#tipo_sangreE').val(tipo_sangre).trigger('change.select2');
    $("#numero_seguroE").val(numero_seguro);
    $("#estaturaE").val(estatura);
    $("#pesoE").val(peso);
    
    combo_personasE(idPersona);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#nombre_especialidadE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var numero_seguro  = $("#numero_seguroE").val();
    var tipo_sangre    = $("#tipo_sangreE").val();
    var estatura       = $("#estaturaE").val();
    var peso           = $("#pesoE").val();
    var ide            = $("#idE").val();

    $.ajax({
        url:"actualizar.php",
        type:"POST",
        dateType:"html",
        data:{
                'numero_seguro':numero_seguro,
                'tipo_sangre':tipo_sangre,
                'estatura':estatura,
                'peso':peso,
                'ide':ide
                },
        success:function(respuesta){

        alertify.set('notifier','position', 'bottom-right');
        alertify.success('Se ha actualizado el registro' );
        $("#frmActuliza")[0].reset();
        $("#modalEditar").modal("hide");
        llenar_lista();
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
    var nomBotonA  = "#botonA"+concecutivo;
    var numero    = "#tConsecutivo"+concecutivo;
    var nCompleto = "#tNcompleto"+concecutivo;
    var seguro   = "#tseguro"+concecutivo;
    var sangre  = "#tsangre"+concecutivo;
    var estatura  = "#testatura"+concecutivo;
    var peso  = "#tpeso"+concecutivo;
    
    var nomBotonR  = "#botonR"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(nomBotonA).removeAttr("disabled");
        $(nomBotonR).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(nCompleto).removeClass("desabilita");
        $(seguro).removeClass("desabilita");
        $(estatura).removeClass("desabilita");
        $(peso).removeClass("desabilita");
    }else{
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(nomBotonA).attr("disabled", "disabled");
        $(nomBotonR).attr("disabled", "disabled");
        $(nCompleto).addClass("desabilita");
        $(seguro).addClass("desabilita");
        $(sangre).addClass("desabilita");
        $(estatura).addClass("desabilita");
        $(peso).addClass("desabilita");
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

function mensaje(){

    var titular = "Consulta de Pacientes";
    var mensaje = "¿Deseas reagendar al paciente";

    alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
    alertify.confirm(
        titular, 
        mensaje, 
        function(){ 
                reagendar();
            }, 
        function(){ 
                terminar_consulta();
              }
    ).set('labels',{ok:'Si',cancel:'No'}); 
}

function mas_datos(){
    var id_paciente = $('#id_paciente').val();
     $.ajax({
        url:"datos_paciente.php",
        type:"POST",
        dateType:"html",
        data:{'id_paciente':id_paciente},
        success:function(respuesta){
            var array = eval(respuesta);
            $('#tipo_sangre').val(array[0]);
            $('#estatura').val(array[1]);
            $('#peso').val(array[2]);
            llenar_listaD(id_paciente);
            $('#id_paciente_modal').val(id_paciente);
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
    $("#modalDatosPaciente").modal("show");
}
function reagendar(){
    $('#modalReAgenda').modal("show");
    var nombre = $('#nombre_paciente').val();
    $('#paciente_modal').val(nombre);

}
$("#frmReAgenda").submit(function(e){
    var id_paciente = $('#id_paciente').val();
    var fecha       = $('#fecha_cita').val();
    var hora        = $('#hora_cita').val();

    $.ajax({
        url:"reagenda.php",
        type:"POST",
        dateType:"html",
        data:{
            'fecha'      : fecha,
            'hora'       : hora,
            'id_paciente': id_paciente
        },
        success:function(respuesta){
            if(respuesta == "ok"){
                alertify.set('notifier','position', 'bottom-right');
                alertify.success('Paciente Reagendado Correctamente' );
                llenar_lista();
                terminar_consulta();
                $("#modalReAgenda").modal("hide");
            }else if(respuesta = "duplicado"){
                alertify.set('notifier','position', 'bottom-right');
                alertify.error('Ya existe una cita agendada');
            }
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
    e.preventDefault();
    return false;
});
function llenar_lista3(fecha_cita){
   $.ajax({
       url:"llenarLista3.php",
       type:"POST",
       dateType:"html",
       data:{'fecha_cita':fecha_cita},
       success:function(respuesta){
           $("#lista3").html(respuesta);
           $("#lista3").slideDown("fast");
       },
       error:function(xhr,status){
           alert("no se muestra");
       }
   });  
}