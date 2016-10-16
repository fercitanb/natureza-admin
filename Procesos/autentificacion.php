<?php

    include_once "../Datos/conexion.php";

    $cnn = new Conexion();
    $con = $cnn -> Conectar();

    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

    $usuario = $_POST["username"];
    $contrasenha =  $_POST["password"];

    function popup($vMsg,$vDestination) {
        echo("<html>\n");
        echo("<head>\n");
        echo("<title>System Message</title>\n");
        echo("<meta http-equiv=\"Content-Type\" class='alert' content=\"text/html;
        charset=iso-8859-1\">\n");

        echo("<script language=\"javascript\" class='alert' type=\"text/javascript\">\n");
        echo("alert('$vMsg');\n");
        echo("window.location = ('$vDestination');\n");
        echo("</script>\n");
        echo("</head>\n");
        echo("<body>\n");
        echo("</body>\n");
        echo("</html>\n");
        exit;
}

    $SELECT = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $QUERY = mysqli_query($con,$SELECT);
    $ROW = mysqli_num_rows($QUERY);

    if ($ROW<1)
    {

        popup('EL USUARIO NO EXISTE','../vistas/ajax/login.html');

        //header("Location: ../vistas/ajax/login.html");

        //require ('index.html#ajax/login.html');

    }
    else
    {
        $SELECTCON = "SELECT * FROM usuario WHERE contrasenha=md5('".$contrasenha."')";
        $QUERY1 = mysqli_query($con,$SELECTCON);
        $ROW1 = mysqli_num_rows($QUERY1);

        if ($ROW1<1)
        {
            popup('CONTRASEÑA INCORRECTA','../vistas/ajax/login.html');
        }
        else
        {
            $SELECTESTADO = "SELECT * FROM usuario WHERE estado='1' AND usuario='$usuario'";
            $QUERY2 = mysqli_query($con,$SELECTESTADO);
            $ROW2 = mysqli_num_rows($QUERY2);
            if ($ROW2<1)
            {
                popup('USUARIO SIN HABILITAR','../vistas/ajax/login.html');
            }
            else
            {
                session_start();
                $DATA = mysqli_fetch_assoc($QUERY);
                $_SESSION['id_usuario'] = $DATA['idUsuario'];
                $_SESSION['us'] = $DATA['nombre']." ".$DATA['apPaterno'];
                $_SESSION['loggedin'] = true;

                header("Location: ../vistas/index.php");
            }

        }
    }


    /*if ($ROW > 0) {
        session_start();
        $DATA = mysqli_fetch_assoc($QUERY);
        $_SESSION['id_usuario'] = $DATA['idUsuario'];
        $_SESSION['us'] = $DATA['nombre']." ".$DATA['apPaterno'];
        $_SESSION['loggedin'] = true;

        header("Location: ../vistas/index.php");
    } else {
        echo "equivocado";
        header("Location: ../vistas/ajax/login.html");
    }*/
?>
<script>

</script>
