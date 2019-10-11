$(document).ready(function()
{
    $("#id_cat").change(mostrarValores);
    //$("#id_bitacoras").change(avance_total_bitacoras);
    $('#bt_actualizar').click(function()
    {
        actualizarValores();
    });
    $('#btn_tipo_cambio').click(function()
    {
        tipo_cambio = $('#tipo_cambio_val').val();
        //console.log(tipo_cambio);
        if (tipo_cambio == '')
        {
            toastr.error('El campo tipo de cambio no puede estar vacío');
            $('#tipo_cambio_val').focus();
        }
        else if (tipo_cambio == 0)
        {
            toastr.error('No puede aplicar el tipo de cambio con valor de "cero" ');
            $('#tipo_cambio_val').focus();
        }
        else
        {
            actualizarValores();
            aplicarPorcentajeDescuento();
            //actualizarValores();
        }
    });
    $('#btn_porcentaje_descuento').click(function()
    {
        aplicarPorcentajeDescuento();
        //actualizarValores();
    });
    $('#btn_descuento').click(function()
    {
        aplicarDescuento();
        //actualizarValores();
    });
});

function mostrarValores()
{
    datosServicio = document.getElementById('id_cat').value.split('_');
    $("#id_catalogo_servicio").val(datosServicio[0]);
    $("#concepto_costo").val(datosServicio[1]);
    $("#moneda").val(datosServicio[2]);
    $("#moneda_val").val(datosServicio[2]);
    $("#costo_servicio").val(datosServicio[12]);
    costo_servicio = datosServicio[12];
    costo_servicio = costo_servicio * 1;
    
    if (costo_servicio > 0)
    {
        $("#asignar_costo_servicio").val("1").change();
        $('#asignar_costo_servicio').prop('checked', true);
        $("#asignar_costo_servicio_check").val("1");
    }
    else if (costo_servicio == 0)
    {
        $("#asignar_costo_servicio").val("0").change();
        $('#asignar_costo_servicio').prop('checked', false);
        $("#asignar_costo_servicio_check").val("0");
    }

    $("#id_bitacoras").val(datosServicio[11]);
    $("#tipo_cambio_anterior").val(datosServicio[10]);
    $("#tipo_cambio_val").val(datosServicio[10]);
    concepto = datosServicio[1];
    $("#porcentaje_comision_venta").val(datosServicio[5]);
    $("#porcentaje_comision_operativa").val(datosServicio[7]);
    $("#porcentaje_comision_gestion").val(datosServicio[9]);
    if (concepto == 'Neto')
    {
        tipo_cambio = datosServicio[10];
        costo = datosServicio[3];
        conversion = tipo_cambio * costo;
        $("#costo").val(conversion);
        $("#costo_final").val(conversion);
        $("#costo_ini").val(costo);
        $("#costo_ini_val").val(costo);
    }
    else
    {
        tipo_cambio = datosServicio[10];
        $("#costo_ini").val(0);
        $("#costo_ini_val").val(0);
        conversion = 0;
        $("#costo").val(conversion);
        $("#costo_final").val(conversion);
    }
    //Comisiones Ventas
    $("#concepto_venta").val(datosServicio[4]);
    $("#concepto_venta_val").val(datosServicio[4]);
    concepto_venta = datosServicio[4];
    if (concepto_venta == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
        comision_venta = datosServicio[5] * tipo_cambio;
        $("#comision_venta").val(comision_venta);
        $("#comision_venta_val").val(comision_venta);
    }
    else if ((concepto_venta == 'Porcentaje' || concepto_venta == 'Porcentaje Utilidad') && conversion > 0)
    {
        porcentaje = datosServicio[5];
        comision_venta = tipo_cambio * conversion * (porcentaje / 100);
        $("#comision_venta").val(comision_venta);
        $("#comision_venta_val").val(comision_venta);
    }
    else
    {
        comision_venta = 0;
        $("#comision_venta").val(comision_venta);
        $("#comision_venta_val").val(comision_venta);
    }
    /*if(comision_venta > 0)
    {
      $("#aplica_comision_venta").val("1").change();
      $('#aplica_comision_venta').prop('checked' , true);
    }
    else if(comision_venta == 0)
    {
      $("#aplica_comision_venta").val("0").change();
      $('#aplica_comision_venta').prop('checked' , false);
    }*/
    //Comisiones Operativas
    $("#concepto_operativo").val(datosServicio[6]);
    $("#concepto_operativo_val").val(datosServicio[6]);
    concepto_operativo = datosServicio[6];
    if (concepto_operativo == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
        comision_operativa = datosServicio[7] * tipo_cambio;
        $("#comision_operativa").val(comision_operativa);
        $("#comision_operativa_val").val(comision_operativa);
    }
    else if ((concepto_operativo == 'Porcentaje' || concepto_operativo == 'Porcentaje Utilidad') && conversion > 0)
    {
        porcentaje_operativo = datosServicio[7];
        comision_operativa = tipo_cambio * conversion * (porcentaje_operativo / 100);
        $("#comision_operativa").val(comision_operativa);
        $("#comision_operativa_val").val(comision_operativa);
    }
    else
    {
        comision_operativa = 0;
        $("#comision_operativa").val(comision_operativa);
        $("#comision_operativa_val").val(comision_operativa);
    }
    //Comisiones Gestion
    $("#concepto_gestion").val(datosServicio[8]);
    $("#concepto_gestion_val").val(datosServicio[8]);
    concepto_gestion = datosServicio[8];
    if (concepto_gestion == 'Monto Fijo' || concepto_venta == 'Dolares')
    {
        comision_gestion = datosServicio[9] * tipo_cambio;
        $("#comision_gestion").val(comision_gestion);
        $("#comision_gestion_val").val(comision_gestion);
    }
    else if ((concepto_gestion == 'Porcentaje' || concepto_gestion == 'Porcentaje Utilidad') && conversion > 0)
    {
        porcentaje_gestion = datosServicio[9];
        comision_gestion = tipo_cambio * conversion * (porcentaje_gestion / 100);
        $("#comision_gestion").val(comision_gestion);
        $("#comision_gestion_val").val(comision_gestion);
    }
    else
    {
        comision_gestion = 0;
        $("#comision_gestion").val(comision_gestion);
        $("#comision_gestion_val").val(comision_gestion);
    }
}

