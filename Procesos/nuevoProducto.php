<?php
    include_once "../Datos/conexion.php";

    $cnn = new Conexion();
    $con = $cnn -> Conectar();

    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

    $nombre =  $_POST["nombre"];
    $medida = $_POST["medida"];
    $precio = $_POST["precio"];
    $imagen = $_FILES["imagen"]["name"];

    $dir = "http://localhost:90/natureza/img/producto/".$imagen;

    //echo "url: ".$imagen;
    /*echo "Upload: " .$dir.$_FILES["imagen"]["name"] . "<br />";
    echo "Type: " . $_FILES["imagen"]["type"] . "<br />";
    echo "Size: " . ($_FILES["imagen"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["imagen"]["tmp_name"] . "<br />";*/

    $QUERY = "INSERT INTO Producto(idProducto,nombre,medida,precio,imagen)
                  VALUES('','$nombre','$medida','$precio','$dir')";

    if (!mysqli_query($con,$QUERY)) {
        echo "Error al Insertar Producto";

    }
    else
    {
        header("Location: ../Vistas/index.php#ajax/formProducto.php");
        exit();
    }

    mysqli_close($con);
?>