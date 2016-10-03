<?php
include_once "../Datos/conexion.php";

$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$codigo = $_POST['codigo'];
$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

if (empty($imagen)) {
    $QUERY = "UPDATE equipo SET nombre='$nombre', descripcion='$descripcion', codigo='$codigo' WHERE idEquipo='$id'";
    if (!mysqli_query($con,$QUERY)) {
        echo "Error al actualizar";
    }
    header("Location: ../Vistas/index.php#ajax/formEquipo.php");
    exit();
} else {
    $QUERY = "UPDATE equipo SET nombre='$nombre', descripcion='$descripcion', codigo='$codigo', imagen='$imagen' WHERE idEquipo='$id'";
    if (!mysqli_query($con,$QUERY)) {
        echo "Error al actualizar";
    }
    header("Location: ../Vistas/index.php#ajax/formEquipo.php");
    exit();
}

mysqli_close($con);
?>