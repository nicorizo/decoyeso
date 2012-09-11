	
	
	$(window).ready(function(){
	
		 function evaluarCamposForm(){
	
				if($('#cliente_tipo').val()==2){
					$('#div_cliente_dni').css('display','none');
					$('#div_cliente_nombre label').html('Nombre');
					$('#div_cliente_cuitOcuil label').html('CUIT');
				}else{
					$('#div_cliente_dni').css('display','');
					$('#div_cliente_nombre label').html('Apellido, Nombre');
					$('#div_cliente_cuitOcuil label').html('CUIL');
				}
		  }
		
		
		
			evaluarCamposForm();
		
			$('#cliente_tipo').change(function(){
					
					evaluarCamposForm();
			});
			
			$('#pedidosClienteContenido').css('display','none');
			$('#clienteDatosBtn').css('display','none');
			$('#clientePedidosCrearBtn').css('display','none');
			
			$('#clientePedidosBtn').click(function(){
				
				$('#datosClienteContenido').css('display','none');
				$('#clientePedidosBtn').css('display','none');
				$('#clienteListarBtn').css('display','none');
				$('#clienteEliminarBtn').css('display','none');
				$('#msjInfo').css('display','none');
				
				$('#pedidosClienteContenido').css('display','');
				$('#clienteDatosBtn').css('display','');
				$('#clientePedidosCrearBtn').css('display','');
				
				$('#tituloContenido').html('Pedidos del cliente');
				
			});
			
			$('#clienteDatosBtn').click(function(){
				

				$('#pedidosClienteContenido').css('display','none');
				$('#clienteDatosBtn').css('display','none');
				$('#clientePedidosCrearBtn').css('display','none');
				
				$('#datosClienteContenido').css('display','');
				$('#clientePedidosBtn').css('display','');
				$('#clienteListarBtn').css('display','');
				$('#clienteEliminarBtn').css('display','');
				$('#msjInfo').css('display','');
				
				$('#tituloContenido').html('Datos del cliente');
				
			});
			
			
			

		});
		
	