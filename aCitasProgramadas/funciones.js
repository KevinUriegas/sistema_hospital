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
function llenar_lista2(fecha_cita){
   $.ajax({
       url:"llenarLista2.php",
       type:"POST",
       dateType:"html",
       data:{'fecha_cita':fecha_cita},
       success:function(respuesta){
           $("#lista2").html(respuesta);
           $("#lista2").slideDown("fast");
       },
       error:function(xhr,status){
           alert("no se muestra");
       }
   });	
}
llenar_lista();

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

function status(id){
    var valor = 2;
    $.ajax({
        url:"status.php",
        type:"POST",
        dateType:"html",
        data:{
            'valor':valor,
            'id':id
         },
        success:function(respuesta){
            var array = eval(respuesta);
            if(array[0] == "ok"){
                llenar_lista();
                alertify.success("Registro de Entrada de Paciente");
            }else if(array[0] == "late"){
                //abrir modal
                llenar_lista();
                alertify.error("Ha perdido su cita");
                $('#modalReAgenda').modal("show");
                $('#paciente_modal').val(array[1]);
                $('#id_paciente_modal').val(array[2]);
            }
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}
$("#frmReAgenda").submit(function(e){
    var fecha       = $('#fecha_cita').val();
    var hora        = $('#hora_cita').val();
    var id_paciente = $('#id_paciente_modal').val();
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
})