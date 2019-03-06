<!DOCTYPE HTML>
<html lang="es">
      <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Procesos</title>


        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/vendors/table-sorter/themes/blue/style.css">
	
	
	       <!-- Bootstrap -->
    		<link href="view/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    		<!-- Font Awesome -->
		    <link href="view/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		    <!-- NProgress -->
			<link href="view/vendors/nprogress/nprogress.css" rel="stylesheet">
			 
		   
		    <!-- Custom Theme Style -->
		    <link href="view/build/css/custom.min.css" rel="stylesheet">
				
			
			<!-- Datatables -->
		    <link href="view/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		    
		    <!-- Formwizard  -->
		    <link href="view/css/formwizard/styleformwizard.css" rel="stylesheet">
		   		

			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
        	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script type="text/javascript" src="view/vendors/table-sorter/jquery.tablesorter.js"></script> 
       		 <script src="view/js/jquery.blockUI.js"></script>
            <script src="view/js/jquery.inputmask.bundle.js"></script>
            
            <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
			<script>
			    //webshims.activeLang("en");
			    webshims.setOptions('forms-ext', { datepicker: { dateFormat: 'yy/mm/dd' } });
				webshims.polyfill('forms forms-ext');
			</script>
			
			
			     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
                 
                 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                 
                 <!-- Custom form wizard-->
                <script src="view/js/formwizard/jquery.steps.js"></script>
            	<script src="view/js/formwizard/main.js?1.3"></script>
                 
                 
                 
        
        
        
        
<script type="text/javascript">

	   $(document).ready( function (){
		   pone_espera();

			traeCategoria();
		  
		});

	   function pone_espera(){

		   $.blockUI({ 
				message: '<h4><img src="view/images/load.gif" /> Espere por favor, estamos procesando su requerimiento...</h4>',
				css: { 
		            border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff',
		           
	        		}
	    });
    	
        setTimeout($.unblockUI, 500); 
        
	   }

	  

</script>

