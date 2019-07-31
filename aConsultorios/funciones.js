function verificar_pass(){
  var pass1 = $('#contra').val();
  var pass2 = $('#vContra').val();

  if(pass1.trim() != "" && pass2.trim() !=""){
    if(pass1 == pass2){
      $('#guardar').removeAttr('disabled');
    }else{
      $('#guardar').attr('disabled', 'disabled');
    }
  }else{
    $('#guardar').attr('disabled', 'disabled');
  }
}
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
  
    var idArea = $("#idArea").val();
    var nombre   = $("#nombre").val();
    var contra    = $("#contra").val();
    var vContra   = $("#vContra").val();

    // validacion para no meter id de persona en 0
    if(idArea==0){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Información',
            'label':'Salir',
            'message': 'Debes seleccionar el dato de una Area.' ,
            'onok': function(){ alertify.message('Gracias !');}
        }).show();
        return false;       
    }
        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'idArea':idArea,
                    'nombre':nombre
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

function abrirModalEditar(idUsuario,idArea,nombre){
   
    $("#frmActuliza")[0].reset();

    llenar_personaU(idArea);

    $("#idE").val(idUsuario);
    
    $("#nombreE").val(nombre);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#nombreE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var nombre = $("#nombreE").val();
    var ide     = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre':nombre,
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
    var nombre = "#tNombre"+concecutivo;
    var area   = "#tArea"+concecutivo;
    var nomBotonR  = "#botonR"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        // console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(nomBotonR).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(nombre).removeClass("desabilita");
        $(area).removeClass("desabilita");

    }else{
        // console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(nomBotonR).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(nombre).addClass("desabilita");
        $(area).addClass("desabilita");

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


function llenar_persona()
{
    // alert(idRepre);
    $.ajax({
        url : 'comboPersonas.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#idArea").empty();
            $("#idArea").html(respuesta);      
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}


function llenar_personaU(idArea)
{
    // alert(idRepre);
    $.ajax({
        url : 'comboPersonasU.php',
        // data : {'id':id},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#areaE").empty();
            $("#areaE").html(respuesta);
            $("#areaE").val(idArea);
            $("#areaE").select2();       
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function imprimir(){

    var titular = "Lista de Usuarios";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de usuarios activos";
    var link    = "pdfListaUsuarios.php?";

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