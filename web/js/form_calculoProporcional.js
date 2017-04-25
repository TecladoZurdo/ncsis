var loep =0;
$(function () {
    $("#funcionario").autocomplete({
        source: "buscarfuncionario", //de donde jala los datos
        minLength: 2,
        select: function (event, ui) {
            $("#fun_id").val(ui.item.id);
            $("#Fun_Nombre").val(ui.item.label);
            total(ui.item.id);
            $("#fecha_ing").val(ui.item.fecha);
            $("#codigo").val(ui.item.codigo);
            loep = ui.item.losep;
            console.log(loep);
        }
    });

    $('#fec_inicio').datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $('#fec_fin').datepicker('option', 'minDate', selectedDate)
        }

    });


    $('#fec_fin').datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        onClose: function (selectedDate) {
            $('#fec_inicio').datepicker('option', 'maxDate', selectedDate)
        }
    });


    $('#fec_fin').change(function () {
        $('#dias_cal_cal').focus();
        $('#dias_cal_lab').focus();
    });

    $('#dias_cal_cal').focus(function () {
        diasley($('#fun_id').val(), $('#fec_fin').val());
        var dias = calcular_duracion_cal($('#fec_inicio').val(), $('#fec_fin').val());
        $("#dias_cal_cal").val(dias);
        permisos();
        listapermisos();

    });
    $('#dias_cal_lab').focus(function () {
        diasley($('#fun_id').val(), $('#fec_fin').val());
        var dias = calcular_duracion_lab($('#fec_inicio').val(), $('#fec_fin').val());
        $("#dias_cal_lab").val(dias);
        total_vac();
    });


});

function calcular_duracion_cal(fecha_ini, fecha_fin) {
    var dias = 0;
    if (fecha_fin !== '') {
        var aFecha1 = fecha_ini.split('-');
        var aFecha2 = fecha_fin.split('-');
        var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
        var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);

        if(loep){
            var diasMesIngreso = 30- aFecha1[2]+1;
            console.log('dIngreso:'+diasMesIngreso);
            var dif = Date.UTC(aFecha2[0],aFecha2[1]-1,30) - Date.UTC(aFecha1[0],aFecha1[1]-1,30);
            if(aFecha2[2]==30){
                year = aFecha2[0] - aFecha1[0];
                console.log('yearCSI30:'+year);
                if (year==0){
                    meses = aFecha2[1]-aFecha1[1];
                }else{
                  mesesAnterior = 12-aFecha2[1];
                  meses = parseInt(mesesAnterior) + parseInt(aFecha1[1])-1;
                }
                dias = diasMesIngreso+meses*30;
            }else{
              year = aFecha2[0] - aFecha1[0];
              console.log('yearNOL30:'+year);
              if (year==0){
                  meses = aFecha2[1]-aFecha1[1] -1;
              }else{
                mesesAnterior = 12-aFecha1[1];
                meses = parseInt(mesesAnterior) + parseInt(aFecha2[1])-1;
              }
              console.log('meses:'+meses);
              diasMesActual = aFecha2[2];
              console.log('dmesA:'+diasMesActual);
              dias = parseInt(diasMesIngreso)+parseInt(diasMesActual)+parseInt(meses*30);
            }
            console.log('diasTotal:'+dias);
            var factor = parseInt($('#dias_ley_cal').val()) + 30;
            var vac = dias * factor / 360;
        }else {
          var dif = fFecha2 - fFecha1;
          var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
          console.log(dias);
          dias = dias + 1;
          console.log('dias cal:'+dias);
          var factor = parseInt($('#dias_ley_cal').val()) + 15;
          console.log(factor);
          var vac = dias * factor / 365;
        }


    }


    return vac.toFixed(2);
}
function calcular_duracion_lab(fecha_ini, fecha_fin) {

    var dias = 0;
    if (fecha_fin !== '') {
        var aFecha1 = fecha_ini.split('-');
        var aFecha2 = fecha_fin.split('-');
        var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
        var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);
        var dif = fFecha2 - fFecha1;

        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        dias = dias + 1;
        console.log('dias lab:'+dias);
        if(loep){
          var diasMesIngreso = 30- aFecha1[2]+1;
          console.log('dIngreso:'+diasMesIngreso);
          if(aFecha2[2]==30){
              year = aFecha2[0] - aFecha1[0];
              console.log('yearLSI30:'+year);
              if (year==0){
                  meses = aFecha2[1]-aFecha1[1];
              }else{
                mesesAnterior = 12-aFecha2[1];
                meses = parseInt(mesesAnterior) + parseInt(aFecha1[1]) -1;
              }
              dias = parseInt(diasMesIngreso)+parseInt(meses*30);
          }else{
            year = aFecha2[0] - aFecha1[0];
            console.log('yearNOL30:'+year);
            if (year==0){
                meses = aFecha2[1]-aFecha1[1] -1;
            }else{
              mesesAnterior = 12-aFecha1[1];
              meses = parseInt(mesesAnterior) + parseInt(aFecha2[1] -1);
            }
            console.log('meses:'+meses);
            diasMesActual = aFecha2[2];
            console.log('dmesA:'+diasMesActual);
            dias = parseInt(diasMesIngreso)+parseInt(diasMesActual)+parseInt(meses*30);
          }
          console.log('diasTotal:'+dias);
          var factor = parseInt($('#dias_ley_cal').val()) + 22;
          var vac = dias * factor / 360;
        }else{
            var factor = parseInt($('#dias_ley_lab').val()) + 11;
        }

        var vac = dias * factor / 365;

    }


    return vac.toFixed(2);
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


    obj.forEach(function (item, i) {
        $('#div_lista').append('<div class="col-lg-3" style="clear:both">' + item.permiso + '</div>');
        $('#div_lista').append('<div class="col-lg-2">' + item.dias + '</div>');
    });
}

function total(id) {
    var jsonData = $.ajax({
        type: 'POST',
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
