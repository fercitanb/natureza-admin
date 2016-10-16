<?php
include_once "../Datos/conexion.php";

$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

$direccion = $_POST['txtDireccion'];
$longitud = $_POST['txtLongitud'];
$latitud = $_POST['txtLatitud'];
$cliente = $_POST['cliente'];


$QUERYDIRECCION="INSERT INTO direccion(idDireccion,latitud,longitud,nombreDireccion,estado,idZona,idCliente)
                VALUES ('','$latitud','$longitud','$direccion','1','1','$cliente')";

$QUERYCONNECT= mysqli_query($con,$QUERYDIRECCION);

if (!$QUERYCONNECT){
    echo "Error al crear direccion";
} else
{
    header("Location: ../Vistas/index.php#ajax/formNuevaDireccion.php?id=".$cliente);
    exit();
}

mysqli_close($con);
?>