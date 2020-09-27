<div class="container">
<div class="form-group row">
     <input id="hdnCliente" class="form-control input-sm" readonly  type ="hidden">
     <div class="col-xs-1">
          <label for="txtCedula">Cédula :</label>
          <input id="txtCedula" class="form-control input-sm" readonly >
     </div>
     <div class ="spacer"></div>
     <div class="col-xs-4">
          <label for="txtNombre">Nombres:</label>
          <input id="txtNombre" class="form-control" readonly >
     </div>
</div>
<div class='col-sm-12 pb-3'>
    <hr>
</div>
<div class="form-group row">
          <label for="cmbGrupo">Grupo Sanguineo :</label>
          <input id="cmbGrupo" class="form-control">
          <label for="cmbJerarquia">Jerarquía :</label>
          <input id="cmbJerarquia" class="form-control">    
     </div>
</div>

<button id="btnGuardar" class='btn-primary'>Guardar</button>
</div>

<script>
$(function() { 
     $("#btnGuardar").kendoButton({
        click: onClick
     });
     $("#cmbGrupo").kendoComboBox({
        dataSource: getDataSource(C_GRUPO_SANGUINEO),
        dataTextField: "nombre",
        dataValueField: "id"
    });
    $("#cmbJerarquia").kendoComboBox({
        dataSource: getDataSource(C_JERARQUIA),
        dataTextField: "nombre",
        dataValueField: "id"
    }); 
    loadData()
})
function loadData() {
    $("#hdnCliente").val('<?php echo $cod_cliente; ?>')
    $("#txtCedula").val('<?php echo $cedula; ?>')
    $("#txtNombre").val('<?php echo $nombres; ?>')    
}
function onClick() {
     event.preventDefault();
     $('#btnGuardar').data('kendoButton').enable(false);

    $.post( "../Clientes/actualizar_datos", { 
        cod_cliente:    $("#hdnCliente").val(),
        cod_grupo:      $("#cmbGrupo").data("kendoComboBox").value(),
        cod_jerarquia:  $("#cmbJerarquia").data("kendoComboBox").value(),
    }).done(function( data ) {
        data = $.parseJSON(data);
        mensaje('Actualizacion','Actualizacion completada');
        $('#btnGuardar').data('kendoButton').enable(true);        
    });
}
</script>