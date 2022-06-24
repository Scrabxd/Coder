<?php
require "../config/conexion.php";

Class cv
{
    public function __construct()
    {

    }
    public function insertar($trabajo,$descripcion,$inicio,$fin)
    {
        $sql = "INSERT INTO cv (nombre,descripcion,condicion)
        VALUES ('$nombre', '$descripcion', '$inicio', '$fin')";
        return ejecutarConsulta($sql);
    }
    public function editar2 ($idjob,$nombre,$descripcion,$inicio,$fin)
    {
        $sql = "UPDATE cv SET nombre = '$nombre', descripcion = '$descripcion', inicio = '$inicio', fin = '$fin'
        WHERE idjob = '$idjob'";
        return ejecutarConsulta($sql);

    }
    public function desactivar2($idjob)
    {
        $sql = "UPDATE cv SET condicion = '0' WHERE idjob = '$idjob'";
        return ejecutarConsulta($sql);
    }
    public function activar2($idjob)
    {
        $sql = "UPDATE cv SET condicion = '1' WHERE idjob = '$idjob'";
        return ejecutarConsulta($sql);
    }
    public function mostrar2($idjob)
    {
        $sql = "SELECT * FROM cv WHERE idjob = '$idjob'";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function listar2()
    {
        $sql = "SELECT * FROM cv";
        return ejecutarConsulta($sql);
    }

}
?>  