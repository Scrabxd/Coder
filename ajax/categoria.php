<?php
require_once "../modelos/Categoria.php"

$categoria = new Categoria();

$idcategoria = isset($_POST["idcategoria"])?:limpiarCadena($_POST["idcategoria"]):"";
$nombre = isset($_POST["nombre"])?:limpiarCadena($_POST["nombre"]):"";
$descripcion = isset($_POST["descripcion"])?:limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar';
        if (empty($idcategoria)){
            $rspta = $categoria ->insertar($nombre,$descripcion);
            echo $rspta ? "Categoria Registrada!" : "Categoria No se pudo registrar";
        }
        else{
            $rspta = $categoria ->editar($idcategoria,$nombre,$descripcion);
            echo $rspta ? "Categoria actualizada!" : "Categoria No se pudo actualizar";
        }
    break;
    
    case 'desactivar';
        $rspta = $categoria -> desactivar($idcategoria);
        echo $rspta ? "Categoria desactivada" : "Categoria no se puede desactivar"
    break;

    case 'activar';
        $rspta = $categoria -> activar($idcategoria);
        echo $rspta ? "Categoria activada" : "Categoria no se puede activar"
    break;

    case 'mostrar';
        $rspta = $categoria -> mostrar($idcategoria);
        echo json_encode($rspta);
    break;

    case 'listar';
        $rspta = $categoria -> listar();
        $data = Array();

        while ($reg=$rspta-> fetch_object()){
            $data[] = Array(
                "0" =>$reg->idcategoria,
                "1" =>$reg->nombre,
                "2" =>$reg->descripcion,
                "3" =>$reg->condicion
            );
        }
        $results = Array(
            "sEcho" => 1,
            "iTotalRecords"=> count($data),
            "iTotalDisplayRecords" =>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        
    break;
}

?>