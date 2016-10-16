<?php
include_once "../Datos/conexion.php";

$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

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


// Query para guardar en la base de datos
$QUERY = "INSERT INTO usuario(idUsuario,nombre,apPaterno,apMaterno,ci,usuario,contrasenha,email,estado,telefono)
              VALUES('','$nombre','$apellidoPaterno','$apellidoMaterno','$ci','$usuario','$contraEn','$email','0','$numeroTelefono')";



$GET_ID = "SELECT idUsuario FROM usuario WHERE nombre='$nombre' AND apPaterno='$apellidoPaterno' AND apMaterno='$apellidoMaterno' AND ci='$ci' AND email='$email' AND telefono='$numeroTelefono'";
$QUERY_ID = mysqli_query($con,$GET_ID);
$row = mysqli_num_rows($QUERY_ID);
if ($row > 0) {
    // Mensaje que existe
    popup('USUARIO EXISTENTE','../Vistas/index.php#ajax/formCliente.php');

} else {

        if (!mysqli_query($con,$QUERY)) {
            echo "alert ('Error al Insertar Usuario')";

        } else {
            $QUERY_CLIENTE = "INSERT INTO cliente(idUsuario) VALUES ('$GET_ID')";
            if (!mysqli_query($con,$QUERYCLIENTE)) {
                echo "error al crear cliente".mysql_error();

            }
            $SELECT = "SELECT * FROM usuario WHERE ci='$ci'";
            $QUERY_USUARIO = mysqli_query($con, $SELECT);
            $DATA = mysqli_fetch_array($QUERY_USUARIO);
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
                    popup('Se envió la contraseña al correo','../Vistas/index.php#ajax/formCliente.php');
                } else {
                    popup('Fallo al enviar la contraseña','../Vistas/index.php#ajax/formCliente.php');
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

function encriptar($cadena){
    $key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted; //Devuelve el string encriptado

}

function desencriptar($cadena){
    $key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}

mysqli_close($con);
?>