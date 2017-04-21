var loep =0;
$(function () {
    $("#funcionario").autocomplete({
        source: $("#link_funcionario").attr('href'), //de donde jala los datos
        minLength: 2,
        select: function (event, ui) {
            $("#calvac-fun_id").val(ui.item.id);
            $("#Fun_Nombre").val(ui.item.label);
            total(ui.item.id);
            $("#fecha_ing").val(ui.item.fecha);
            $("#codigo").val(ui.item.codigo);
            loep = ui.item.losep;
            ultima_fecha(ui.item.id);

        }
    });
    $('#calvac-cal_fechafin').datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd'
    });

    $('#calvac-cal_fechafin').change(function () {
        $('#calvac-cal_dias').focus();
    });

    $('#calvac-cal_dias').focus(function () {
        if (loep){
            $('#calvac-cal_ley').val('0');
        }else{
            diasley($('#calvac-fun_id').val(), $('#calvac-cal_fechafin').val());    
        }
        
        var dias = calcular_duracion_cal($('#calvac-cal_fechainicio').val(), $('#calvac-cal_fechafin').val());
        $("#calvac-cal_dias").val(dias.toFixed(2));
        permisos();
        listapermisos();
        total_vac();
    });
    
});

function ultima_fecha(Fun_Id){
    var jsonData = $.ajax({
        type: 'POST',
        url: $('#link_fecha').attr('href') + Fun_Id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#calvac-cal_fechainicio').val(obj.fecha_fin);
    $('#calvac-cal_anio').val(obj.anio);
}



function calcular_duracion_cal(fecha_ini, fecha_fin) {
    var dias = 0;
    if (fecha_fin !== '') {
        var aFecha1 = fecha_ini.split('-');
        var aFecha2 = fecha_fin.split('-');
        var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
        var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);
        var dif = fFecha2 - fFecha1;
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        dias = dias + 1;
        console.log(dias);
        if(loep){
            var factor=30;
        }else {
            var factor=15;    
        }
        
        var vac = dias * factor / 365;

    }

    return vac;
}

function diasley(Fun_Id, fecha) {
    var jsonData = $.ajax({
        type: 'POST',
        url: '../calculo/diasley?id=' + Fun_Id + '&fecha=' + fecha,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    if (obj.dias > 15)
        $('#calvac-cal_ley').val('15');
    else
        $('#calvac-cal_ley').val(obj.dias_cal);
}

function permisos() {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#calvac-fun_id').val() + '&fecha_inicio=' + $('#calvac-cal_fechainicio').val() + '&fecha_fin=' + $('#calvac-cal_fechafin').val(),
        url: '../calculo/permisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#calvac-cal_permisos').val(obj.tot_cal);
}

function listapermisos() {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#calvac-fun_id').val() + '&fecha_inicio=' + $('#calvac-cal_fechainicio').val() + '&fecha_fin=' + $('#calvac-cal_fechafin').val(),
        url: '../calculo/listapermisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);


    obj.forEach(function (item, i) {
        $('#div_lista').append('<div class="col-lg-3" style="clear:both">' + item.permiso + '</div>');
        $('#div_lista').append('<div class="col-lg-2">' + item.dias + '</div>');
    });
}

function total(id) {
    var jsonData = $.ajax({
        type: 'POST',
        url: '../calculo/total?id=' + id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#calvac-cal_saldo').val(obj.saldo_cal);


}

function total_vac(){
    var tot_cal=parseFloat($("#calvac-cal_saldo").val()) - parseFloat($('#calvac-cal_permisos').val());
    $("#calvac-cal_total").val(tot_cal.toFixed(2));
    
}
