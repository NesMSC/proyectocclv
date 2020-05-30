
let buscar = (consulta='', type='') => {

	let con_url;

	if (type=='' || type == 'ac') {

		con_url = 'tabla_estu.php';

	}else if (type == 'in') {

		con_url = 'tabla_estu.php?in';

	}else if (type == 'float'){

		window.location = 'con_estudent.php?float';
	};

	$.ajax({
		url:  con_url,
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(tabla){
		$("#estu_tabla").html(tabla);
	})
	.fail(function(){
		console.log("error");
	});
};

$(document).on('keyup','#busqueda', function(){

	let valor_bus = $(this).val();

	let valor_al = $('#al_type').val();
	
	buscar(valor_bus, valor_al);
});



$(document).on('change','#al_type', function(){


	let valor_bus = $('#busqueda').val();

	let valor_al = $(this).val();
	
	buscar(valor_bus, valor_al);

	
});


$(buscar());
