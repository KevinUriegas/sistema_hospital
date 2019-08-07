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
            $('#id_receta').val(respuesta);
            llenar_listaA(respuesta);
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

function imprimir(){

    var titular = "Lista de Pacientes";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de pacientes activos";
    var link    = "pdfListaPacientes.php?";

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