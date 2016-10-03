<?php
include_once "../Datos/conexion.php";

$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

$direccion = $_POST['txtDireccion'];
$longitud = $_POST['txtLongitud'];
$latitud = $_POST['txtLatitud'];
$cliente = $_POST['cliente'];

$query_save = mysqli_query($con,"INSERT INTO direccion(idDireccion,latitud,longitud,nombreDireccion,estado,idZona,idCliente) 
                VALUES ('','$latitud','$longitud','$direccion','1','1','$cliente')");

if (!$query_save){
    echo "Erro al crear direccion";
} else
{
    header("Location: ../Vistas/index.php#ajax/formClienteDireccion.php");
    exit();
}

mysqli_close($con);;
?>