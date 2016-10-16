<?php
include_once "../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();
$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la Base de Datos");

$ci = $_POST["ci"];
$nombre =  $_POST["nombre"];
$apellidoPaterno =  $_POST["apellidoPaterno"];
$apellidoMaterno =  $_POST["apellidoMaterno"];
$numeroTelefono =  $_POST["numeroTelefono"];
$email = $_POST["email"];

$nombre=mb_strtoupper($nombre, 'UTF-8');
$apellidoPaterno=mb_strtoupper($apellidoPaterno, 'UTF-8');
$apellidoMaterno=mb_strtoupper($apellidoMaterno, 'UTF-8');

$contra = randomPass();
$contraEn = md5($contra);
$n = substr($nombre, 0,1);
$ap = substr($apellidoPaterno, 0,1);
$usuario = $n.$ap.$ci;




$GETID = "SELECT idUsuario FROM usuario WHERE nombre='$nombre' AND apPaterno='$apellidoPaterno' AND apMaterno='$apellidoMaterno' AND ci='$ci' AND email='$email' AND telefono='$numeroTelefono'";
$QUERYID = mysqli_query($con,$GETID);
$row = mysqli_num_rows($QUERYID);
$jsonArray = array();
if ($row > 0) {
    // Mensaje que existe
    $jsonArray["code"][] = 0;

} else {

    $QUERY = "INSERT INTO usuario(idUsuario,nombre,apPaterno,apMaterno,ci,usuario,contrasenha,email,estado,telefono)
              VALUES('','$nombre','$apellidoPaterno','$apellidoMaterno','$ci','$usuario','$contraEn','$email','0','$numeroTelefono')";

    if (!mysqli_query($con,$QUERY)) {
        echo "Error al Insertar Usuario";

    } else {
        $QUERYCLIENTE = "INSERT INTO cliente(idUsuario) VALUES ('$GETID')";
        $SELECT = "SELECT * FROM usuario WHERE ci='$ci'";
        $QUERYUSUARIO = mysqli_query($con, $SELECT);
        $DATA = mysqli_fetch_array($QUERYUSUARIO);
        $ID = $DATA['idUsuario'];
        $QUERYROLUSUARIO= "INSERT INTO usuariorol(idUsuario, idRol) VALUES ('$ID','4')";
        if  (!mysqli_query($con,$QUERYROLUSUARIO)) {
            echo "Error al Insertar ROL";
        }
        else
        {
            $mensaje = "Bienvenido a Natureza,
                        Puede ingresar al sistema con su usuario: ".$usuario." y su contraseña: " .$contra;

            $to = $email;
            $subject ='INGRESO AL SISTEMA DE NATUREZA';
            $header = 'From: natureza.bo@gmail.com'.
                'MIME-Version: 1.0'.'\r\n'.
                'Content-type: text/html; charset=utf-8';

            if (mail($to,$subject,$mensaje,$header)) {
                $jsonArray["code"][] = 1;
            } else {
                $jsonArray["code"][] = 2;
            }
        }
        //header("Location: ../Vistas/index.php#ajax/formCliente.php");
        exit();
    }



}

function randomPass($tamano=6) {
    $char = "abcdefghijklmneopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321";
    return substr(str_shuffle($char),0,$tamano);
}



mysqli_close($con);
echo json_encode($jsonArray);
?>