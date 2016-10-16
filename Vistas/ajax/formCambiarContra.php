<?php
include_once "../../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();
$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

/*if (!empty($_GET['id_estado'])){
    $ID_USUARIO = $_GET['id_estado'];
    $GET_ESTADO = $_GET['state'];
    $CAMBIAR_ESTADO = "UPDATE usuario SET estado='$GET_ESTADO' WHERE idUsuario='$ID_USUARIO'";
    if (!mysqli_query($con,$CAMBIAR_ESTADO)) {
        echo "Error al modificar estado";
    }
}*/
if (isset($_GET['id'])){
    $ID = $_GET['id'];

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Natureza</title>
    <meta name="description" content="description">
    <meta name="author" content="Evgeniya">
    <meta name="keyword" content="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../plugins/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <link href="../css/style_v1.css" rel="stylesheet">
    <link rel="icon" type="image/ico" href="../img/natureza.ico" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
    <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    <div id="page-login" class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <div class="text-right">
            </div>
            <div class="box">
                <i class="fa fa-bars"></i>
                <div class="box-content">
                    <div class="text-center">
                        <h3 class="page-header">Natureza</h3>

                    </div>
                    <form id="defaultForm_2" method="POST" action="../../Procesos/cambiarContra.php" class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $ID; ?>"/>
                                </div>
                            </div>
                            <h4>Ingrese su nueva contraseña:</br></h4>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Contraseña</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Confirmar Contraseña</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirmPassword" />
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary">Modificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/devoops.js"></script>
<script type="text/javascript">
    // Run Select2 plugin on elements
    function DemoSelect2(){
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
    }
    // Run timepicker
    function DemoTimePicker(){
        $('#input_time').timepicker({setDate: new Date()});
    }
    $(document).ready(function() {
        // Create Wysiwig editor for textare
        TinyMCEStart('#wysiwig_simple', null);
        TinyMCEStart('#wysiwig_full', 'extreme');
        // Add slider for change test input length
        FormLayoutExampleInputLength($( ".slider-style" ));
        // Initialize datepicker
        $('#input_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Add drag-n-drop feature to boxes
        LoadBootstrapValidatorScript(ValidacionForms);
        WinMove();
    });
</script>
</body>
</html>

