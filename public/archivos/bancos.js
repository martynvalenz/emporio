$.ajaxSetup(
{
   headers: 
   {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

function Bancos()
{
	ListarBancos();
}

$('#reservation_bancos').on('change', function()
{
    ListarBancos();
});

$('#bancos_estatus_select').on('change', function()
{   
    setTimeout(ListarBancos, 300);
}); 

$('#bancos_tipo').on('change', function()
{  
    setTimeout(ListarBancos, 300);
}); 

$('#bancos_cuenta_select').on('change', function()
{  
    setTimeout(ListarBancos, 300);
}); 

$('#bancos_formas_pago_select').on('change', function()
{  
    setTimeout(ListarBancos, 300);
}); 

$("#btn-borrar-bancos").click(function()
{
    //ResetearFecha();
    $('#buscar-bancos').val('');
    setTimeout(ListarBancos, 300);
});
$("#btn-buscar-bancos").on("click", function(e)
{
    e.preventDefault();
    ListarBancos();
});

$('#buscar-bancos').on('keypress', function(e)
{
    if (e.which === 13)
    {
        //Desabilitar para evitar presionar multiples veces
        $(this).attr("disabled", "disabled");
        ListarBancos();
        //Habilitar textobx
        $(this).removeAttr("disabled");
    }
});

function ResetearFecha()
{
    fecha_inicio = $('#fecha_inicio_bancos_reset').val();
    fecha_fin = $('#fecha_fin_bancos_reset').val();
    $('#reservation_bancos').val(fecha_inicio + '  -  ' + fecha_fin);
}

function ListarBancos()
{
	url_listar = $('#url_listar_bancos').val();
	url_buscar = $('#url_buscar_bancos').val();

	estatus = $('#bancos_estatus_select').val();
	tipo = $('#bancos_tipo').val();
	cuenta = $('#bancos_cuenta_select').val();
	forma_pago = $('#bancos_formas_pago_select').val();
	buscar = $('#buscar-bancos').val();

	FechaRango = document.getElementById('reservation_bancos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];

	if(fecha_inicio == null)
	{
	    $('#reservation_bancos_error').html('La fecha inicial no puede estar vacía');
	    $('#reservation_bancos_error').fadeIn();
	}
	else if(fecha_fin == null)
	{
	    $('#reservation_bancos_error').html('La fecha final no puede estar vacía');
	    $('#reservation_bancos_error').fadeIn();
	}
	else if(fecha_inicio > fecha_fin)
	{
	    $('#reservation_bancos_error').html('La fecha inicial no puede ser mayor a la fecha final');
	    $('#reservation_bancos_error').fadeIn();
	    ResetearFechaEgreso();
	}
	else
	{
		if (buscar == '')
		{
		    
		    $.ajax(
		    {
		        type: 'get',
		        url: url_listar + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
		        + '/' + fecha_inicio + '/' + fecha_fin,
		        success: function(data)
		        {
		            $('#listado-bancos').empty().html(data);
		            $(".tooltip").tooltip("hide");
		            $(function()
		            {
		                $('#example1').stickyTableHeaders();
		            });

		            ActualizarBancosTotales();
		        }
		    });
		}
		else
		{
		    $.ajax(
		    {
		        type: 'get',
		        url: url_buscar + estatus + '/' + tipo + '/' + cuenta + '/'  + forma_pago 
		        + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin,
		        success: function(data)
		        {
		            $('#listado-bancos').empty().html(data);
		            $(".tooltip").tooltip("hide");
		            $(function()
		            {
		                $('#example1').stickyTableHeaders();
		            });

		            ActualizarBancosTotales();
		        }
		    });
		}
	}
}

function ActualizarBancosTotales()
{
	url_listar = $('#url_listar_bancos').val();
	url_buscar = $('#url_buscar_bancos').val();

	estatus = $('#bancos_estatus_select').val();
	tipo = $('#bancos_tipo').val();
	cuenta = $('#bancos_cuenta_select').val();
	forma_pago = $('#bancos_formas_pago_select').val();
	buscar = $('#buscar-bancos').val();

	FechaRango = document.getElementById('reservation_bancos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];

	if (buscar == '')
	{
		route = url_listar + 'total/' + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago 
		        + '/' + fecha_inicio + '/' + fecha_fin;

		        // console.log(route)

		$.get(route, function(data)
		{
			// console.log(data)
	    	$('#bancos_ingresos_totales').html('Ingresos: $ ' + parseFloat(data.ingresos, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());

	    	$('#bancos_egresos_totales').html('Egresos: $ ' + parseFloat(data.egresos, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
	    });
	}
	else
	{
		route = url_buscar + 'total/' + estatus + '/' + tipo + '/' + cuenta + '/'  + forma_pago 
		        + '/' + buscar + '/' + fecha_inicio + '/' + fecha_fin;

		$.get(route, function(data)
		{
	    	$('#bancos_ingresos_totales').html('Ingresos: $ ' + parseFloat(data.ingresos, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());	

	    	$('#bancos_egresos_totales').html('Egresos: $ ' + parseFloat(data.egresos, 20).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,").toString());
	    });
	}
}

function AgregarBancosListado(id)
{
	url_nuevo = $('#url_actualizar_bancos').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_nuevo + id,
	    success: function(data)
	    {
	        $('#list-bancos').prepend(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });
	    }
	});
}

function AcutalizarBancosListado(id)
{
	url_actuailzar = $('#url_actualizar_bancos').val();
	//console.log(url_actuailzar);
	$.ajax(
	{
	    type: 'get',
	    url: url_actuailzar + id,
	    success: function(data)
	    {
	        //console.log(data);
	        $('#listado-bancos-' + id).replaceWith(data);
	        $(".tooltip").tooltip("hide");
	        $(function()
	        {
	            $('.headerfix').stickyTableHeaders();
	        });
	    }
	}); 
}

$(document).on("click", ".bancos-pagination .pagination li a", function(e)
{
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax(
    {
        type: 'get',
        url: url,
        success: function(data)
        {
            $('#listado-bancos').empty().html(data);
        }
    });
});


$('#btn-exportar-bancos').click(function()
{
	estatus = $('#bancos_estatus_select').val();
	tipo = $('#bancos_tipo').val();
	cuenta = $('#bancos_cuenta_select').val();
	forma_pago = $('#bancos_formas_pago_select').val();
	FechaRango = document.getElementById('reservation_bancos').value.split('  -  ');
	fecha_inicio = FechaRango[0];
	fecha_fin = FechaRango[1];
	token= $('#_token').val();

	var url = '/admin/estados-cuenta-exportar/' + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago +
	  '/' + fecha_inicio + '/' + fecha_fin;
	window.open(url, '_blank');

	// route = '/admin/estados-cuenta-exportar/' + estatus + '/' + tipo + '/' + cuenta + '/' + forma_pago +
	//   '/' + fecha_inicio + '/' + fecha_fin;

	// $.ajax(
	// {
	//     url: route,
	//     headers:
	//     {
	//         'X-CSRF-TOKEN': token
	//     },
	//     type: 'GET',
	//     dataType: 'json',
	//     success: function(data)
	//     {
	//         toastr.success('Se generó el archivo de exportación exitosamente.');
	//     },
	//     error: function(data)
	//     {
	//         console.log(data);
	//         toastr.error('No se pudo generar el archivo de exportación');
	//     }
	// });
});









