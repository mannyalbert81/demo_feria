<?php

class ProcesosExportacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
	    $exportacion=new ProcesosExportacionModel();
					//Conseguimos todos los usuarios
     	$resultSet=$exportacion->getAll("id_procesos_exportacion");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "ProcesosExportacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $exportacion->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_procesos_exportacion"])   )
				{

					$nombre_controladores = "ProcesosExportacion";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $exportacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					    $_id_procesos_exportacion = $_GET["id_procesos_exportacion"];
						
						$columnas = " procesos_exportacion.id_procesos_exportacion, 
                                      procesos_exportacion.cantidad_imagenes_procesos_exportacion, 
                                      procesos_exportacion.cantidad_indices_procesos_exportacion, 
                                      procesos_exportacion.creado, 
                                      procesos_exportacion.modificado ";
						$tablas   = "public.procesos_exportacion";
						$where    = "id_procesos_exportacion = '$_id_procesos_exportacion' "; 
						$id       = "id_procesos_exportacion";
							
						$resultEdit = $exportacion->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Procesos Exportacion"
					
						));
					
					
					}
					
				}
		
				
				$this->view("ProcesosExportacion",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Procesos Exportacion"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaProcesosExportacion(){
			
		session_start();
		$exportacion=new ProcesosExportacionModel();

		$nombre_controladores = "ProcesosExportacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $exportacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$exportacion=new ProcesosExportacionModel();
		
			if (isset ($_POST["cantidad_imagenes_procesos_exportacion"])   )
			{
			    $_id_procesos_exportacion =  $_POST["id_procesos_exportacion"];
			    $_cantidad_imagenes_procesos_exportacion = $_POST["cantidad_imagenes_procesos_exportacion"];
			    $_cantidad_indices_procesos_exportacion= $_POST["cantidad_indices_procesos_exportacion"];
				
			    if($_id_procesos_exportacion> 0){
					
					$columnas = " cantidad_imagenes_procesos_exportacion = '$_cantidad_imagenes_procesos_exportacion',
                                  cantidad_indices_procesos_exportacion = '$_cantidad_indices_procesos_exportacion'";
					$tabla = "procesos_exportacion";
					$where = "id_procesos_exportacion = '$_id_procesos_exportacion'";
					$resultado=$exportacion->UpdateBy($columnas, $tabla, $where);
					
				}else{
					
					$funcion = "ins_procesos_exportacion";
					$parametros = " '$_cantidad_imagenes_procesos_exportacion', '$_cantidad_indices_procesos_exportacion'";
					$exportacion->setFuncion($funcion);
					$exportacion->setParametros($parametros);
					$resultado=$exportacion->Insert();
				}
				
				
				
		
			}
			$this->redirect("ProcesosExportacion", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Procesos Exportacion"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		$exportacion=new ProcesosExportacionModel();
		$nombre_controladores = "ProcesosExportacion";
		$id_rol= $_SESSION['id_procesos_exportacion'];
		$resultPer = $exportacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_procesos_exportacion"]))
			{
			    $_id_procesos_exportacion=(int)$_GET["id_procesos_exportacion"];
				
			    $exportacion->deleteBy("id_procesos_exportacion",$_id_procesos_exportacion);
				
				
			}
			
			$this->redirect("ProcesosExportacion", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Roles"
			
			));
		}
				
	}
	
	
	
	public function carga_cantidad_archivos_procesados(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    $i=0;
	    $usuarios = new UsuariosModel();
	    
	    $resultSet = $usuarios->getCondiciones("*" ,"public.procesos_exportacion" ,"1=1","id_procesos_exportacion");
	    
	    $cantidad_imagenes_procesos=0;
	    $cantidad_indices_procesos=0;
	    
	    
	    if(!empty($resultSet)){
	        if(is_array($resultSet)){
	            
	            $cantidad_indices_procesos=$resultSet[0]->cantidad_indices_procesos_exportacion;
	        }
	    }
	    
	    $html="";
	    if($cantidad_indices_procesos>0){
	        $html .= "<div class='col-lg-3 col-xs-12'>";
	        $html .= "<div class='small-box bg-gray'>";
	        $html .= "<div class='inner'>";
	        $html .= "<h3>$cantidad_indices_procesos</h3>";
	        $html .= "<p>Cantidad Procesos</p>";
	        $html .= "</div>";
	        
	        
	        $html .= "<div class='icon'>";
	        $html .= "<i class='ion ion-ios-albums'></i>";
	        $html .= "</div>";
	        
	        if($id_rol==1){
	            
	            $html .= "<a href='index.php?controller=ProcesosExportacion&action=index' class='small-box-footer'>Ver Detalles <i class='fa fa-arrow-circle-right'></i></a>";
	            
	        }else{
	            $html .= "<a href='#' class='small-box-footer'>Ver detalles <i class='fa fa-arrow-circle-right'></i></a>";
	            
	        }
	        
	        $html .= "</div>";
	        $html .= "</div>";
	    }else{
	        
	        $html = "<b>Cantidad Procesos: 0</b>";
	    }
	    
	    echo $html;
	    
	    //cantidad_imagenes_procesos_exportacion
	    
	    //cantidad_indices_procesos_exportacion
	    
	}
	
	public function carga_cantidad_imagenes_procesados(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    $i=0;
	    $usuarios = new UsuariosModel();
	    
	    $resultSet = $usuarios->getCondiciones("*" ,"public.procesos_exportacion" ,"1=1","id_procesos_exportacion");
	    
	    $cantidad_imagenes_procesos=0;
	    $cantidad_indices_procesos=0;
	    
	    
	    if(!empty($resultSet)){
	        if(is_array($resultSet)){
	            
	            $cantidad_imagenes_procesos=$resultSet[0]->cantidad_imagenes_procesos_exportacion;
	        }
	    }
	    
	    $html="";
	    if($cantidad_imagenes_procesos>0){
	        $html .= "<div class='col-lg-3 col-xs-12'>";
	        $html .= "<div class='small-box bg-maroon'>";
	        $html .= "<div class='inner'>";
	        $html .= "<h3>$cantidad_imagenes_procesos</h3>";
	        $html .= "<p>Cantidad Imagenes Procesadas</p>";
	        $html .= "</div>";
	        
	        
	        $html .= "<div class='icon'>";
	        $html .= "<i class='ion ion-ios-camera'></i>";
	        $html .= "</div>";
	        
	        if($id_rol==1){
	            
	            $html .= "<a href='index.php?controller=ProcesosExportacion&action=index' class='small-box-footer'>Ver Detalles <i class='fa fa-arrow-circle-right'></i></a>";
	            
	        }else{
	            $html .= "<a href='#' class='small-box-footer'>Ver detalles <i class='fa fa-arrow-circle-right'></i></a>";
	            
	        }
	        
	        $html .= "</div>";
	        $html .= "</div>";
	    }else{
	        
	        $html = "<b>Cantidad Procesos: 0</b>";
	    }
	    
	    echo $html;
	    
	    //cantidad_imagenes_procesos_exportacion
	    
	    //cantidad_indices_procesos_exportacion
	    
	}
	
	
	
	
}
?>