<?php
include_once "../../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();
$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

if (!empty($_GET['id_estado'])){
    $ID_USUARIO = $_GET['id_estado'];
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
            <li><a>Administrar Distribuidor</a></li>
            <li><a>Gestión de Distribuidor</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <!-- Form New User -->
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-paint-brush"></i>
                    <span>Formulario de Distribuidor</span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <?php
                if (!empty($_GET['id'])){

                    $ID_USUARIO = $_GET['id'];
                    $OBTENER_USUARIO = "SELECT * FROM usuario WHERE idUsuario='$ID_USUARIO'";
                    $QUERY_USUARIO = mysqli_query($con, $OBTENER_USUARIO);
                    while ($DATA = mysqli_fetch_array($QUERY_USUARIO)):

                        ?>

                        <form id="defaultForm_2" method="POST" action="../Procesos/modificarDistribuidor.php" class="form-horizontal">
                            <fieldset>
                                <legend>Ingresar datos de distribuidor</legend>
                                <div class="form-group">
                                    <div >
                                        <input type=hidden class="form-control" name="id" value="<?php echo $DATA['idUsuario'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">CI</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="ci" value="<?php echo $DATA['ci'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="nombre" value="<?php echo $DATA['nombre'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Apellido Paterno</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="apellidoPaterno" value="<?php echo $DATA['apPaterno'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Apellido Materno</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="apellidoMaterno" value="<?php echo $DATA['apMaterno'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Número Teléfono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="numeroTelefono" value="<?php echo $DATA['telefono'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="email" value="<?php echo $DATA['email'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-15 col-sm-offset-3" >
                                        <button type="submit" class="btn btn-success" >Modificar</button>
                                        <!--                                            <button type="submit" class="btn btn-danger">Cancelar</button>-->
                                    </div>
                                </div>

                            </fieldset>
                        </form>

                    <?php endwhile; } else { ?>

                    <form id="defaultForm_1" method="POST" action="../Procesos/insertarNuevoDistribuidor.php" class="form-horizontal">
                        <fieldset>
                            <legend>Ingresar datos de distribuidor</legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">CI</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ci" />
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
                                <div class="col-sm-15 col-sm-offset-5">
                                    <button type="submit" class="btn btn-default">Agregar</button>
                                </div>
                            </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8">
        <!-- List of Users -->
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>Lista de Distribuidores</span>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <legend>Distribuidores</legend>
                <table class="table" id="datatable-1">
                    <thead>
                    <tr>
                        <th>C.I.</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Modificar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $QUERY = "SELECT u.idUsuario, u.ci, u.nombre, u.apPaterno, u.apMaterno, u.estado, u.email, r.idUsuario FROM usuario u, usuariorol r  WHERE u.idUsuario=r.idUsuario AND r.idRol=3";
                    $EXECUTE = mysqli_query($con, $QUERY);
                    while ($row = mysqli_fetch_array($EXECUTE)):

                        ?>
                        <tr>
                            <td><?php echo $row['ci'];?></td>
                            <td><?php echo $row['nombre'];?></td>
                            <td><?php echo $row['apPaterno']." ".$row['apMaterno']?></td>
                            <td><?php echo $row['email'];?></td>
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
                            <td><?php $EDIT = $row['idUsuario']; echo "<button onclick=\"modificarUsuario($EDIT)\" type=\"button\" class=\"btn btn-success btn-app-sm\"><i class=\"fa fa-paint-brush\"></i></button>";?></td>
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
<script>
    function modificarUsuario(id) {
        window.location.href = "index.php#ajax/formDistribuidor.php?id=" + id;
        location.reload();
    }

    function cambiarEstado(id,state) {
        window.location.href = "index.php#ajax/formDistribuidor.php?id_estado=" + id +"&state=" + state;
        location.reload();
    }
</script>
<?php mysqli_close($con)?>