<?php
include_once "../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();
$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la Base de Datos");

$USER = $_POST['username'];
$PASSWORD = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE usuario = '$USER' AND contrasenha = md5('$PASSWORD')";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
$jsonArray = array();

if ($count == 1) {

    $id = $data['idUsuario'];
    $obRol = "SELECT idRol FROM usuariorol WHERE idUsuario= '$id' AND idRol!='2' AND idRol!='1' ";
    $rolRes = mysqli_query($con,$obRol);
    $dataRol = mysqli_fetch_assoc($rolRes);

    if (empty($dataRol)) {
        $jsonArray["code"][] = 0;
    } else {
        $jsonArray["code"][] = $dataRol['idRol'];
    }



} else {
    # code...
    $jsonArray["code"][] = 0;
}

mysqli_close($con);
echo json_encode($jsonArray);
?>