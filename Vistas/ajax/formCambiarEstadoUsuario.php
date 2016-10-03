<?php
    include_once "../../Datos/conexion.php";
    $cnn = new Conexion();
    $con = $cnn -> Conectar();

    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

    if (!empty($_GET['id'])){
        $ID_USUARIO = $_GET['id'];
        $GET_ESTADO = $_GET['state'];
        $CAMBIAR_ESTADO = "UPDATE usuario SET estado='$GET_ESTADO' WHERE idUsuario='$ID_USUARIO'";
        if (!mysqli_query($con,$CAMBIAR_ESTADO)) {
            echo "Error al modificar estado";
        }
    }
?>
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Administrar Usuario</a></li>
            <li><a href="index.html#ajax/formCambiarEsadoUsuario.php">Cambiar Estado Usuario</a></li>
        </ol>
        <!--<div id="social" class="pull-right">
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </div>-->
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-9">
        <!-- Form New User -->
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-paint-brush"></i>
                    <span>Cambio de estado de usuario</span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form id="defaultForm" method="POST" action="" class="form-horizontal">
                    <fieldset>
                        <legend>Habilitar/Deshabilitar Usuarios</legend>
                        <div class="box-content">
                            <table class="table" id="datatable-1">
                                <thead>
                                <tr>
                                    <th>CI</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $QUERY = "SELECT idUsuario,ci,nombre,apPaterno,apMaterno,email, telefono, estado FROM usuario";
                                $EXECUTE = mysqli_query($con, $QUERY);
                                while ($row = mysqli_fetch_array($EXECUTE)):

                                    ?>
                                    <tr>
                                        <td><?php echo $row['ci'];?></td>
                                        <td><?php echo $row['nombre'];?></td>
                                        <td><?php echo $row['apPaterno']." ".$row['apMaterno'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['telefono'];?></td>
                                        <td><div class="col-sm-2">
                                                <div class="toggle-switch toggle-switch-info">
                                                    <label>
                                                        <?php
                                                            $ID = $row['idUsuario'];
                                                            $ESTADO = $row['estado'];
                                                            switch ($ESTADO){
                                                                case '0':
                                                                    echo "<input onclick=\"cambiarEstado($ID,1)\" type=\"checkbox\">
                                                        <div class=\"toggle-switch-inner\"></div>
                                                        <div class=\"toggle-switch-switch\"><i class=\"fa fa-check\"></i></div>";
                                                                    break;
                                                                case '1':
                                                                    echo "<input onclick=\"cambiarEstado($ID,0)\" type=\"checkbox\" checked>
                                                        <div class=\"toggle-switch-inner\"></div>
                                                        <div class=\"toggle-switch-switch\"><i class=\"fa fa-check\"></i></div>";
                                                                    break;
                                                            }
                                                        ?>

                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>CI</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
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
<script type="text/javascript">
    // Run Datables plugin and create 3 variants of settings
    function AllTables(){
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
function MakeSelect2(){
    $('select').select2();
    $('.dataTables_filter').each(function(){
        $(this).find('label input[type=text]').attr('placeholder', 'Search');
    });
}
$(document).ready(function() {
    // Load Datatables and run plugin on tables
    LoadDataTablesScripts(AllTables);
    // Add Drag-n-Drop feature
    WinMove();
});
</script>
<script>
    function cambiarEstado(id,state) {
        window.location.href = "index.php#ajax/formCambiarEstadoUsuario.php?id=" + id +"&state=" + state;
        location.reload();
    }
</script>

