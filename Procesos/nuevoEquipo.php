<?php
include_once "../Datos/conexion.php";

$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$codigo = $_POST['codigo'];
$imagen = $_FILES["imagen"]["name"];

 $dir = "http://localhost:90/natureza/img/equipo/".$imagen;
//$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

$QUERY = "INSERT INTO Equipo(idEquipo,nombre,descripcion,codigo,imagen)
              VALUES('','$nombre','$descripcion','$codigo','$dir')";

if (!mysqli_query($con,$QUERY)) {
    echo "Error al Insertar Equipo";

}
else
{
    header("Location: ../Vistas/index.php#ajax/formEquipo.php");
    exit();
}

mysqli_close($con);
?>