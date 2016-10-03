<?php
    include_once "../Datos/conexion.php";

    $cnn = new Conexion();
    $con = $cnn -> Conectar();

    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

    $usuario = $_POST["username"];
    $contrasenha =  $_POST["password"];

    $SELECT = "SELECT * FROM usuario WHERE usuario='$usuario' AND contrasenha=md5('".$contrasenha."')";
    $QUERY = mysqli_query($con,$SELECT);
    $ROW = mysqli_num_rows($QUERY);

    if ($ROW > 0) {
        session_start();
        $DATA = mysqli_fetch_assoc($QUERY);
        $_SESSION['id_usuario'] = $DATA['idUsuario'];
        $_SESSION['us'] = $DATA['nombre']." ".$DATA['apPaterno'];
        $_SESSION['loggedin'] = true;

        header("Location: ../vistas/index.php");
    } else {
        echo "alert ('Datos Incorrectos')";
        header("Location: ../vistas/ajax/login.html");
    }
?>