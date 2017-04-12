/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $('#permisos-per_fechainicio').datepicker({
        //minDate: new Date(anio_ini, mes_ini - 1, dia_ini),
        changeYear: true,
        //minDate:-4,
        //maxDate:+3,
        dateFormat: 'yy-mm-dd',
        onClose: function(selectedDate) {
            $('#permisos-per_fechafinal').datepicker('option', 'minDate', selectedDate)
        }
    });


    $('#permisos-per_fechafinal').datepicker({
        //maxDate: new Date(anio_fin, mes_fin - 1, dia_fin),
        changeYear: true,
        //maxDate:'+1M +1D',
        dateFormat: 'yy-mm-dd',
        onClose: function(selectedDate) {
            $('#permisos-per_fechainicio').datepicker('option', 'maxDate', selectedDate)
        }
    });
    
    $('#permisos-per_fechafinal').change(function() {
        //var dias = calcular_duracion($(this).val(), $('#permisos-per_fechainicio').val());
        //$("#permisos-per_dias").val(dias);
        //$('#permisos-per_dias').focus();
        
    });

    $('#permisos-per_fechainicio').change(function() {
        //la linea de abajo var dias.... llama a la funcion que calcula los días, como le comente ya no le llama
        //var dias = calcular_duracion($('#permisos-per_fechafinal').val(), $(this).val());
        //$("#permisos-per_dias").val(dias);
        //$('#permisos-per_dias').focus();
    });
    
    $('#permisos-per_dias').change(function() {
        var total = sumar_valores($('#permisos-per_dias').val(),$('#permisos-per_horas').val(),$('#permisos-per_minutos').val())
        $('#permisos-per_total').val(total);
    });
    
    $('#permisos-per_horas').change(function() {
        var total = sumar_valores($('#permisos-per_dias').val(),$('#permisos-per_horas').val(),$('#permisos-per_minutos').val())
        $('#permisos-per_total').val(total);
    });
    $('#permisos-per_minutos').change(function() {
        var total = sumar_valores($('#permisos-per_dias').val(),$('#permisos-per_horas').val(),$('#permisos-per_minutos').val())
        $('#permisos-per_total').val(total);
    });
    
    $("#funcionario").autocomplete({
        source: "buscarfuncionario", //de donde jala los datos
        minLength: 2,
        
        select: function(event, ui) {
            $("#permisos-fun_id").val(ui.item.id);
            //$("#usuario_saldo_diferido").val(ui.item.saldo);
            $("#Fun_Nombre").val(ui.item.label);
            vacaciones(ui.item.id);
        }
    });
});
//esta funcion calcula la diferencia de fechas
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
function sumar_valores(dias,horas,minutos){
    var total=0;
    var horas_dias;
    var minutos_dias;
    if(horas!=='')
        horas_dias=horas/8;
    else{
        horas_dias=0;
        $('#permisos-per_horas').val('0')
    }
        
    if(minutos!=='')
        minutos_dias=minutos/(8*60);
    else{
        minutos_dias=0;
        $('#permisos-per_minutos').val('0')
    }
        
    total=parseFloat(dias)+parseFloat(horas_dias)+parseFloat(minutos_dias);
    return total.toFixed(4);
}
//total de vacaciones registradas
function vacaciones(Fun_Id) {
    var jsonData = $.ajax({
        type: 'POST',
        url: '/sisvac/web/vacacion/vacaciones?id=' + Fun_Id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#vac_acu_cal').val(obj.tot_cal);
    $('#vac_acu_lab').val(obj.tot_lab);

}


function calcular_duracion_(fecha_ini, fecha_fin) {
    //alert(fecha_fin+" "+fecha_ini)
    var dias = 0;
    if (fecha_fin !== '') {
        var aFecha1 = fecha_ini.split('-');
        var aFecha2 = fecha_fin.split('-');
        var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
        var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);
        var dif = fFecha2 - fFecha1;
        //alert(fFecha1);
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        dias = dias + 1;
        var factor = parseInt($('#dias_ley').val()) + 15;
        var vac = dias * factor / 365;

    }


    return vac;
}



