<?php
    session_start();
    if (!$_SESSION['loggedin']) {
        # code...
        header("location: ajax/login.html");
    } else {
        # code...
        include_once("../Datos/conexion.php");
        $cnn = new Conexion();
        $con = $cnn -> Conectar();
        $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");
        $ID = $_SESSION['id_usuario'];
        $user = $_SESSION['us'];

        $QUERY_ROL = "SELECT IdRol FROM usuariorol WHERE IdUsuario='$ID'";
        $RESULT_ROL = mysqli_query($con, $QUERY_ROL);
            $ROL = mysqli_fetch_assoc($RESULT_ROL);
    }
?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
            <meta charset="ISO-8859-1" />
			<title>Natureza</title>
            <link rel="icon" type="image/ico" href="img/natureza.ico" />
			<meta name="description" content="description">
			<meta name="author" content="DevOOPS">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
			<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
			<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
			<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
			<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
			<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
			<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
			<link href="plugins/select2/select2.css" rel="stylesheet">
			<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
			<link href="css/style_v1.css" rel="stylesheet">
			<link href="plugins/chartist/chartist.min.css" rel="stylesheet">

            <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU"></script>
            <script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
			<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
			<![endif]-->
            <style>
                /*#map {
                    height: 400px;
                    width: 100%;
                }*/
            </style>
		</head>
		<body>
		<!--Start Header-->
		<header class="navbar">
			<div class="container-fluid expanded-panel">
				<div class="row">
					<div id="logo" class="col-xs-12 col-sm-2">
						<a href="index.php">NATUREZA</a>
					</div>
					<div id="top-panel" class="col-xs-12 col-sm-10">
						<div class="row">
							<div class="col-xs-4 col-sm-12 top-panel-right">
								<ul class="nav navbar-nav pull-right panel-menu">

									<li class="dropdown">
										<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
											<div class="avatar"></div>
											<i class="fa fa-angle-down pull-right"></i>
											<div class="user-mini pull-right">
												<span class="welcome">Bienvenido</span>
												<span><?php echo $user; ?></span>
											</div>
										</a>
										<ul class="dropdown-menu">
											<!--<li>
                                                <a href="#">
                                                    <i class="fa fa-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>-->
                                            <li>
                                                <a href="ajax/formCambiarContraseña.php">
                                                    <i class="fa fa-unlock"></i>
                                                    <span>Cambiar contraseña</span>
                                                </a>
                                            </li>
											<li>
												<a href="../Procesos/cerrarSesion.php">
													<i class="fa fa-power-off"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!--End Header-->
		<!--Start Container-->
		<div id="main" class="container-fluid">
			<div class="row">
				<div id="sidebar-left" class="col-xs-2 col-sm-2">
					<ul class="nav main-menu">
                        <!-- Administrador -->
                        <?php if ($ROL['IdRol'] == '1'): ?>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-users"></i>
                                    <span class="hidden-xs">Administrar Usuarios</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formNuevoUsuario.php">Gestión de Usuario</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-coffee"></i>
                                    <span class="hidden-xs">Administrar Productos</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formProducto.php">Gestión de Producto</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-desktop"></i>
                                    <span class="hidden-xs">Administrar Equipos</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formEquipo.php">Gestión de Equipo</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-map-marker"></i>
                                    <span class="hidden-xs">Administrar Zonas</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formZona.php">Gestión de Zona</a></li>
                                    <li><a class="ajax-link" href="ajax/formZona.php">Ver Zonas</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-location-arrow"></i>
                                    <span class="hidden-xs">Administrar Direcciones</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formClienteDireccion.php">Gestión de Direccion</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <span class="hidden-xs">Reportes</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="#">Reportes de Pedidos</a></li>
                                    <li><a class="ajax-link" href="#">Repostes de Clientes</a></li>
                                    <li><a class="ajax-link" href="#">Repostes de Equipos</a></li>
                                    <li><a class="ajax-link" href="#">Repostes de Productos</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Encargado de Pedido -->
                        <?php if ($ROL['IdRol'] == '2'): ?>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-map-marker"></i>
                                    <span class="hidden-xs">Administrar Zonas</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="">Ver Zonas</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-map-marker"></i>
                                    <span class="hidden-xs">Administrar Direcciones</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formClienteDireccion.php">Gestión de Dirección</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-desktop"></i>
                                    <span class="hidden-xs">Administrar Distribución</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formDistribuidor.php">Gestión de Distribuidor</a></li>
                                    <li><a class="ajax-link" href="">Gestión de Zona-Distribuidor</a></li>
                                    <li><a class="ajax-link" href="">Lista de Pedidos</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs">Administrar Cliente</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="ajax/formCliente.php">Gestión de Cliente</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-desktop"></i>
                                    <span class="hidden-xs">Administrar Pedidos</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="">Crear Nuevo Pedido</a></li>
                                    <li><a class="ajax-link" href="">Ver Pedidos</a></li>
                                    <li><a class="ajax-link" href="">Motivos</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Encargado de Distribuidor -->
                        <?php if ($ROL['IdRol'] == '3'): ?>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-coffee"></i>
                                    <span class="hidden-xs">Administrar Pagos</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="">Gestión Pagos</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-desktop"></i>
                                    <span class="hidden-xs">Administrar Pedidos</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="">Ver Pedidos</a></li>
                                    <li><a class="ajax-link" href="">Motivos</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <!-- Cliente -->
                        <?php if ($ROL['IdRol'] == '4'): ?>
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <i class="fa fa-angle-up"></i>
                                    <span class="hidden-xs">Solicitud Pedidos</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="ajax-link" href="">Crear Nuevo Pedido</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
					</ul>
				</div>
				<!--Start Content-->
				<div id="content" class="col-xs-12 col-sm-10">

					<div id="ajax-content"></div>
				</div>
				<!--End Content-->
			</div>
		</div>
		<!--End Container-->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!--<script src="http://code.jquery.com/jquery.js"></script>-->
		<script src="plugins/jquery/jquery.min.js"></script>
		<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="plugins/bootstrap/bootstrap.min.js"></script>
		<script src="plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
		<script src="plugins/tinymce/tinymce.min.js"></script>
		<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
		<!-- All functions for this theme + document.ready processing -->
		<script src="js/devoops.js"></script>
		</body>
		</html>
<?php
    mysqli_close($con)
?>
