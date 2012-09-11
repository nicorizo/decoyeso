	
	
	$(window).ready(function(){

		
			
			function mostrarPedido(){
				$('#pedidoListarBtn').css('display','');
				$('#pedidoDatosBtn').css('display','none');
				$('#pedidoEliminarBtn').css('display','');
				
				$('#tituloContenido').html('Datos del pedido');
				
				$('#msjInfo').css('display','');
				$('#datosPedidoContenido').css('display','');
					
			}
			
			function ocultarPedido(){
				$('#pedidoListarBtn').css('display','none');
				$('#pedidoDatosBtn').css('display','');
				$('#pedidoEliminarBtn').css('display','none');
				
				$('#msjInfo').css('display','none');
				$('#datosPedidoContenido').css('display','none');
			}
			
			function mostrarRelevamiento(){
				$('#pedidoRelevamientosCrearBtn').css('display','');
				$('#pedidoRelevamientosBtn').css('display','none');
				
				$('#tituloContenido').html('Relevamientos del pedido');

				$('#relevamientosPedidoContenido').css('display','');
			}
			
			function ocultarRelevamiento(){
				$('#pedidoRelevamientosBtn').css('display','');
				$('#pedidoRelevamientosCrearBtn').css('display','none');
				
				$('#relevamientosPedidoContenido').css('display','none');
			}
			
			function mostrarPresupuesto(){
				$('#pedidoPresupuestosCrearBtn').css('display','');
				$('#pedidoPresupuestosBtn').css('display','none');
				$('#tituloContenido').html('Presupuestos del pedido');
				
				$('#presupuestosPedidoContenido').css('display','');
			}
			
			function ocultarPresupuesto(){
				$('#pedidoPresupuestosBtn').css('display','');
				$('#pedidoPresupuestosCrearBtn').css('display','none');
				
				$('#presupuestosPedidoContenido').css('display','none');
			}
			
			mostrarPedido();
			ocultarRelevamiento();
			ocultarPresupuesto();
			
			$('#pedidoDatosBtn').click(function(){
				
				mostrarPedido();
				ocultarRelevamiento();
				ocultarPresupuesto();
				
			});
			
			$('#pedidoRelevamientosBtn').click(function(){
				
				ocultarPedido();
				mostrarRelevamiento();
				ocultarPresupuesto();
				
			});
			
			$('#pedidoPresupuestosBtn').click(function(){
				
				ocultarPedido();
				ocultarRelevamiento();
				mostrarPresupuesto();
				
			});
			
						
			
			

		});
		
	