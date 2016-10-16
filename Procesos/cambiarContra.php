<?php
include_once "../Datos/conexion.php";

$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

$id= $_POST['id'];
$contrasenha = $_POST["password"];

$contraEn = md5($contrasenha);

$QUERY = "UPDATE usuario SET contrasenha='$contraEn' WHERE idUsuario='$id'";
if (!mysqli_query($con,$QUERY)) {
    echo "Error al Modificar Contraseña";
} else {

    header("Location: ../vistas/ajax/login.html");
    exit();
}

mysqli_close($con);


?>