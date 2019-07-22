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
  
    var nombre_especialidad = $("#nombre_especialidad").val();

        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre_especialidad':nombre_especialidad
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            llenar_lista();
            ver_lista();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(idArea,nombre_especialidad){
   
    $("#frmActuliza")[0].reset();

    $("#idE").val(idArea);
    
    $("#nombre_especialidadE").val(nombre_especialidad);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#nombre_especialidadE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var nombre_especialidadE = $("#nombre_especialidadE").val();
    var ide     = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre_especialidadE':nombre_especialidadE,
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
    var numero    = "#tConsecutivo"+concecutivo;
    var nCompleto = "#tNcompleto"+concecutivo;
    var usuario   = "#tUsuario"+concecutivo;
    var registro  = "#tRegistro"+concecutivo;
    var nomBotonR  = "#botonR"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(nomBotonR).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(nCompleto).removeClass("desabilita");
        $(usuario).removeClass("desabilita");
        $(registro).removeClass("desabilita");

    }else{
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(nomBotonR).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(nCompleto).addClass("desabilita");
        $(usuario).addClass("desabilita");
        $(registro).addClass("desabilita");

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
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de especialidades activas";
    var link    = "pdfListaEspecialidades.php?";

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