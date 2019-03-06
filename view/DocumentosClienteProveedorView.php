<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Busqueda</title>

		
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
		    
		    
		    
		    
		    
		
		
		
		
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		   
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		 
		  <link rel="stylesheet" href="/resources/demos/style.css">
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="view/css/jquery-ui.js"></script>
        
 
 		
		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
 		
			  
		<script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#categorias").change(function() {

               // obtenemos el combo de subcategorias
                var $subcategorias = $("#subcategorias");
               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_categorias = $(this).val();


               $subcategorias.empty();

               $subcategorias.append("<option value= " +"0" +" > --TODOS--</option>");
           
               if(id_categorias > 0)
               {
            	   var datos = {
            			   id_categorias : $(this).val()
                   };


            	   $.post("<?php echo $helper->url("subCategorias","devuelveSubcategorias"); ?>", datos, function(resultSub) {

            		 		$.each(resultSub, function(index, value) {
               		 	    $subcategorias.append("<option value= " +value.id_subcategorias +" >" + value.nombre_subcategorias  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	   $.post("<?php echo $helper->url("subCategorias","devuelveAllSubcategorias"); ?>", datos, function(resultSub) {

   		 		        $.each(resultSub, function(index, value) {
          		 	    $subcategorias.append("<option value= " +value.id_subcategorias +" >" + value.nombre_subcategorias  + "</option>");	
                	  });
     		  		}, 'json');

               }
               
		    });
    
		}); 

	</script>
		
	<script>

		$(document).ready(function(){

			$("#subcategorias").change(function() {

	               // obtenemos el combo de categorias
	                var $categorias = $("#categorias");
	               
					///obtengo el id seleccionado
					var id_subcategorias = $(this).val();

	               if(id_subcategorias > 0)

	               {
	            	   var datos = {
	            			   id_subcategorias : $(this).val()
	                   };


	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
	                   $.post("<?php echo $helper->url("subCategorias","devuelveSubBySubcategorias"); ?>", datos, function(resultSub) {
	            		   
         		 		  $.each(resultSub, function(index, value) {

         		 			 $('#categorias').val( value.id_categorias );//To select Blue	 
         		 			//$("'#categorias > option[value="+value.id_categorias"+"]').attr('selected', 'selected'");
								
							 });

         		 		 	 		   
         		  		}, 'json');
	                   
	               }
	               else
	               {

	          		 $('#categorias').val( 0 );//To select Blue

			        }
	               
	               
			    });
		}); 

	</script>
		

	<script>

		$(document).ready(function(){

		    $("#ruc_cliente_proveedor").change(function() {

		    	///obtengo el id seleccionado
				var id_cliente_proveedor = $(this).val();

	               if(id_cliente_proveedor > 0)
	               {
         		 		$('#nombre_cliente_proveedor').val( id_cliente_proveedor );//To select Blue	 
         		   }
	               else
	               {
	            		$('#nombre_cliente_proveedor').val( 0 );//To select Blue
			       }
	               
			    });

		}); 

	</script>
		
		
    <script>

		$(document).ready(function(){

		    $("#nombre_cliente_proveedor").change(function() {

	               
					///obtengo el id seleccionado
					var id_cliente_proveedor = $(this).val();

	               if(id_cliente_proveedor > 0)

	               {
         		 		$('#ruc_cliente_proveedor').val( id_cliente_proveedor );//To select Blue	 
         		   }
	               else
	               {
	            		$('#ruc_cliente_proveedor').val( 0 );//To select Blue
			       }
	               
			    });

		}); 

	</script>		
	
	<script>

		$(document).ready(function(){

		    $("#fecha_documento_hasta").change(function() {


		    	var startDate = new Date($('#fecha_documento_desde').val());
		    	var endDate = new Date($('#fecha_documento_hasta').val());

		    	if (startDate > endDate){

		    		$("#fecha_documento_hasta").val("");
		    		alert('Fecha documento DESDE mayor a  fecha FINAL');
		    	}


		    	
			  });

		}); 

	</script>
		

	
	<script>

		$(document).ready(function(){

		    $("#fecha_poliza_hasta").change(function() {


		    	var startDate = new Date($('#fecha_poliza_desde').val());
		    	var endDate = new Date($('#fecha_poliza_hasta').val());

		    	if (startDate > endDate){
		    		$("#fecha_poliza_hasta").val("");
		    		alert('Fecha poliza DESDE mayor a  fecha FINAL');
		    	}
			  });
		}); 

	</script>
	
	

	<script>

		$(document).ready(function(){

		    $("#fecha_subida_hasta").change(function() {


		    	var startDate = new Date($('#fecha_subida_desde').val());
		    	var endDate = new Date($('#fecha_subida_hasta').val());

		    	if (startDate > endDate){
		    		$("#fecha_subida_hasta").val("");

		    		alert('Fecha subida DESDE mayor a  fecha FINAL');
		    	}
			  });
		}); 

	</script>
	
	

		
		
		
		
		
     <script>
			function myFunction() {
			    var x = document.getElementById("categorias").value;
                    var subcategorias = document.getElementById("subcategorias");
                    $subcategorias.Empty();
				    document.getElementById("demo").innerHTML = "You selected: " + x;
			}
		</script>
       
   <script type="text/javascript">
	$(document).ready(function(){
		
		$("#btnBuscar").click(function(){
			
			load_DocumentosClienteProv(1);
			});
	});

	
	function load_DocumentosClienteProv(pagina){

		
		//iniciar variables
		 var doc_categorias=$("#categorias").val();
		 var doc_subcategorias=$("#subcategorias").val();
		 var doc_ruc_cli=$("#ruc_cliente_proveedor").val();
		 var doc_nombre_cli=$("#nombre_cliente_proveedor").val();
		 var doc_fecha_doc_desde=$("#fecha_documento_desde").val();
		 var doc_fecha_doc_hasta=$("#fecha_documento_hasta").val();
		 var doc_fecha_subida_desde=$("#fecha_subida_desde").val();
		 var doc_fecha_subida_hasta=$("#fecha_subida_hasta").val();
		 var doc_year=$("#year").val();

		 
		 	
		  var con_datos={
				  categorias:doc_categorias,
				  subcategorias:doc_subcategorias,
				  ruc_cliente_proveedor:doc_ruc_cli,
				  nombre_cliente_proveedor:doc_nombre_cli,
				  fecha_documento_desde:doc_fecha_doc_desde,
				  fecha_documento_hasta:doc_fecha_doc_hasta,
				  fecha_subida_desde:doc_fecha_subida_desde,
				  fecha_subida_hasta:doc_fecha_subida_hasta,
				  year:doc_year,
				  action:'ajax',
				  page:pagina
				  };


		$("#DocumentosClienteProv").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("DocumentosClienteProveedor","buscar");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#DocumentosClienteProv").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".DocumentosClienteProv").html(data).fadeIn('slow');
				$("#DocumentosClienteProv").html("");
			}
		})
	}
	
	</script>
	
	 <script>
	$(document).ready(function(){
 	
	$("#txt_nombre_cliente_proveedor").autocomplete({
		source: "<?php echo $helper->url("DocumentosClienteProveedor","AutocompleteNombreCliente"); ?>",
		minLength: 1,
		select: function( event, data ) 
			{
			 var respueta = data.item.id;
			 var res = respueta.split(',');
			 
			 $("#nombre_cliente_proveedor").val(res[0]);
			 $("#ruc_cliente_proveedor").val(res[0]);
			 
             $("#txt_nombre_cliente_proveedor").val(data.item.value);
             $("#txt_ruc_cliente_proveedor").val(res[1]);
	            //alert(data);
			}
	 });
		
	$("#txt_nombre_cliente_proveedor").focusout(function(){

		if($("#txt_nombre_cliente_proveedor").val()==''||$("#txt_nombre_cliente_proveedor").val()==null)
		{
			 $("#nombre_cliente_proveedor").val(0);
			 $("#ruc_cliente_proveedor").val(0);
			 $("#txt_nombre_cliente_proveedor").val('');
	         $("#txt_ruc_cliente_proveedor").val('');
			 
		}
						
	});
						
	});
		
					
    </script>
    
    <script>
	$(document).ready(function(){
 	
	$("#txt_ruc_cliente_proveedor").autocomplete({
		source: "<?php echo $helper->url("DocumentosClienteProveedor","AutocompleteRucCliente"); ?>",
		minLength: 1,
		select: function( event, data ) 
		{
		 var respueta = data.item.id;
		 var res = respueta.split(',');
		 
		 $("#nombre_cliente_proveedor").val(res[0]);
		 $("#ruc_cliente_proveedor").val(res[0]);
		 
         $("#txt_nombre_cliente_proveedor").val(res[1]);
         $("#txt_ruc_cliente_proveedor").val(data.item.value);
            //alert(data);
		}
	 });
		
	$("#txt_ruc_cliente_proveedor").focusout(function(){

		if($("#txt_ruc_cliente_proveedor").val()==''||$("#txt_ruc_cliente_proveedor").val()==null)
		{
			 $("#nombre_cliente_proveedor").val(0);
			 $("#ruc_cliente_proveedor").val(0);
			 $("#txt_nombre_cliente_proveedor").val('');
	         $("#txt_ruc_cliente_proveedor").val('');
	            //alert(data);
			 
		}
						
	});
	});
		
					
    </script>
       
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
        
        
       
    
        
			        
    </head>
    
    
    <body class="nav-md"  >
    
    
     <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    <div class="container body">
    
     <?php
   
		   $sel_categorias = 0;
		   $sel_subcategorias = 0;
		   $sel_year = 0;
		   $sel_cliente_proveedor = 0;
		   //$sel_tipo_documentos = 0;
		   //$sel_carton_documentos = 0;
		   //$sel_numero_poliza = 0;
		   //$sel_cierre_ventas_soat = 0; 
		   $sel_fecha_documento_desde = "";
		   $sel_fecha_documento_hasta = "";
		   $sel_fecha_subida_desde = "";
		   $sel_fecha_subida_hasta = "";
		   
		   if($_SERVER['REQUEST_METHOD']=='POST' )
		   {
		      $sel_categorias = $_POST['categorias'];
		      $sel_subcategorias = $_POST['subcategorias'];
		      $sel_year = $_POST['year'];
		      $sel_cliente_proveedor = $_POST['nombre_cliente_proveedor'];
		      //$sel_tipo_documentos = $_POST['tipo_documentos'];
		      //$sel_carton_documentos = $_POST['carton_documentos'];
		      //$sel_numero_poliza = $_POST['numero_poliza'];
		      //$sel_cierre_ventas_soat = $_POST['cierre_ventas_soat'];
		      $sel_fecha_documento_desde = $_POST['fecha_documento_desde'];
		      $sel_fecha_documento_hasta = $_POST['fecha_documento_hasta'];
		      $sel_fecha_subida_desde = $_POST['fecha_subida_desde'];
		      $sel_fecha_subida_hasta = $_POST['fecha_subida_hasta'];
		      
		
		   }
		   
		?>
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
            <?php
       $sel_menu = "";
       
    
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       	 
       	$sel_menu=$_POST['criterio'];
       	
       	 
       }
      
	 	?>
    <div class="container">
  <section class="content-header">
         <small><?php echo $fecha; ?></small>
         <ol class=" pull-right breadcrumb">
         <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Busqueda</li>
         </ol>
         </section>
  
		
  
         	<table class="table">     	
            	
            <tr>
	    		<th class="col-sm-2">Nombre Categoria</th>
	    		<th class="col-sm-2">Nombre SubCategoria</th>
	    		<th class="col-sm-2">Periodo</th>
	    		<th class="col-sm-2">Ruc Cliente/Proveedor</th>
	    		<th class="col-sm-2">Nombre Cliente/Proveedor</th>
	    	
	  		</tr>
            <tr>
	            <td>
	            <select name="categorias" id="categorias"  class="form-control"   >
	                <option value="0"  > --TODOS--</option>
			    	 <?php foreach($resultCat as $resCat) {?>
					 		<?php if ($sel_categorias > 0){?>
					 			<option value="<?php echo $resCat->id_categorias; ?>"  <?php if ($resCat->id_categorias == $sel_categorias) {echo "selected"; }  ?>     > <?php echo $resCat->nombre_categorias; ?> </option>
					 		
					 		<?php  } else { ?>
					 			
					 			<option value="<?php echo $resCat->id_categorias; ?>"  > <?php echo $resCat->nombre_categorias; ?> </option>
					 		
					 		<?php }  ?>
	 		
				 	 <?php } ?>
				</select>
						        
				</td>				  
		
				<td>	       		
		          <select name="subcategorias" id="subcategorias"  class="form-control">
							<option value="0"  > --TODOS--</option>
				        <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
				        	<?php foreach($resultSub as $resSub) {?>
								<option value="<?php echo $resSub->id_subcategorias; ?>" <?php if ($resSub->id_subcategorias == $resEdit->id_subcategorias )  echo  ' selected="selected" '  ;  ?> ><?php echo $resSub->nombre_subcategorias; ?> </option>
						    <?php } ?>
					   		    
	     			     <?php } } else {?>
			
				    	 <?php foreach($resultSub as $resSub) {?>
					 		<?php if ($sel_subcategorias > 0){?>
					 				<option value="<?php echo $resSub->id_subcategorias;?>"  <?php if ($resSub->id_subcategorias == $sel_subcategorias) {echo "selected"; }  ?>     > <?php echo $resSub->nombre_subcategorias; ?> </option>
					 			<?php  } else { ?>
					 				<option value="<?php echo $resSub->id_subcategorias;?>" > <?php echo $resSub->nombre_subcategorias; ?> </option>
					 			<?php }  ?>
	 				 	 	<?php } ?>
						<?php } ?>
					</select>
		   		</td>
		
				<td>	       		
		          <select name="year" id="year"  class="form-control">
							<option value="0"  > --TODOS--</option>
				        <?php ?>
				        <?php for($i = date ("Y") ; $i > 1899 ; $i --) {?>
				         	<?php if ($sel_year > 0){?>
				         			<option value="<?php echo $i; ?>" <?php if ($i == $sel_year) {echo "selected"; }  ?>  ><?php echo $i; ?> </option>
				         		<?php  } else { ?>
				         			<option value="<?php echo $i; ?>" ><?php echo $i; ?> </option>
						    	<?php }  ?>
						    <?php } ?>
					   		    
	     			     		</select>
		   		</td>
		
		   		<td>
		   		<input type="hidden"  id="ruc_cliente_proveedor" name="ruc_cliente_proveedor" value="0">
                 	  
		   		
		   		 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
					        	<?php foreach($resultCli as $resCli) {?>
										<input type="text" class="form-control" id="txt_ruc_cliente_proveedor" name="txt_ruc_cliente_proveedor" value="<?php if ($resCli->id_cliente_proveedor == $resEdit->id_cliente_proveedor )  echo  $resCli->ruc_cliente_proveedor; ?>">
                 			  <?php } ?>
					     <?php } } else {?>
					     
					     <input type="text" class="form-control" id="txt_ruc_cliente_proveedor" name="txt_ruc_cliente_proveedor" value=""  placeholder="Ingrese Ruc Cliente">
                 		  									
						 <?php } ?>
						      		
           	 		
           		</td>
		
		   		<td>
		   		    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
					       	<?php foreach($resultCli as $resCli) {?>
					       	<input type="text" class="form-control" id="txt_nombre_cliente_proveedor" name="txt_nombre_cliente_proveedor" value="<?php if ($resCli->id_cliente_proveedor == $resEdit->id_cliente_proveedor )  echo  $resCli->nombre_cliente_proveedor; ?>">
                 			
						   <?php } ?>
						  <?php } } else {?>	
						  					 
						  <input type="text" class="form-control" id="txt_nombre_cliente_proveedor" name="txt_nombre_cliente_proveedor" value=""  placeholder="Ingrese nombre Cliente">
                 		  
						 <?php } ?>
				         <input type="hidden"  id="nombre_cliente_proveedor" name="nombre_cliente_proveedor" value="0">		 
					 
					<?php unset($resultCli);
						  unset($resCli);?>
		   		</td>
		
		   	   		
		   	</tr>
		
			
        </table>
          
      	<table class="table">
      
      
            <tr>
	    		
	    		<th class="col-sm-3">Fecha Documento Desde</th>
	    		<th class="col-sm-3">Fecha Documento Hasta</th>
	    		<th class="col-sm-3">Fecha Subida Desde</th>
	    		<th class="col-sm-3">Fecha Subida Hasta</th>
	    		<th class="col-sm-2"></th>
	    		
	    	
	  		</tr>
            
                <tr>
            
            	
            	<td>
            	
            	  <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
						
				 <input type="date" name="fecha_documento_desde" id="fecha_documento_desde"  class="form-control"  value="<?php echo  date('d/m/Y', strtotime($resEdit->fecha_documentos_legal));  ?>"     /> 	
						    
				  <?php } } else {?>
				   	 <?php if ($sel_fecha_subida_desde == "" ) { ?>	
				   		<input type="date" name="fecha_documento_desde" id="fecha_documento_desde"  class="form-control"   />
					 <?php } else {?>	
					 	<input type="date" value="<?php echo $sel_fecha_documento_desde ?>"  name="fecha_documento_desde" id="fecha_documento_desde"   class="form-control"   />
					 <?php }?>        
				  <?php } ?>
		
            	
		   			
		   		</td>
		   		<td>
		   			<?php if ($sel_fecha_subida_desde == "" ) { ?>	
				   		<input type="date" name="fecha_documento_hasta"  id="fecha_documento_hasta"  class="form-control"  />
					 <?php } else {?>	
					 	<input type="date" value="<?php echo $sel_fecha_documento_hasta ?>"  name="fecha_documento_hasta" id="fecha_documento_hasta"   class="form-control"   />
					 <?php }?>        
		   			
		   			
		   		</td>
		   		
		   		
		   		<td>
				   <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
						
						<input type="date" name="fecha_subida_desde" id="fecha_subida_desde"  class="form-control"   value="<?php echo date('d/m/Y', strtotime($resEdit->creado));   ?>"     /> 	
						    
				     <?php } } else {?>
				   		
				   			<?php if ($sel_fecha_subida_desde == "" ) { ?>	
						   		<input type="date" name="fecha_subida_desde"  id="fecha_subida_desde"  class="form-control"  />
							 <?php } else {?>	
							 	<input type="date" value="<?php echo $sel_fecha_subida_desde ?>"  name="fecha_subida_desde" id="fecha_subida_desde"   class="form-control"   />
							 <?php }?>        
				   			
		   			                
				    <?php } ?>
		
		   		</td>
		   		<td>
		   			<?php if ($sel_fecha_subida_hasta == "" ) { ?>	
						   		<input type="date" name="fecha_subida_hasta"  id="fecha_subida_hasta"  class="form-control"  />
							 <?php } else {?>	
							 	<input type="date" value="<?php echo $sel_fecha_subida_hasta ?>"  name="fecha_subida_hasta" id="fecha_subida_hasta"   class="form-control"   />
							 <?php }?>        
				   			
		   		</td>
		
		
		   		
		   		
		   		   		
		   		
		   		
		   		<td>  	
		        	<?php if ($resultEdit !="" ) { ?>
		  	  			<input type="submit" value="Guardar" id="btnGuardar" name="btnGuardar" class="btn btn-success"/>
  	                <?php } else {?>
  	                	<input type="button" value="Buscar" id="btnBuscar" name="btnBuscar" class="btn btn-info"/>
  	                <?php } ?>
		        	
		        	
		        	
		        	
				</td>
			</tr>
      
      
      	</table>
      	
      	
      	
      	   <div style="height: 20px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div >					
					<div id="DocumentosClienteProv" style="text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="DocumentosClienteProv" ></div><!-- Datos ajax Final -->
		      </div>
		       <br>
				  
		 </div>
      </div>
      
      
    </div>
    
       
     