<script type="text/javascript">
$(document).ready(function(){

	
var cedula_clientes = $("#cedula_clientes").val();
	
	$( "#cedula_clientes" ).autocomplete({

		source: "index.php?controller=Clientes&action=AutocompleteCedula",
		minLength: 4
	});

	$("#cedula_clientes").focusout(function(){
		/*para evitar que se realice el ajax*/
		if(1<0){
			if(validarcedula()){
				
    			$.ajax({
    				url:'index.php?controller=Clientes&action=AutocompleteDevuelveNombres',
    				type:'POST',
    				dataType:'json',
    				data:{cedula_clientes:$('#cedula_clientes').val()}
    			}).done(function(respuesta){
    
    				if(parseInt(respuesta.id_clientes)>0){
    					
    					$('.nav-tabs a[href="#nivel2"]').tab('show');
    					$('#id_clientes').val(respuesta.id_clientes);
    				}else{
    					 Swal.fire('cliente no se encuentra registrado');
    				}
    			
    			}).fail(function(respuesta) {
    
    				$('#id_clientes').val("");
    				
    			
    			});
			

		}else{
			Swal.fire('Ingrese un identificaci�n v�lida');
		}
	}  		
	});
	
	$("#btn_buscar").click(function(){

		/*para evitar que se realice el ajax*/
		if(1<0){
			if(validarcedula()){

			   
        			$.ajax({
        				url:'index.php?controller=Clientes&action=AutocompleteDevuelveNombres',
        				type:'POST',
        				dataType:'json',
        				data:{cedula_clientes:$('#cedula_clientes').val()}
        			}).done(function(respuesta){
        
        				if(parseInt(respuesta.id_clientes)>0){
        					
        					$('.nav-tabs a[href="#nivel2"]').tab('show');
        					$('#id_clientes').val(respuesta.id_clientes);
        				}else{
        					 Swal.fire('cliente no se encuentra registrado');
        				}
        			
        			}).fail(function(respuesta) {
        
        				$('#id_clientes').val("");
        				
        			
        			});
				

			}else{
				Swal.fire('Ingrese un identificaci�n v�lida');
			}
		}  		
	});

	$(".buscanivel2").click(function(){
		  	//console.log('funciona boton busca nivel');
		  	//console.log($(this).val());
		  	$( "#respuestanivel2" ).remove();
		  	//$('.buscanivel1').removeClass("rojo");
		  	
			$.ajax({
				url:'index.php?controller=Procesos&action=buscanivel2',
				type:'POST',
				/*dataType:'json',*/
				data:{nombre_nivel:$(this).val()}
			}).done(function(respuesta){				
				 try {
					 objeto = JSON.parse(respuesta);
					
					if(parseInt(objeto[0].id_nivel2)>0){	
						var nombre_nivel = 	objeto[0].nombre_nivel2;		
						$('#id_nivel2').val(objeto[0].id_nivel2);
						$('[value="'+nombre_nivel.toLowerCase()+'"]').after('<span id="respuestanivel2" class="glyphicon glyphicon-ok text-success"></span>');

					}

					if(objeto[0].nombre_nivel2.toLowerCase()=='personal'){
							$('.buscanivel1').addClass("btn-info");
						}
					if(objeto[0].nombre_nivel2.toLowerCase()=='corporativo'){
						$('.buscanivel1').addClass("bg-warning");
					}
                     
                     
                 }
                 catch (error) {
                     if(error instanceof SyntaxError) {
                         let mensaje = error.message;
                         console.log('ERROR EN LA SINTAXIS:', mensaje);
                     } else {
                         throw error; // si es otro error, que lo siga lanzando
                     }
                 }
				
			
			}).fail(function(respuesta) {

				$('#id_clientes').val("");
				
			
			});

				
	});

	$(".buscanivel1").click(function(){
		
	  	$( ".respuestanivel1" ).remove();
	  	//$('.buscanivel1').removeClass("rojo");
	  	
		$.ajax({
			url:'index.php?controller=Procesos&action=buscanivel1',
			type:'POST',
			/*dataType:'json',*/
			data:{nombre_nivel:$(this).val(),codigo_nivel2:$("#id_nivel2").val()}
		}).done(function(respuesta){				
			 try {
				 objeto = JSON.parse(respuesta);
				
				if(parseInt(objeto[0].id_nivel1)>0){	
					var nombre_nivel = 	objeto[0].nombre_nivel1;		
					$('#id_nivel1').val(objeto[0].id_nivel1);
					$('[value="'+nombre_nivel.toLowerCase()+'"]').after('<span id="" class="respuestanivel1 glyphicon glyphicon-ok text-success"></span>');

				}

				
                 
             }
             catch (error) {
                 if(error instanceof SyntaxError) {
                     let mensaje = error.message;
                     console.log('ERROR EN LA SINTAXIS:', mensaje);
                 } else {
                     throw error; // si es otro error, que lo siga lanzando
                 }
             }
			
		
		}).fail(function(respuesta) {

			$('#id_clientes').val("");
			
		
		});

			
});

$(".buscanivel0").click(function(){
		
	  	//console.log($(this).val());
	  	//$('.buscanivel1').removeClass("rojo");
	  	$( "#respuestanivel0" ).remove();
	  	
		if(1<0){
    		$.ajax({
    			url:'index.php?controller=Procesos&action=buscanivel0',
    			type:'POST',
    			/*dataType:'json',*/
    			data:{nombre_nivel:$(this).val()}
    		}).done(function(respuesta){				
    			 try {
    				 //console.log(respuesta);
    				 objeto = JSON.parse(respuesta);
    				
    				if(parseInt(objeto[0].id_nivel0)>0){	
    					var nombre_nivel = 	objeto[0].nombre_nivel0;		
    					$('#id_nivel0').val(objeto[0].id_nivel0);
    					$('[value="'+nombre_nivel.toLowerCase()+'"]').after('<span id="respuestanivel0" class="glyphicon glyphicon-ok text-success"></span>');
    
    				}
    
                     
                 }
                 catch (error) {
                     if(error instanceof SyntaxError) {
                         let mensaje = error.message;
                         console.log('ERROR EN LA SINTAXIS:', mensaje);
                     } else {
                         throw error; // si es otro error, que lo siga lanzando
                     }
                 }
    			
    		
    		}).fail(function(respuesta) {
    
    			$('#id_clientes').val("");
    			
    		
    		});
		}	
	});

   
	
});



