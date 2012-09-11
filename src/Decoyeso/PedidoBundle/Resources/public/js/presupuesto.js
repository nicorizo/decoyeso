$(document).ready(function(){
	
	//Mostrar/Ocultar Columna Precios Unitarios y Cantidad
	$("#decoyeso_pedidobundle_presupuestotype_mostrarPreciosUnitarios").bind("change", function(){
		
		if ($(this).val() == 0) {
			$(".NtdCantidad, .NtdPrecioUnitario, .inputCantidad, .precioUnitario").removeClass("NvisibilityHidden")
		}
		else{
			$(".NtdCantidad, .NtdPrecioUnitario, .inputCantidad, .precioUnitario").addClass("NvisibilityHidden")
		}
	});
	
	$('#decoyeso_pedidobundle_presupuestotype_mostrarPreciosUnitarios').trigger('change');
		
		
	//Operacion CANTIDAD * PRECIO UNIT. 
	$(".inputCantidad, .precioUnitario").change(function(index, el) {
		
		var inputs = new Array();
		inputs['inputCantidad'] = new Array(); 
		inputs['precioUnitario'] = new Array();
		
		$(".inputCantidad").each(function(index) {
			if ($(this).val() != "" && $.isNumeric($(this).val()))
				inputs["inputCantidad"][index] = parseFloat($(this).val());
		});
		$(".precioUnitario").each(function(index) {
			if ($(this).val() != "" && $.isNumeric($(this).val()))
				inputs["precioUnitario"][index] = parseFloat($(this).val());
		});
		
		$(".inputPrecioTotal").each(function(index) {
			if ($.isNumeric(inputs["inputCantidad"][index]) && $.isNumeric(inputs["precioUnitario"][index])) {
				$(this).val(inputs["inputCantidad"][index] * inputs["precioUnitario"][index])
				$(this).change();	
			}
		});
		
	});
	
	//Sumas de casillas PRECIO TOTAL
	$(".inputPrecioTotal").change(function(){
		
		var subTotal = 0;
		$(".inputPrecioTotal").each(function() {
			if ($(this).val() != "") {
				if ($.isNumeric($(this).val())) {
					subTotal = subTotal + parseFloat($(this).val());
				}
				else { 
					alert ("El valor "+$(this).val()+" no se puede sumar. Por favor reviselo.");
				}
			}
		});
		$("#decoyeso_pedidobundle_presupuestotype_subTotal, #decoyeso_pedidobundle_presupuestotype_total").val(subTotal);
		
	});
	
	

		
});
		
	