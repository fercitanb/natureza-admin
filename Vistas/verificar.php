<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta charset="utf-8" />
    <title>NATUREZA</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="author" content="Angela Valdez" />

    <link rel="icon" href="favicon.ico" />
   
</head>
<body>
<?php
//header("Content-Type: text/html; charset=iso-8859-1");
			include_once('../Procesos/Usuario.php');
			include_once('../Procesos/usuarioRol.php');


			$nombreUsuario=addslashes($_REQUEST['username']);
			$password=addslashes($_REQUEST['password']);

			
			//verificar esta parte
			$usuario= new Usuario('','','','','');
			//---------

			$existe=$usuario->VerificaLogin($nombreUsuario,$password);

				 switch ($existe) {
				 case 0: {/*SI LA BÚSQUEDA NO HA SIDO ENCONTRADA */
							echo "<script>";
							echo "alert ('Usuario Incorrecto'); location.href='ajax/login.html';";
							echo "</script>";
							break;}
				 case 2:{ //SI EL USUARIO NO ESTÁ HABILITADO
				 			echo "<script>";
							echo "alert ('Usuario Inhabilitado'); location.href='ajax/login.html';";
							echo "</script>";
							break;}
				 case 1 : {/*SI LA BÚSQUEDA HA SIDO ENCONTRADA */

										session_start();

										$arregloUsuario[]=array('IdUsuario'=>$usuario->getIdUsuario(),
										'Nombre'=>$usuario->getNombre(),
										'ApPat'=>$usuario->getApPat(),
										'ApMat'=>$usuario->getApMat(),
										'Login'=>$nombreUsuario,
										'Correo'=>$usuario->getCorreo());

											$rol= new UsuarioRol($usuario->getIdUsuario(),0);
											$listaRoles=$rol->ObtieneRoles();

                                        for ($i=0; $i < count($listaRoles); $i++) {
                                            switch($listaRoles[$i])
                                            {
                                                /*Modificar segun el nuevo menu*/
                                                case 1: echo"<a href='index.php'><input type='button' value='Administrador'></a>";break;
                                                case 2: echo"<a href='ajax/formEmpleado.php'><input type='button' value='Empleado'></a>";break;
                                                case 3: echo"<a href='ajax/formDistribuidor.php'><input type='button' value='Distribuidor'></a>";break;
                                                case 4: echo"<a href='ajax/formCliente.php'><input type='button' value='Cliente'></a>";break;

                                            }
                                        }

												$_SESSION['usuario']=$arregloUsuario;

							break;
						}
				}
?>


</body>
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
</html>