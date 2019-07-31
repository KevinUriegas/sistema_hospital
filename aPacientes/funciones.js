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

function combo_personas(){
    $.ajax({
        url : 'combo_personas.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_persona").empty();
            $("#nombre_persona").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}
function combo_personasE(id_persona){
    $.ajax({
        url : 'combo_personasE.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#nombre_personaE").empty();
            $("#nombre_personaE").html(respuesta);
            $("#nombre_personaE").val(id_persona);
            $("#nombre_personaE").select2();         
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
  
    var nombre_persona = $("#nombre_persona").val();
    var numero_seguro  = $("#numero_seguro").val();
    var tipo_sangre    = $("#tipo_sangre").val();
    var estatura       = $("#estatura").val();
    var peso           = $("#peso").val();


        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre_persona':nombre_persona,
                    'numero_seguro':numero_seguro,
                    'tipo_sangre':tipo_sangre,
                    'estatura':estatura,
                    'peso':peso
                 },
            success:function(respuesta){
                if(respuesta == "ok"){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Se ha guardado el registro' );
                    llenar_lista();
                    ver_lista();
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