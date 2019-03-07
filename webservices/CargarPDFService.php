<?php

require_once '../core/DB_Functions.php';
$db = new DB_Functions();


  if(isset($_GET['action'])){
    
    if(isset($_GET['cargar'])){
        
        $cargar=$_GET["cargar"];
        
        if($cargar=='cargar_pdf')
        {
            
            $where_to="";
           
            $columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado , documentos_legal.monto_documentos_legal , documentos_legal.numero_credito_documentos_legal, documentos_legal.monto_documentos_legal, documentos_legal.valor_documentos_legal, archivos_pdf.archivo_archivos_pdf ";
            $tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat, public.archivos_pdf";
            $where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat AND archivos_pdf.id_documentos_legal = documentos_legal.id_documentos_legal";
            $id       = "documentos_legal.id_documentos_legal";
            
            
            $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
            $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
            
            
            if($action == 'ajax')
            {
                
                if(!empty($search)){
                    
                    $where1=" AND (cliente_proveedor.ruc_cliente_proveedor LIKE '".$search."%' OR cliente_proveedor.nombre_cliente_proveedor LIKE '".$search."%')";
                    
                    $where_to=$where.$where1;
                
                }else{
                    
                    $where_to=$where;
                    
                }
                
                $html="";
                $resultSet=$db->getCantidad("*", $tablas, $where_to);
                $cantidadResult=(int)$resultSet[0]->total;
                
                $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
                
                $per_page = 10; //la cantidad de registros que desea mostrar
                $adjacents  = 5; //brecha entre p�ginas despu�s de varios adyacentes
                $offset = ($page - 1) * $per_page;
                
                $limit = " LIMIT   '$per_page' OFFSET '$offset'";
                
                $resultSet=$db->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
                $count_query   = $cantidadResult;
                $total_pages = ceil($cantidadResult/$per_page);
                
                
                if($cantidadResult>0)
                {
                    
                    $html.='<div class="pull-left" style="margin-left:11px; margin-top:20px;">';
                    $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                    $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                    $html.='</div>';
                    $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                    $html.='<section style="height:300px; overflow-y:scroll;">';
                    $html.= "<table id='tabla_pdf' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
                    $html.= "<thead>";
                    $html.= "<tr>";
                    $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                    $html.='<th style="text-align: left;  font-size: 12px;">Cliente</th>';
                    $html.='<th style="text-align: left;  font-size: 12px;"># Cartón</th>';
                    $html.='<th style="text-align: left;  font-size: 12px;"># Crédito</th>';
                    $html.='</tr>';
                    $html.='</thead>';
                    $html.='<tbody>';
                    
                   
                    
                    foreach ($resultSet as $res)
                    {
                     
                        $archivo_archivos_pdf = $res->archivo_archivos_pdf;
                        //$foto=pg_unescape_bytea($archivo_archivos_pdf);
                        
                        
                        $html.='<tr>';
                       // $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="" onclick="window.plugins.childBrowser.showWebPage(encodeURI("http://docs.google.com/viewer?url=' + pdfLink + '"))" class="btn btn-warning" style="font-size:65%;"><i class="glyphicon glyphicon-eye-open"></i></a></span></td>';
                        $html.='<td style="font-size: 18px;"><span class="pull-right"><a href="http://192.168.1.121:4000/demo_feria/view/DevuelvePDFView.php?id_documentos_legal='.$res->id_documentos_legal.'" target="_blank" class="btn btn-info" style="font-size:45%;"><i class="glyphicon glyphicon-print"></i></a></span></td>';
                        $html.='<td style="font-size: 11px;">'.$res->nombre_cliente_proveedor.'</td>';
                        $html.='<td style="font-size: 11px;">'.$res->numero_carton_documentos.'</td>';
                        $html.='<td style="font-size: 11px;">'.$res->numero_credito_documentos_legal.'</td>';
                        
                        $html.='</tr>';
                    }
                    
                    
                    $html.='</tbody>';
                    $html.='</table>';
                    $html.='</section></div>';
                    $html.='<div class="table-pagination pull-right">';
                    $html.=''. $db->paginate("index.php", $page, $total_pages, $adjacents).'';
                    $html.='</div>';
                    
                    
                    
                }else{
                    $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
                    $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                    $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay documentos registrados...</b>';
                    $html.='</div>';
                    $html.='</div>';
                }
                
                
                
                
               // $resultadosJson = json_encode($html);
                
              
                
                echo $_GET['jsoncallback'] . $html;
                
            }
            
            
        }
        
        
        
        
        
        if($cargar=="cargar_pdf1"){

            $archivo_archivos_pdf="";
            $archivo_archivos_pdf1="";
            
            $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
            $id =  (isset($_REQUEST['id'])&& $_REQUEST['id'] !=NULL)?$_REQUEST['id']:0;
            
            
            
            $resultClientes= $db->getBy("archivos_pdf", "id_documentos_legal='$id'");
            $archivo_archivos_pdf=$resultClientes[0]->archivo_archivos_pdf;
            
            $archivo_archivos_pdf1=base64_encode(pg_unescape_bytea($archivo_archivos_pdf));
            //$imgficha='data:application/pdf;base64,'.$archivo_archivos_pdf1;
            
            $imgficha=$archivo_archivos_pdf1;
            
            if($action == 'ajax')
            {    
                echo $_GET['jsoncallback'] . $imgficha;
                
            }
            
            
            
            
            
        }
        
        
    }
    
    
}





	
?>