function traeCategoria(){

	$.ajax({
		url:'index.php?controller=Procesos&action=TraeCategorias',
		type:'POST',
		dataType:'json',
		data:null
	}).done(function(respuesta){

		console.log(respuesta)		
		
		if(respuesta.mensaje == '1'){
			/*<div class="row">
			<div class="col-lg-4">
				<button type="button" value="corporativo" class="buscanivel2 btn btn-default btn-lg">
					<span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;&nbsp;CORPORATIVO
				</button>
			</div>
		</div>*/
		var $divprincipal = $('#dvPaso1')
		
		var $boton = '<div class="col-lg-6">'+
					'<button type="button" id="{id_categoria}" onclick="selecionacategoria(event, this)" value="{nombre_categoria}" class="clscategoria btn btn-default ">'+
					'<span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;&nbsp;{texto}'+
					'</button></div></div>';
		var $bn='';
		
    		for( i = 0; i < respuesta.detalle.length; i++) {
    
    			$bn = $boton.replace('{nombre_categoria}',respuesta.detalle[i].nombre_categorias)
    			
    			$bn = $bn.replace('{texto}',respuesta.detalle[i].nombre_categorias)
    			
    			$bn = $bn.replace('{id_categoria}',respuesta.detalle[i].id_categorias)			
    			
    			
    			$divprincipal.append($bn);
            }
		}
		
	}).fail( function( xhr , status, error ){
		 var err=xhr.responseText
		console.log(err)
	});
	
}




function selecionacategoria(e, v){

	$( "#respuestacategoria" ).remove();

	$("#"+v.id).after('<span id="respuestacategoria" class="glyphicon glyphicon-ok text-success"></span>');
		
	$("#categoriaId").val(v.id)
}


function traeSubCategoria(categoriaId=1){

	var $divprincipal = $('#dvPaso2')
	
	 $divprincipal.html('');
	
	$.ajax({
		url:'index.php?controller=Procesos&action=TraeSubCategorias',
		type:'POST',
		dataType:'json',
		data:{id_categorias:categoriaId}
	}).done(function(respuesta){

		//console.log(respuesta)		
		
		if(respuesta.mensaje == '1'){
			
		
		var $boton = '<div class="col-lg-4">'+
					'<button type="button" id="sub_{id_subcategorias}" onclick="selecionasubcategoria(event, this)" value="{nombre_subcategoria}" class="clssubcategoria btn btn-default btn-sm">'+
					'<span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;&nbsp;{texto}'+
					'</button></div></div>';
		var $bn='';
		
    		for( i = 0; i < respuesta.detalle.length; i++) {
    
    			$bn = $boton.replace('{nombre_subcategoria}',respuesta.detalle[i].nombre_subcategorias)
    			
    			$bn = $bn.replace('{texto}',respuesta.detalle[i].nombre_subcategorias)
    			
    			$bn = $bn.replace('{id_subcategorias}',respuesta.detalle[i].id_subcategorias)			
    			
    			
    			$divprincipal.append($bn);
            }
		}
		
	}).fail( function( xhr , status, error ){
		 var err=xhr.responseText
		console.log(err)
	});
	
}

function selecionasubcategoria(e, v){

	$( "#respuestasubcategoria" ).remove();

	var subcategoria = v.id;

	subcategoria = subcategoria.replace('sub_','');
		
	$("#subcategoriaId").val(subcategoria);	

	$("#"+v.id).after('<span id="respuestasubcategoria" class="glyphicon glyphicon-ok text-success"></span>');
}