function aplicarPorcentajeDescuento()
{
    porcentaje_descuento = $('#porcentaje_descuento').val();
    costo_final = $('#costo_final').val();
    descuento = 0;
    if (costo_final == 0)
    {
        costo = $('#costo').val();
        $('#costo_final').val(costo);
        costo_final = costo;
    }
    if (porcentaje_descuento == '')
    {
        toastr.error('Anote un porcentaje de descuento.');
        $('#porcentaje_descuento').focus();
    }
    else if (porcentaje_descuento > 100)
    {
        toastr.error('El porcentaje no puede ser mayor al 100%');
        $('#porcentaje_descuento').focus();
    }
    else if (porcentaje_descuento < 0)
    {
        toastr.error('El porcentaje no puede ser menor a 0%');
        $('#porcentaje_descuento').focus();
    }
    else
    {
        descuento = costo_final * (porcentaje_descuento / 100);
        descuento = Math.round(descuento, 2);
        costo = costo_final - descuento
        $('#descuento').val(descuento);
        $('#costo').val(costo);
    }
}

function aplicarDescuento()
{
    descuento = $('#descuento').val();
    costo_final = $('#costo_final').val();
    if (costo_final == 0)
    {
        costo = $('#costo').val();
        $('#costo_final').val(costo);
        costo_final = costo;
    }
    porcentaje_descuento = 0;
    descuento = descuento * 1;
    costo_final = costo_final * 1;
    if (descuento == '')
    {
        costo_final = costo_final - descuento;
        porcentaje_descuento = descuento / (descuento + costo_final) * 100;
        porcentaje_descuento = Math.round(porcentaje_descuento);
        $('#porcentaje_descuento').val(porcentaje_descuento);
        $('#costo').val(costo_final);
    }
    else if (descuento > costo_final)
    {
        toastr.error('El descuento no puede ser mayor al costo del servicio.');
        descuento = 0;
        $('#descuento').val(descuento);
        $('#costo').val(costo_final);
        $('#descuento').focus();
    }
    else
    {
        costo_final = costo_final - descuento;
        porcentaje_descuento = descuento / (descuento + costo_final) * 100;
        porcentaje_descuento = Math.round(porcentaje_descuento);
        $('#porcentaje_descuento').val(porcentaje_descuento);
        $('#costo').val(costo_final);
    }
}

