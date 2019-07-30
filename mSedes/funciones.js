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
  
    var nombre    = $("#nombre").val();
    var direccion = $("#direccion").val();
    var telefono  = $("#telefono").val();

    //Verifica si la cadena correo contiene un @ y .com
    
        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                'nombre':nombre,
                'direccion':direccion,
                'telefono':telefono
            },
            success:function(respuesta){
                if(respuesta == "ok"){
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Se ha guardado el registro' );
                    $("#frmAlta")[0].reset();
                    $("#nombre").focus();
                    llenar_lista();
                    ver_lista();
                }else if (respuesta == "duplicado"){
                    $("#nombre").focus();
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('Registro Duplicado');
                }else{
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('Ha Ocurrido un Error');
                }
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;

        
});

function abrirModalEditar(nombre,direccion,telefono,ide){
   
    $("#frmActuliza")[0].reset();
    $("#nombreE").val(nombre);
    $("#direccionE").val(direccion);
    $("#telefonoE").val(telefono);
    $("#idE").val(ide);

    $(".select2").select2();

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#nombreE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var nombre    = $("#nombreE").val();
    var direccion = $("#direccionE").val();
    var telefono  = $("#telefonoE").val();
    var ide       = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre':nombre,
                    'direccion':direccion,
                    'telefono':telefono,
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
    var sede   = "#tSede"+concecutivo;
    var direccion = "#tDireccion"+concecutivo;
    var telefono  = "#tTelefono"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(sede).removeClass("desabilita");
        $(direccion).removeClass("desabilita");
        $(telefono).removeClass("desabilita");
    }else{
        console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(sede).addClass("desabilita");
        $(direccion).addClass("desabilita");
        $(telefono).addClass("desabilita");
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

    var titular = "Lista de sedes";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de sedes activas";
    // var link    = "pdfListaPersona.php?id="+idPersona+"&datos="+datos;
    var link    = "pdfListaSedes.php?";

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