</script>

			        
    </head>
    
    
    <body class="nav-md">
    
      <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
      ?>
    
    
       
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  menu_fixed">
          <div class="left_col scroll-view">
            <?php include("view/modulos/logo.php"); ?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php include("view/modulos/menu_profile.php"); ?>
            <!-- /menu profile quick info -->

            <br />
			<?php include("view/modulos/menu.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php include("view/modulos/head.php"); ?>	
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main">        
         
            <div class="container">
          
                 <!--   <section class="content-header">
                         <small><?php echo $fecha; ?></small>
                         <ol class=" pull-right breadcrumb">
                             <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                             <li class="active">Usuarios</li>
                         </ol>
                     </section> --> 
                     
                    <br>
                    <br>
                     <div class="wrapper">
                        <form action="index.php?controller=Procesos&action=generapdf1" method="post" enctype="multipart/form-data" id="wizard">
                    		<!-- SECTION 1 -->
                            <h4></h4>
                            <section>
                                <h3>CATEGORIA</h3>
                            	<div class="row" id="dvPaso1">
            								
            					</div> 
            					<input type="hidden" value="" id="categoriaId" name="categoriaId" />
            					<br>
            					<br>
                            </section>
            
            				<!-- SECTION 2 -->
                            <h4></h4>
                            <section>
                            
								<h3>SUBCATEGORIA</h3>								

								<div class="row" id="dvPaso2">
									
								</div>								
                            	                				
                				<input type="hidden" id="subcategoriaId" name="subcategoriaId" value="0" />                            	
                            	
                            </section>
            
                            <!-- SECTION 3 -->
                            <h4></h4>
                            <section>
                                <h3 di="titulonivel1" style="margin-bottom: 16px;">DATOS INFORMATIVOS</h3>
                                
                                <div class="row">
                                	<div class="col-xs-6 col-md-4 col-lg-4 ">
                                    	<div class="form-group">
                                        	<label for="numero_credito" class="control-label">Numero Credito:</label>
                                            <input type="text" class="form-control" id="numero_credito" name="numero_credito" value=""  placeholder="# credito" >
                                         </div>
                                 	</div>
                                 	<div class="col-xs-6 col-md-4 col-lg-4 ">
                                    	<div class="form-group">
                                        	<label for="identificacion_cliente" class="control-label">RUC/CC:</label>
                                            <input type="text" class="form-control" id="identificacion_cliente" name="identificacion_cliente" value=""  placeholder="ci-ruc.." >
                                         </div>
                                 	</div>
                                 	
                                 	<div class="col-xs-12 col-md-4 col-lg-4">
                        		   <div class="form-group">
                                      <label for="tipo_credito" class="control-label">Tipo Documento:</label>
                                      <select name="tipo_credito" id="tipo_credito"  class="form-control" >
                                      	<option value="0" selected="selected">--Seleccione--</option>
                                      	<option value="PAGARES" >PAGARES</option>
                                      	<option value="CREDITO" >CREDITO</option>
                                      	<option value="TRANFERENCIAS" >TRANFERENCIAS</option>
                                      	<option value="RECAUDACIONES" >RECAUDACIONES</option>
                                      	<option value="COMPROBANTES" >COMPROBANTES</option>
    								   </select>
                                    </div>
                                  </div>
                                  
                                 	
                                 </div>
                                 <div class="row">
                                 	<div class="col-xs-12 col-md-4 col-lg-4">
                                    	<div class="form-group">
                                        	<label for="nombre_cliente" class="control-label">Nombre Cliente:</label>
                                            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value=""  placeholder="Nombre" >
                                         </div>
                                 	</div>
                                 	<div class="col-xs-12 col-md-4 col-lg-4 ">
                                    	<div class="form-group">
                                        	<label for="numero_carton" class="control-label">Numero Carton:</label>
                                            <input type="text" class="form-control" id="numero_carton" name="numero_carton" value=""  placeholder="# carton" >
                                         </div>
                                 	</div>
                                 	<div class="col-xs-12 col-md-4 col-lg-4 ">
                                    	<div class="form-group">
                                        	<label for="fecha_documento" class="control-label">Fecha:</label>
                                            <input type="date" class="form-control" id="fecha_documento" name="fecha_documento" value=""  placeholder="# fecha" >
                                         </div>
                                 	</div>
                                 	
                                 	
                                </div>
                                         				
                				
                                
                            </section>
            
                            <!-- SECTION 4 -->
                            <h4></h4>
                            <section>
                                <h3>GENERAR</h3>
                                
                                <div class="row">
                                	
                                	
                                </div>
                                
                                
                                <input type="hidden" id="id_nivel0" name="id_nivel0" value="0" />
                            </section>
       					 </form>
					</div>
					
					
					<div>
					<a id="linkrespuesta" href="#">respuesta
					</a>
					</div>
            
            </div>

	</div>
	
	</div>
	</div>
	
    
     <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
       
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	<script src="view/js/jquery.inputmask.bundle.js"></script>
	<!-- codigo de las funciones -->
	
	
    
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	



 <script type="text/javascript">
 $(document).ready(function(){
	 
	 $('#identificacion_cliente').inputmask('9999999999999',{"placeholder": ""});
	 
	 $('#numero_carton').inputmask('9999999999',{"placeholder": ""});

	 $('#numero_credito').inputmask('9999999999',{"placeholder": ""});
	 
 });

 function tipodocumento(){

	 $.ajax({
			url:'index.php?controller=Procesos&action=TraeTipoDocumento',
			type:'POST',
			dataType:'json',
			data:null
		}).done(function(respuesta){

			$("#tipo_documento").empty()
        	$("#tipo_documento").append("<option value= \"0\" >--Seleccione--</option>");
        	$.each(respuesta, function(index, value) {
 		 		$("#tipo_documento").append("<option value= " +value.id_grupos +" >" + value.nombre_grupos  + "</option>");	
             });   
			
		}).fail( function( xhr , status, error ){
			 var err=xhr.responseText
			console.log(err)
		});
	  
	}
	 

 </script>
 
 




	
  </body>
</html>   