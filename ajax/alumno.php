<?php 
session_start();
require_once "../modelos/alumno.php";

$alumno=new alumno();

$id_al=isset($_POST["id_al"])? limpiarCadena($_POST["id_al"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apodo=isset($_POST["apodo"])? limpiarCadena($_POST["apodo"]):"";
$tel=isset($_POST["tel"])? limpiarCadena($_POST["tel"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$foto=isset($_POST["foto"])? limpiarCadena($_POST["foto"]):"";
$nacimiento=isset($_POST["nacimiento"])? limpiarCadena($_POST["nacimiento"]):"";
$lic=isset($_POST["lic"])? limpiarCadena($_POST["lic"]):"";
$maes=isset($_POST["maes"])? limpiarCadena($_POST["maes"]):"";
$doc=isset($_POST["doc"])? limpiarCadena($_POST["doc"]):"";
$resumen=isset($_POST["resumen"])? limpiarCadena($_POST["resumen"]):"";
$pass=isset($_POST["pass"])? limpiarCadena($_POST["pass"]):"";
$fk_carr=isset($_POST["fk_carr"])? limpiarCadena($_POST["fk_carr"]):"";
$fk_duracion=isset($_POST["fk_duracion"])? limpiarCadena($_POST["fk_duracion"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar1':

       
		if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name']))
		{
			$foto=$_POST["ia5"];
		}
		else 
		{
			$ext = explode(".", $_FILES["foto"]["name"]);
			if ($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png")
			{
				$foto = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["foto"]["tmp_name"], "../stuff/sitio/" . $foto);
			}
		}
		
		if (empty($id_al)){
			$rspta=$alumno->insertar1($nombre, $apodo, $tel, $correo, $foto, $nacimiento,$lic,$maes, $doc, $resumen, $pass, $fk_carr, $fk_duracion);
			echo $rspta ? "Imagen alumno registrado" : "Imagen alumno no se pudo registrar";
		}
		else {
			$rspta=$alumno->editar1($id_al,$nombre, $apodo, $tel, $correo, $foto, $nacimiento,$lic,$maes, $doc, $resumen, $pass, $fk_carr, $fk_duracion);
			echo $rspta ? "Imagen alumno actualizado" : "Imagen alumno no se pudo actualizar";
		}
	break;

	case 'mostrar1':
		$rspta=$alumno->mostrar1($id_al);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar1':
		$rspta=$alumno->listar1();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar1('.$reg->id_al.')"><i class="fas fa-pencil-alt"></i></button>',
 			    "1"=>$reg->nombre,
 				"2"=>$reg->apodo,
 				"3"=>$reg->tel,
 				"4"=>$reg->correo,
				"5"=>"<img src='../stuff/sitio/".$reg->foto."' height='50px' width='50px'>",
                "6"=>$reg->nacimiento,
                "7"=>$reg->lic,
                "8"=>$reg->maes,
                "9"=>$reg->doc,
                "10"=>$reg->resumen,
				"11"=>$reg->pass,
				"12"=>$reg->fk_carr,
				"13"=>$reg->fk_duracion
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>