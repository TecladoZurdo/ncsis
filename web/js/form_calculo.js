var loep =0;
$(function () {
    $("#funcionario").autocomplete({
        source: "buscarfuncionario", //de donde jala los datos
        minLength: 2,
        select: function (event, ui) {
            $("#calculo-fun_id").val(ui.item.id);
            $("#Fun_Nombre").val(ui.item.label);
            $("#fecha_ing").val(ui.item.fecha);
            $("#codigo").val(ui.item.codigo);
            $("#estado").val(ui.item.estado);
            loep = ui.item.losep;
            //console.log(loep);
            if (loep){ // para los nuevos se realizar nuevos calculos
             calcularVacacionesPeriodicas(ui.item.id);
            }else {
            intervalo(ui.item.id);
            }

            //console.log(ui.item.id);

        }
    });

/*    $('#num_permisos').focus(function () {
    });*/
    $('#vac_his').change(function () {
        $('#calculo-cal_dias').val(dias.toFixed(2));
    });

    $("#calculo-cal_dias").change(function () {
        total_vac_lab();
        total_vac_cal();
    });

    $('#calculo-cal_diascal').change(function(){
        var diascal=$(this).val();
        var diaslab=0;
        if(diascal>=0 && diascal<=6)
            diaslab=diascal;
        else if(diascal>=7 && diascal<=14)
            diaslab=diascal-2;
        else if(diascal>=15 && diascal<=22)
            diaslab=diascal-4;
        else if(diascal>=23 && diascal<=29)
            diaslab=diascal-6;
        else if(diascal>=30 && diascal<=37)
            diaslab=diascal-8;
        else if(diascal>=38 && diascal<=44)
            diaslab=diascal-10;
        else if(diascal>=45 && diascal<=52)
            diaslab=diascal-12;
        else if(diascal>=53 && diascal<=59)
            diaslab=diascal-14;
        else if(diascal>=60)
            diaslab=diascal-16;
        $('#calculo-cal_diaslab').val(diaslab)
    });

});