</div>

</div>



     <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    
    
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
   
   
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    
    
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    
    
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	<script src="view/js/jquery.inputmask.bundle.js"></script>
	<!-- codigo de las funciones -->




        <script type="text/javascript">
	$(document).ready(function(){
		
		$("#btnBuscar").click(function(){

			
			load_DocumentosClienteProv(1);
			});
	});

	
	function load_DocumentosClienteProv(pagina){


	
		//iniciar variables
		 var doc_categorias=$("#categorias").val();
		 var doc_subcategorias=$("#subcategorias").val();
		 var doc_ruc_cli=$("#ruc_cliente_proveedor").val();
		 var doc_nombre_cli=$("#nombre_cliente_proveedor").val();
		 var doc_fecha_doc_desde=$("#fecha_documento_desde").val();
		 var doc_fecha_doc_hasta=$("#fecha_documento_hasta").val();
		 var doc_fecha_subida_desde=$("#fecha_subida_desde").val();
		 var doc_fecha_subida_hasta=$("#fecha_subida_hasta").val();
		 var doc_year=$("#year").val();

		 
		 	
		  var con_datos={
				  categorias:doc_categorias,
				  subcategorias:doc_subcategorias,
				  ruc_cliente_proveedor:doc_ruc_cli,
				  nombre_cliente_proveedor:doc_nombre_cli,
				  fecha_documento_desde:doc_fecha_doc_desde,
				  fecha_documento_hasta:doc_fecha_doc_hasta,
				  fecha_subida_desde:doc_fecha_subida_desde,
				  fecha_subida_hasta:doc_fecha_subida_hasta,
				  year:doc_year,
				  action:'ajax',
				  page:pagina
				  };


		$("#DocumentosClienteProv").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("DocumentosClienteProveedor","buscar");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#DocumentosClienteProv").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".DocumentosClienteProv").html(data).fadeIn('slow');
				$("#DocumentosClienteProv").html("");
			}
		})
	}
	
	</script>
    
	
  
 

	
  </body>
</html>   




