<?php
    include_once "../Datos/conexion.php";

    $cnn = new Conexion();
    $con = $cnn -> Conectar();

    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

    $id = $_POST["id"];
    $ci = $_POST["ci"];
    $nombre = $_POST["nombre"];
    $apellidoPaterno = $_POST["apellidoPaterno"];
    $apellidoMaterno = $_POST["apellidoMaterno"];
    $numeroTelefono = $_POST["numeroTelefono"];
    $email = $_POST["email"];
    $rol = $_POST["rol"];

    $QUERY = "UPDATE usuario SET nombre='$nombre', apPaterno='$apellidoPaterno', apMaterno='$apellidoMaterno',ci='$ci', email='$email', telefono='$numeroTelefono' WHERE idUsuario='$id'";

    if (!mysqli_query($con,$QUERY)) {
        echo "Error al Modificar Usuario ";
    } else {

        // TODO: Insertar Asignar Rol
        $QUERY = mysqli_query($con,"UPDATE usuariorol SET idRol='$rol' WHERE idUsuario='$id'");
        if (!$QUERY) {
            echo "Error al Modificar Usuario ";
        }
        header("Location: ../Vistas/index.php#ajax/formNuevoUsuario.php");
        exit();
    }

    mysqli_close($con);
?>