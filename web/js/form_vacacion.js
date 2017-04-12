$(function() {
    $('#vacacion-vac_fechainicio').datepicker({
        //minDate: new Date(anio_ini, mes_ini - 1, dia_ini),
        //changeMonth: true,
        //minDate:-4,
        //maxDate:+3,
        dateFormat: 'yy-mm-dd',
        onClose: function(selectedDate) {
            $('#vacacion-vac_fechafinal').datepicker('option', 'minDate', selectedDate)
        }
    });


    $('#vacacion-vac_fechafinal').datepicker({
        //maxDate: new Date(anio_fin, mes_fin - 1, dia_fin),
        //changeMonth: true,
        //maxDate:'+1M +1D',
        dateFormat: 'yy-mm-dd',
        onClose: function(selectedDate) {
            $('#vacacion-vac_fechainicio').datepicker('option', 'maxDate', selectedDate)
        }
    });
    
    $('#vacacion-vac_fechafinal').change(function() {
        //var dias = calcular_duracion($(this).val(), $('#vacacion-vac_fechainicio').val());
        //$("#vacacion-vac_dias").val(dias);
        
    });

    $('#vacacion-vac_fechainicio').change(function() {
        //var dias = calcular_duracion($('#vacacion-vac_fechafinal').val(), $(this).val());
        //$("#vacacion-vac_dias").val(dias);
    });
    $("#funcionario").autocomplete({
        source: "buscarfuncionario", //de donde jala los datos
        minLength: 2,
        select: function(event, ui) {
            $("#vacacion-fun_id").val(ui.item.id);
            //$("#usuario_saldo_diferido").val(ui.item.saldo);
            $("#Fun_Nombre").val(ui.item.label);
            //$('num_permi').focus();
            total(ui.item.id);

        }
    });

    
});

function total(Fun_Id) {
    var jsonData = $.ajax({
        type: 'POST',
        url: '/sisvac/web/vacacion/vacaciones?id=' + Fun_Id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#vac_acu').val(obj.total);

}

function calcular_duracion(fecha_fin, fecha_ini) {
    var dias = 0;
    if (fecha_fin !== '') {
        var aFecha1 = fecha_ini.split('-');
        var aFecha2 = fecha_fin.split('-');
        var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
        var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);
        var dif = fFecha2 - fFecha1;
        //alert(fFecha1);
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));

    }


    return dias;
}