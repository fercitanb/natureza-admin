<?php
    include_once "../Datos/conexion.php";

    $cnn = new Conexion();
    $con = $cnn -> Conectar();

    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $medida = $_POST['medida'];
    $precio = $_POST['precio'];

    if (empty($_POST['imagen'])) {
        $QUERY = "UPDATE producto SET nombre='$nombre', medida='$medida', precio='$precio' WHERE idProducto='$id'";
        if (!mysqli_query($con,$QUERY)) {
            echo "Error al actualizar";
        }
        header("Location: ../Vistas/index.php#ajax/formProducto.php");
        exit();
    } else {
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $QUERY = "UPDATE producto SET nombre='$nombre', medida='$medida', precio='$precio',imagen='$imagen' WHERE idProducto='$id'";
        if (!mysqli_query($con,$QUERY)) {
            echo "Error al actualizar";
        }
        header("Location: ../Vistas/index.php#ajax/formProducto.php");
        exit();
    }

    mysqli_close($con);
?>