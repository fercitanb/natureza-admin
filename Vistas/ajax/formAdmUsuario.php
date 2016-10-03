<?php
include_once "../../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();

$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");
?>

<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Administrar Usuario</a></li>
            <li><a href="index.php#ajax/formNuevoUsuario.php">Crear nuevo usuario</a></li>
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
    <div class="col-xs-12 col-sm-5">
        <!-- Form New User -->
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-paint-brush"></i>
                    <span>Registro de usuario nuevo </span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form id="defaultForm_1" method="POST" action="../../Procesos/insertarNuevoUsuario.php" class="form-horizontal">
                    <fieldset>
                        <legend>Ingresar datos de usuario</legend>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">CI</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="carnet" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nombre" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Apellido Paterno</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="apellidoPaterno" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Apellido Materno</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="apellidoMaterno" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Número Teléfono</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="numeroTelefono"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Roles </br>  de </br>Usuario</label>
                            <?php
                            include_once "../../Datos/conexion.php";

                            $cnn = new Conexion();
                            $con = $cnn -> Conectar();

                            $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");
                            $QUERY = "SELECT * FROM rol ORDER BY nombre ASC";
                            $EXECUTE = mysqli_query($con, $QUERY);
                            while ($row = mysqli_fetch_array($EXECUTE)):
                                ?>
                                <div class="col-sm-5">
                                    <div class="checkbox">
                                        <label>
                                            <input name="rol_list[]" type="checkbox" value="<?php echo $row['idRol'];?>"><?php echo $row['nombre'];?>
                                            <i class="fa fa-square-o"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            ?>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-15 col-sm-offset-5">
                                <button type="submit" class="btn btn-default">Agregar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12">
        <!-- List of Users -->
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>Lista de Usuarios</span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <legend>Usuarios</legend>
                <table class="table" id="datatable-1">
                    <thead>
                    <tr>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once "../../Datos/conexion.php";
                    $cnn = new Conexion();
                    $con = $cnn -> Conectar();

                    $dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

                    $QUERY = "SELECT idUsuario,ci,nombre,apPaterno,apMaterno,email,telefono FROM usuario";
                    $EXECUTE = mysqli_query($con, $QUERY);
                    while ($row = mysqli_fetch_array($EXECUTE)):

                        ?>
                        <tr>
                            <td><?php echo $row['ci'];?></td>
                            <td><?php echo $row['nombre'];?></td>
                            <td><?php echo $row['apPaterno']." ".$row['apMaterno'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['telefono'];?></td>
                            <td>
                                <form id="defaultForm_1" method="POST" action="index.php#ajax//formModUsuario.php" class="form-horizontal">
                                <button type="submit" class="btn btn-success" onclick="selectUser(<?php echo $row['idUsuario'];?>)">Modificar</button>
                                </form>
                                <form id="defaultForm_1" method="POST" action="index.php#ajax//formCambiarEstadoUsuario.php" class="form-horizontal">
                                <button type="submit" class="btn btn-info" onclick="selectUser(<?php echo $row['idUsuario'];?>)">Cambiar Estado</button>
                                </form>
<!--                                <a href="#" class="btn btn-primary">Add to Cart</a> <a href="#" class="btn btn-default">Compare</a>-->
                            </td>
                        </tr>
                        <?php
                    endwhile;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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