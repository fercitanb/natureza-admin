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
            <li><a href="index.php#ajax/formModUsuario.php">Modificar Usuario</a></li>
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
<!-- Form New User -->
<div class="row">
    <div class="col-xs-8 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>Modificar Usuario</span>
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
                        <!--<th>Roles</th>
                        <th>Accion</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $QUERY = "SELECT idUsuario,ci,nombre,apPaterno,apMaterno,email,telefono FROM usuario";
                    $EXECUTE = mysqli_query($con, $QUERY);
                    while ($row = mysqli_fetch_array($EXECUTE)):?>
                        <tr>
                            <td onclick="selectUser(<?php echo $row['idUsuario'];?>)"><?php echo $row['ci'];?></td>
                            <td onclick="selectUser(<?php echo $row['idUsuario'];?>)"><?php echo $row['nombre'];?></td>
                            <td onclick="selectUser(<?php echo $row['idUsuario'];?>)"><?php echo $row['apPaterno']." ".$row['apMaterno'];?></td>
                            <td onclick="selectUser(<?php echo $row['idUsuario'];?>)"><?php echo $row['email'];?></td>
                            <td onclick="selectUser(<?php echo $row['idUsuario'];?>)"><?php echo $row['telefono'];?></td>
<!--                            // TODO: cantidad roles-->
                            <!--<td><?php /*echo "";*/?></td>
                            <td >
                                <p onclick="selectUser(<?php /*echo $row['idUsuario'];*/?>)">Modificar</p>
                            </td>-->
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
<div class="row">
    <div class="col-xs-5 col-sm-offset-1 col-sm-5">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-paint-brush"></i>
                    <span>Modificar Usuario</span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <form id="defaultForm_1" method="POST" action="../Procesos/modificarUsuario.php" class="form-horizontal">
                    <fieldset>
                        <legend>Modificar datos de usuario</legend>

                        <?php
                        if (!empty($_GET['id'])){
                            $ID = $_GET['id'];
                            $OBTENER_USUARIO = "SELECT * FROM usuario WHERE idUsuario='$ID'";
                            $QUERY_USUARIO = mysqli_query($con, $OBTENER_USUARIO);
                            while ($DATA = mysqli_fetch_array($QUERY_USUARIO)):

                        ?>
                                <div >
                                    <input type=hidden class="form-control" name="id" value="<?php echo $DATA['idUsuario']?>"/>
                                </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">CI</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ci" value="<?php echo $DATA['ci']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nombre"  value="<?php echo $DATA['nombre']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Apellido Paterno</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="apellidoPaterno" value="<?php echo $DATA['apPaterno']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Apellido Materno</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="apellidoMaterno" value="<?php echo $DATA['apMaterno']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Número Teléfono</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="numeroTelefono" value="<?php echo $DATA['telefono']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $DATA['email']?>" />
                                </div>
                            </div>
                        <?php
                                endwhile;

                            }
                            mysqli_close($con);
                        ?>
                        <div class="form-group">
                            <div class="col-sm-15 col-sm-offset-4">
                                <button type="submit" class="btn btn-success">Modificar</button>
<!--                                <button type="submit" class="btn btn-danger">Cancelar</button>-->
                            </div>
                        </div>
                    </fieldset>
                </form>
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
    function selectUser(x) {

        window.location.href = "index.php#ajax/formModUsuario.php?id=" + x;
        location.reload();
    }
</script>
