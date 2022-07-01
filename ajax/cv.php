<?php
require_once "../modelos/cv.php";

$cv = new cv();

$idjob = isset($_POST["idjob"])? limpiarCadena($_POST["idjob"]):"";
$trabajo = isset($_POST["trabajo"])? limpiarCadena($_POST["trabajo"]):"";
$descripcion = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar2';
        if (empty($idjob)){
            $rspta = $cv ->insertar2($nombre,$descripcion);
            echo $rspta ? "Categoria Registrada!" : "Categoria No se pudo registrar";
        }
        else{
            $rspta = $cv ->editar($idjob,$nombre,$descripcion);
            echo $rspta ? "Categoria actualizada!" : "Categoria No se pudo actualizar";
        }
    break;
    
    case 'desactivar2':
        $rspta = $cv -> desactivar2($idjob);
        echo $rspta ? "Categoria desactivada" : "Categoria no se puede desactivar";
    break;

    case 'activar2':
        $rspta = $cv -> activar2($idjob);
        echo $rspta ? "Categoria activada" : "Categoria no se puede activar";
    break;

    case 'mostrar2':
        $rspta = $cv -> mostrar2($idjob);
        echo json_encode($rspta);
    break;

    case 'listar2':
        $rspta = $cv -> listar2();
        $data = Array();    

        while ($reg=$rspta -> fetch_object()){
            
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar2('.$reg->idjob.')"><i class="fa fa-edit"></i></button>',                
                "1" =>$reg->trabajo,
                "2" =>$reg->descripcion,
                "3" =>$reg->inicio,
                "4" =>$reg->fin,

            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);
        
    break;
}

?>