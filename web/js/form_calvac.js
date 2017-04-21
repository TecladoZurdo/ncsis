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
            ultima_fecha(ui.item.id);

        }
    });
    $('#calvac-cal_fechafin').datepicker({
        //maxDate: new Date(anio_fin, mes_fin - 1, dia_fin),
        changeMonth: true,
        //maxDate:'+1M +1D',
        dateFormat: 'yy-mm-dd'
    });

    $('#calvac-cal_fechafin').change(function () {
        //var dias = calcular_duracion($('#fec_inicio').val(),  $('#fec_fin').val());
        //$("#dias").val(dias);
        $('#calvac-cal_dias').focus();
    });

    $('#calvac-cal_dias').focus(function () {
        diasley($('#calvac-fun_id').val(), $('#calvac-cal_fechafin').val());
        var dias = calcular_duracion_cal($('#calvac-cal_fechainicio').val(), $('#calvac-cal_fechafin').val());
        $("#calvac-cal_dias").val(dias.toFixed(2));
        permisos();
        listapermisos();
        total_vac();
        //var total = parseFloat($("#dias_cal").val()) - parseFloat($('#num_permisos').val());
        //$("#total").val(total);
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
        console.log(dias);
        //var factor = parseInt($('#dias_ley_cal').val()) + 15;
        var factor=15;
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
    //$('#dias_ley_lab').val(obj.dias_lab);
    //$('#vac_acu').val(obj.total);
    //alert(obj.tipo);


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
    //$('#num_per_lab').val(obj.tot_lab);
}

function listapermisos() {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#calvac-fun_id').val() + '&fecha_inicio=' + $('#calvac-cal_fechainicio').val() + '&fecha_fin=' + $('#calvac-cal_fechafin').val(),
        url: '../calculo/listapermisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    //$('#num_permisos').val(obj.total);


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
    //var tot_cal=parseFloat($("#calvac-cal_dias").val()) - parseFloat($('#calvac-cal_permisos').val());
    var tot_cal=parseFloat($("#calvac-cal_saldo").val()) - parseFloat($('#calvac-cal_permisos').val());
    $("#calvac-cal_total").val(tot_cal.toFixed(2));
    
}