function calcularVacacionesPeriodicas(Fun_Id){
    //console.log(3);
    var jsonData = $.ajax({
        type: 'POST',
        url: 'vacaciones_periodicas?id=' + Fun_Id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    console.log(obj);
    $('#calculo-cal_fechainicio').val(obj.fecha_inicio);
    $('#calculo-cal_fechafin').val(obj.fecha_fin);
    $('#calculo-cal_anio').val(obj.anio);
    $('#dias_ley_lab').val(obj.dias_ley_lab);
    $('#dias_ley_cal').val(obj.dias_ley_cal);
    $('#vac_acu_lab').val(obj.vac_acu_lab);
    $('#vac_acu_cal').val(obj.vac_acu_cal);
    $('#vac_dias_lab').val(obj.vac_dias_lab);
    $('#vac_dias_cal').val(obj.vac_dias_cal);
    $('#num_per_cal').val(obj.num_per_cal);
    $('#num_per_lab').val(obj.num_per_lab);
    $('#calculo-cal_diascal').val(obj.calculo_cal_diascal);
    $('#calculo-cal_diaslab').val(obj.calculo_cal_diaslab);
    $('#calculo-cal_salcal').val(obj.calculo_cal_salcal);
    $('#calculo-cal_sallab').val(obj.calculo_cal_sallab);
    listapermisos();
    if (obj.guardar){
        $("#div_regresar").hide();
        $("#div_guardar").show();
    }else {
        $("#div_regresar").show();
        $("#div_guardar").hide();
    }

}

function intervalo(Fun_Id) {
    //var urlCalculo=$('#vacaciones_periodicas').attr('action');
    //console.log(urlCalculo);
    var jsonData = $.ajax({
        type: 'POST',
        url: 'fechas?id=' + Fun_Id,
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    console.log(obj);
    $('#calculo-cal_fechainicio').val(obj.fecha_inicio);
    $('#calculo-cal_fechafin').val(obj.fecha_fin);
    $('#calculo-cal_anio').val(obj.anio);
    $('#dias_ley_lab').val(obj.dias_ley_lab);
    $('#dias_ley_cal').val(obj.dias_ley_cal);

    $('#vac_acu_lab').val(obj.vac_acu_lab);
    $('#vac_acu_cal').val(obj.vac_acu_cal);
    var estado = $("#estado").val();
    //alert(obj.tipo);
    if (obj.tipo === 'historico') {

        //$('#calculo-cal_diaslab').prop('readonly', false);
        $('#calculo-cal_diascal').prop('readonly', false);
        if (estado === "activo") {
            $("#div_regresar").hide();
            $("#div_guardar").show();
        } else {
            $("#div_regresar").show();
            $("#div_guardar").hide();
        }

        $('#num_per_cal').val(0);
        $('#num_per_lab').val(0);
        $('#vac_dias_lab').val(0);
        $('#vac_dias_cal').val(0);
        $("#calculo-cal_salcal").val(0);
        $("#calculo-cal_sallab").val(0);

    } else if (obj.tipo === 'no calculado') {
        $("#div_regresar").show();
        $("#div_guardar").hide();
        permisos(obj.tipo);
        listapermisos();
    } else {
        if (estado === "activo") {
            $("#div_regresar").hide();
            $("#div_guardar").show();
        } else {
            $("#div_regresar").show();
            $("#div_guardar").hide();
        }
        $('#calculo-cal_dias').prop('readonly', true);
        permisos(obj.tipo);
        listapermisos();
    }

}
function dias(tipo) {
    //var vac_his = $('#va_his').val();
    var dias_ley_lab = $('#dias_ley_lab').val() !== '' ? $('#dias_ley_lab').val() : 0;
    var dias_ley_cal = $('#dias_ley_cal').val() !== '' ? $('#dias_ley_cal').val() : 0;
    var per_cal = $('#num_per_cal').val() !== '' ? $('#num_per_cal').val() : 0;
    var per_lab = $('#num_per_lab').val() !== '' ? $('#num_per_lab').val() : 0;
    var dias_lab = 0;
    var dias_cal = 0;
    if (tipo !== 'no calculado') {
        dias_lab = parseFloat(11) + parseFloat(dias_ley_lab) - parseFloat(per_lab);
        dias_cal = parseFloat(15) + parseFloat(dias_ley_cal) - parseFloat(per_cal);
        $('#vac_dias_lab').val(11);
        $('#vac_dias_cal').val(15);
    } else {
        var inter_lab = calcular_duracion($('#calculo-cal_fechainicio').val(), $('#calculo-cal_fechafin').val());
        var inter_cal = calcular_duracion_cal($('#calculo-cal_fechainicio').val(), $('#calculo-cal_fechafin').val());
        dias_lab = parseFloat(inter_lab) - parseFloat(per_lab);
        dias_cal = parseFloat(inter_cal) - parseFloat(per_cal);
        $('#vac_dias_lab').val(inter_lab.toFixed(2));
        $('#vac_dias_cal').val(inter_cal.toFixed(2));
    }
    //var dias=parseFloat(15)+parseFloat(obj.dias);
    $('#calculo-cal_diascal').val(dias_cal.toFixed(2));
    $('#calculo-cal_diaslab').val(dias_lab.toFixed(2));
}

function permisos(tipo) {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#calculo-fun_id').val() + '&fecha_inicio=' + $('#calculo-cal_fechainicio').val() + '&fecha_fin=' + $('#calculo-cal_fechafin').val(),
        url: 'permisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    if (obj !== ''){
        $('#num_per_cal').val(obj.tot_cal);
        $('#num_per_lab').val(obj.tot_lab);
    }
    else{
        $('#num_per_cal').val('0');
        $('#num_per_lab').val('0');
    }

    dias(tipo);
    total_vac_lab();
    total_vac_cal();
}


function listapermisos() {
    var jsonData = $.ajax({
        type: 'POST',
        data: 'id=' + $('#calculo-fun_id').val() + '&fecha_inicio=' + $('#calculo-cal_fechainicio').val() + '&fecha_fin=' + $('#calculo-cal_fechafin').val(),
        url: 'listapermisos',
        dataType: 'json',
        async: false}).responseText;
    var obj = jQuery.parseJSON(jsonData);
    obj.forEach(function (item, i) {
        $('#div_lista').append('<div class="col-lg-3" style="clear:both">' + item.permiso + '</div>');
        //$('#div_lista').append('<div class="col-lg-2">' + item.fecha_inicio + '</div>');
        //$('#div_lista').append('<div class="col-lg-2">' + item.fecha_final + '</div>');
        $('#div_lista').append('<div class="col-lg-2">' + item.dias + '</div>');
    });
}

function calcular_duracion(fecha_ini, fecha_fin) {
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
        var factor = parseInt($('#dias_ley_lab').val()) + 11;
        var vac = dias * factor / 365;

    }
    return vac;
}
function calcular_duracion_cal(fecha_ini, fecha_fin) {

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
        var factor = parseInt($('#dias_ley_cal').val()) + 15;
        var vac = dias * factor / 365;

    }
    return vac;
}
function total_vac_lab() {
    var dias_lab = $("#calculo-cal_diaslab").val();
    var acu_lab = $("#vac_acu_lab").val();
    var suma = parseFloat('0');
    if (dias_lab !== "") {
        suma = parseFloat(dias_lab) + parseFloat(acu_lab);
    }
    $("#calculo-cal_sallab").val(suma.toFixed(2));
}
function total_vac_cal() {
    var dias_cal = $("#calculo-cal_diascal").val();
    var acu_lab = $("#vac_acu_cal").val();
    var suma = parseFloat('0');
    if (dias_cal !== "") {
        suma = parseFloat(dias_cal) + parseFloat(acu_lab);
    }
    $("#calculo-cal_salcal").val(suma.toFixed(2));
}
