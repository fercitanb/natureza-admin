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

$contra = randomPass();
$contraEn = md5($contra);

// Query para guardar en la base de datos
$QUERY = "INSERT INTO usuario(idUsuario,nombre,apPaterno,apMaterno,ci,usuario,contrasenha,email,estado,telefono)
              VALUES('','$nombre','$apellidoPaterno','$apellidoMaterno','$ci','$ci','$contraEn','$email','0','$numeroTelefono')";



$GET_ID = "SELECT idUsuario FROM usuario WHERE nombre='$nombre' AND apPaterno='$apellidoPaterno' AND apMaterno='$apellidoMaterno' AND ci='$ci' AND email='$email' AND telefono='$numeroTelefono'";
$QUERY_ID = mysqli_query($con,$GET_ID);
$row = mysqli_num_rows($QUERY_ID);
if ($row > 0) {
    // Mensaje que existe
    echo "USUARIO EXISTENTE";
    header("Location: ../Vistas/index.php#ajax/formNuevoUsuario.php");

} else {
    if (empty($rol)){
        echo "alert ('Necesita Selecionar al menos un rol');";
    }
    else
    {
        if (!mysqli_query($con,$QUERY)) {
            echo "alert ('Error al Insertar Usuario')";

        } else {
            $QUERY_CLIENTE = "INSERT INTO cliente(idUsuario) VALUES ('$GET_ID')";
            $SELECT = "SELECT * FROM usuario WHERE ci='$ci'";
            $QUERY_USUARIO = mysqli_query($con, $SELECT);
            $DATA = mysqli_fetch_array($QUERY_USUARIO);
            $ID = $DATA['idUsuario'];
            $QUERYROLUSUARIO= "INSERT INTO usuariorol(idUsuario, idRol) VALUES ('$ID','3')";
            if  (!mysqli_query($con,$QUERYROLUSUARIO)) {
                echo "Error al Insertar ROL";
            }
            else
            {
                $mensaje = "Bienvenido a Natureza,
                        Puede ingresar al sistema con su usuario que es su cédula de identidad y su contraseña: " .$contra;

                $to = $email;
                $subject ='INGRESO AL SISTEMA DE NATUREZA';
                $header = 'From: mfndpb@gmail.com'.
                    'MIME-Version: 1.0'.'\r\n'.
                    'Content-type: text/html; charset=utf-8';

                if (mail($to,$subject,$mensaje,$header)) {
                    echo "alert ('Se mando la contraseña correctamente');";
                } else {
                    echo "alert ('fallo al enviar la contraseña');";
                }
            }
            header("Location: ../Vistas/index.php#ajax/formCliente.php");
            exit();
        }
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