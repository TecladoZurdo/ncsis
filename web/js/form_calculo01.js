$(function () {
    $("#funcionario").autocomplete({
        source: "buscarfuncionario", //de donde jala los datos
        minLength: 2,
        select: function (event, ui) {
            $("#fun_id").val(ui.item.id);
            //$("#usuario_saldo_diferido").val(ui.item.saldo);
            $("#Fun_Nombre").val(ui.item.label);
            total(ui.item.id);
            $("#fecha_ing").val(ui.item.fecha);
            $("#codigo").val(ui.item.codigo);
            //diasley(ui.item.id);
            //$('num_permi').focus();
            //intervalo(ui.item.id)
            //permisos();
            //dias();

        }
    });

    $('#fec_inicio').datepicker({
        //minDate: new Date(anio_ini, mes_ini - 1, dia_ini),
        changeMonth: true,
        //minDate:-4,
        //maxDate:+3,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $('#fec_fin').datepicker('option', 'minDate', selectedDate)
        }
        
    });


    $('#fec_fin').datepicker({
        //maxDate: new Date(anio_fin, mes_fin - 1, dia_fin),
        changeMonth: true,
        //maxDate:'+1M +1D',
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $('#fec_inicio').datepicker('option', 'maxDate', selectedDate)
        }
    });

    $('#fec_inicio').change(function () {
        //var dias = calcular_duracion($('#fec_inicio').val(), $('#fec_fin').val());
        //$("#dias").val(dias);
        //$('#permisos-per_dias').focus();
    });

    $('#fec_fin').change(function () {
        //var dias = calcular_duracion($('#fec_inicio').val(),  $('#fec_fin').val());
        //$("#dias").val(dias);
        $('#dias_cal_cal').focus();
        $('#dias_cal_lab').focus();
    });

    $('#dias_cal_cal').focus(function () {
        diasley($('#fun_id').val(), $('#fec_fin').val());
        var dias = calcular_duracion_cal($('#fec_inicio').val(), $('#fec_fin').val());
        $("#dias_cal_cal").val(dias);
        permisos();
        listapermisos();

        //var total = parseFloat($("#dias_cal").val()) - parseFloat($('#num_permisos').val());
        //$("#total").val(total);
    });
    $('#dias_cal_lab').focus(function () {
        diasley($('#fun_id').val(), $('#fec_fin').val());
        var dias = calcular_duracion_lab($('#fec_inicio').val(), $('#fec_fin').val());
        $("#dias_cal_lab").val(dias);
        //permisos();
        //ntalalistapermisos();

        //var total = parseFloat($("#dias_sin").val()) - parseFloat($('#num_permisos').val());
        //$("#total").val(total);
        total_vac();
    });

    /*
     $(".both").mayusculassintildes({
     allownumbers: true
     });
     $(".text").mayusculassintildes({
     });
     $(".number").mayusculassintildes({
     onlynumbers: true
     });
     */
});

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
        var factor = parseInt($('#dias_ley_cal').val()) + 15;
        var vac = dias * factor / 365;

    }


    return vac;
}
function calcular_duracion_lab(fecha_ini, fecha_fin) {
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
        var factor = parseInt($('#dias_ley_lab').val()) + 11;
        var vac = dias * factor / 365;

    }


    return vac;
}
function diasley(Fun_Id, fecha) {
    var jsonData = $.ajax({
        type: 'POST',
        url: 'diasley?id=' + Fun_Id + '&fecha=' + fecha,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    if (obj.dias > 15)
        $('#dias_ley_cal').val('15');
    else
        $('#dias_ley_cal').val(obj.dias_cal);
    $('#dias_ley_lab').val(obj.dias_lab);
    //$('#vac_acu').val(obj.total);
    //alert(obj.tipo);


}


function permisos() {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#fun_id').val() + '&fecha_inicio=' + $('#fec_inicio').val() + '&fecha_fin=' + $('#fec_fin').val(),
        url: 'permisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#num_per_cal').val(obj.tot_cal);
    $('#num_per_lab').val(obj.tot_lab);
}

function listapermisos() {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#fun_id').val() + '&fecha_inicio=' + $('#fec_inicio').val() + '&fecha_fin=' + $('#fec_fin').val(),
        url: 'listapermisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    //$('#num_permisos').val(obj.total);


    obj.forEach(function (item, i) {
        $('#div_lista').append('<div class="col-lg-3" style="clear:both">' + item.permiso + '</div>');
        //$('#div_lista').append('<div class="col-lg-2">' + item.fecha_inicio + '</div>');
        //$('#div_lista').append('<div class="col-lg-2">' + item.fecha_final + '</div>');
        $('#div_lista').append('<div class="col-lg-2">' + item.dias + '</div>');
    });
}

function total(id) {
    var jsonData = $.ajax({
        type: 'POST',
        //data: 'id=' + id,
        url: 'total?id=' + id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    $('#saldo_lab').val(obj.saldo_lab);
    $('#saldo_cal').val(obj.saldo_cal);


}

function total_vac(){
    var tot_cal=parseFloat($("#dias_cal_cal").val())+parseFloat($("#saldo_cal").val()) - parseFloat($('#num_per_cal').val());
    var tot_lab=parseFloat($("#dias_cal_lab").val())+parseFloat($("#saldo_lab").val()) - parseFloat($('#num_per_lab').val());
    
    $("#tot_cal").val(tot_cal.toFixed(2));
    $("#tot_lab").val(tot_lab.toFixed(2));
}