function actualizarValores()
{
    costo = $('#costo').val();
    if (costo == '')
    {
        toastr.error('El costo no puede estar vacío, anote un valor.');
        $('#costo').focus();
    }
    else if (costo == 0)
    {
        comision_venta = 0;
        $("#comision_venta").val(comision_venta);
        $("#comision_venta_val").val(comision_venta);
        comision_gestion = 0;
        $("#comision_gestion").val(comision_gestion);
        $("#comision_gestion_val").val(comision_gestion);
        comision_operativa = 0;
        $("#comision_operativa").val(comision_operativa);
        $("#comision_operativa_val").val(comision_operativa);
    }
    else
    {
        tipo_cambio = $('#tipo_cambio_val').val();
        tipo_cambio_anterior = $('#tipo_cambio_anterior').val();
        conversion = tipo_cambio * costo / tipo_cambio_anterior;
        
        //Comisiones Ventas
        concepto_venta = $("#concepto_venta").val();

        if (concepto_venta == 'Monto Fijo' || concepto_venta == 'Dolares')
        {
            comision_venta = $("#comision_venta").val();
            comision_venta = comision_venta * tipo_cambio / tipo_cambio_anterior;
            comision_venta = Math.round(comision_venta);
            $("#comision_venta").val(comision_venta);
            $("#comision_venta_val").val(comision_venta);
        }
        else if (concepto_venta == 'Porcentaje' || concepto_venta == 'Porcentaje Utilidad' && conversion > 0)
        {
            porcentaje = $('#porcentaje_comision_venta').val();
            comision_venta = conversion * porcentaje / 100;
            comision_venta = Math.round(comision_venta);
            $("#comision_venta").val(comision_venta);
            $("#comision_venta_val").val(comision_venta);
        }
        else
        {
            comision_venta = 0;
            $("#comision_venta").val(comision_venta);
            $("#comision_venta_val").val(comision_venta);
        }

        //Comisiones Operativas
        $("#concepto_operativo").val(datosServicio[6]);
        concepto_operativo = datosServicio[6];
        if (concepto_operativo == 'Monto Fijo' || concepto_operativo == 'Dolares')
        {
            comision_operativa = $("#comision_operativa").val();
            comision_operativa = comision_operativa * tipo_cambio / tipo_cambio_anterior;
            comision_operativa = Math.round(comision_operativa);
            $("#comision_operativa").val(comision_operativa);
            $("#comision_operativa_val").val(comision_operativa);
        }
        else if (concepto_operativo == 'Porcentaje' || concepto_operativo == 'Porcentaje Utilidad' && conversion > 0)
        {
            porcentaje_operativo = $('#porcentaje_comision_operativa').val();
            comision_operativa = conversion * porcentaje_operativo / 100;
            comision_operativa = Math.round(comision_operativa);
            $("#comision_operativa").val(comision_operativa);
            $("#comision_operativa_val").val(comision_operativa);
        }
        else
        {
            comision_operativa = 0;
            $("#comision_operativa").val(comision_operativa);
            $("#comision_operativa_val").val(comision_operativa);
        }
        //Comisiones Gestion
        $("#concepto_gestion").val(datosServicio[8]);
        concepto_gestion = datosServicio[8];
        if (concepto_gestion == 'Monto Fijo' || concepto_gestion == 'Dolares')
        {
            comision_gestion = $("#comision_gestion").val();
            comision_gestion = comision_gestion * tipo_cambio / tipo_cambio_anterior;
            comision_gestion = Math.round(comision_gestion);
            $("#comision_gestion").val(comision_gestion);
            $("#comision_gestion_val").val(comision_gestion);
        }
        else if (concepto_gestion == 'Porcentaje' || concepto_gestion == 'Porcentaje Utilidad' && conversion > 0)
        {
            porcentaje_gestion = $('#porcentaje_comision_gestion').val();
            comision_gestion = tipo_cambio * conversion * (porcentaje_gestion / 100);
            comision_gestion = Math.round(comision_gestion);
            $("#comision_gestion").val(comision_gestion);
            $("#comision_gestion_val").val(comision_gestion);
        }
        else
        {
            comision_gestion = 0;
            $("#comision_gestion").val(comision_gestion);
            $("#comision_gestion_val").val(comision_gestion);
        }
        $("#tipo_cambio_anterior").val(tipo_cambio);
        conversion = Math.round(conversion);
        $("#costo").val(conversion);
        $("#costo_final").val(conversion);
    }
}


$('#aplica_comision_gestion').on('change', function()
{
    this.value = this.checked ? 1 : 0;
    //alert(this.value);
    $("#aplica_comision_gestion_check").val(this.value);
    setTimeout(ComisionGestion, 200);
}).change();


function ComisionGestion()
{
    aplica_gestion = $('#aplica_comision_gestion_check').val();
    comision_venta = $('#comision_venta_val').val();
    comision_gestion = $('#comision_gestion_val').val();

    if(comision_venta == 0)
    {

    }
    else
    {
        if(aplica_gestion == 1)
        {
            comision_venta = (comision_venta * 1) - (comision_gestion * 1);
            //console.log(comision_venta);
            $('#comision_venta_val').val(comision_venta);
            $('#comision_venta').val(comision_venta);
        }
        else if(aplica_gestion == 0)
        {
            comision_venta = (comision_venta * 1) + (comision_gestion * 1);
            //console.log(comision_venta);
            $('#comision_venta_val').val(comision_venta);
            $('#comision_venta').val(comision_venta);
        }
    }

    
}



















