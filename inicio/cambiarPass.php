<br>
<form id="frmContra">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
            <div class="form-group">
                <label for="pass">Contraseña Nueva:</label>
                <input onkeyup="verificar_pass()" type="password" id="pass" class="form-control " autofocus="" required="" placeholder="Escribe la contraseña">
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-6">
            <div class="form-group">
                <label for="pass1">Confirma Contraseña:</label>
                <input onkeyup="verificar_pass()" type="password" id="pass1" class="form-control " required="" placeholder="Confirma la contraseña">
            </div>
        </div>
        <hr class="linea">
    </div>
    <div class="row">
        <div class="col-lg-12">
            <input type="button" class="btn btn-login  btn-flat  pull-right" id="btn_actualizar_pass" value="Actulizar Contraseña" onclick="actualizar_pass()" disabled="disabled">                                        
        </div>
    </div>
</form>