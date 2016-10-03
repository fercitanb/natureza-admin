<?php
include_once "../../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();
$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

if (isset($_GET['id'])) {
    echo "<script type='text/javascript'>$(\"#modalEquipoModificar\").modal('show')</script>";
}

if (isset($_GET['id_dlt'])) {
    $id_dlt = $_GET['id_dlt'];
    $delete_query = mysqli_query($con, "DELETE FROM equipo WHERE idEquipo='$id_dlt'");
    if (!$delete_query){
        echo "Error al Eliminar";
    }
}

?>
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="#">Administrar Equipo</a></li>
                <li><a href="formEquipo.php">Equipo</a></li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="control-group">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalEquipo">Nuevo Equipo</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <?php
        $QUERY = "SELECT * FROM equipo";
        $EXECUTE = mysqli_query($con, $QUERY);
        while ($row = mysqli_fetch_assoc($EXECUTE)): ?>
            <div class="col-xs-10 col-sm-2">
                <div class="box box-pricing">
                    <div class="thumbnail">
                        <img style="width:512px;height: 228px;" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']);?>" alt="">
                        <div class="caption">
                            <h4 class="text-center"><?php echo $row['nombre'];?></h4>
                            <h5>Descripcion: <?php echo " ".$row['descripcion'];?></h5> <h6>Codigo: <?php echo" ".$row['codigo'];?> </h6>
                            <button onclick="modificarEquipo(<?php echo $row['idEquipo'];?>)" class="btn btn-success">Modificar</button> <button onclick="eliminarEquipo(<?php echo $row['idEquipo'];?>)" class="btn btn-default">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div id="modalEquipo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crear Nuevo Equipo</h4>
                </div>
                <div class="modal-body">
                    <form id="defaultForm" method="POST" action="../Procesos/nuevoEquipo.php" class="form-horizontal" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre</label>
                                <div class="col-sm-5">
                                    <input REQUIRED type="text" class="form-control" name="nombre" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Descripcion</label>
                                <div class="col-sm-5">
                                    <input REQUIRED type="text" class="form-control" name="descripcion" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Codigo</label>
                                <div class="col-sm-5">
                                    <input REQUIRED type="text" class="form-control" name="codigo" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Imagen</label>
                                <div class="col-sm-5">
                                    <i class="fa fa-camera"></i><input REQUIRED type="file" name="imagen"/>
                                    <!--                                <inpu"col-sm-15 col-sm-offset-5"t type="image" class="form-control" name="imagen" />-->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-20 col-sm-offset-5">
                                    <button type="submit" class="btn btn-info">Agregar</button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>

    <div id="modalEquipoModificar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modificar Equipo</h4>
                </div>
                <div class="modal-body">
                    <form id="defaultForm" method="POST" action="../Procesos/modificarEquipo.php" class="form-horizontal" enctype="multipart/form-data">
                        <?php
                        $id_modificar = $_GET['id'];
                        $resultado_equipo = mysqli_query($con,"SELECT * FROM equipo WHERE idEquipo=$id_modificar");
                        while ( $equipo_data= mysqli_fetch_assoc($resultado_equipo)):
                             ?>
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">ID</label>
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $equipo_data['idEquipo'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input REQUIRED type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $equipo_data['nombre'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Descripcion</label>
                                    <div class="col-sm-5">
                                        <input REQUIRED type="text" class="form-control" name="descripcion" value="<?php echo $equipo_data['descripcion'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input REQUIRED type="text" class="form-control" name="codigo" value="<?php echo $equipo_data['codigo'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Imagen</label>
                                    <div class="col-sm-5">
                                        <i class="fa fa-camera"></i><input type="file" name="imagen"/>
                                        <!--                                <inpu"col-sm-15 col-sm-offset-5"t type="image" class="form-control" name="imagen" />-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-20 col-sm-offset-5">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </fieldset>
                        <?php endwhile; ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        // Run Select2 on element
        function Select2Test(){
            $("#Equipo-select").select2();
        }
        $(document).ready(function() {
            // Load script of Select2 and run this
            LoadSelect2Script(Select2Test);
            WinMove();
        });
    </script>
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
        function modificarEquipo(id) {
            window.location.href = "index.php#ajax/formEquipo.php?id=" + id;
            location.reload();

        }

        function eliminarEquipo(id) {
            window.location.href = "index.php#ajax/formEquipo.php?id_dlt=" + id;
            location.reload();

        }

    </script>

    <!--<script type="text/javascript">
        $(document).ready(function() {
            $('#modalProductoModificar').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');

                var r = new Request.JSON({
                    'url: '',
                'method': 'post',
                    'onComplete': function(success) { alert('AJAX call status: ' + (success ? 'succeeded': 'failed!'); },
                'onFailure': function() { alert('Could not contact server'); },
                'data': 'id=' + id
            }).send();
                location.reload();
                $(".modal-body #id").val( id );
            });
        });
    </script>-->

<?php mysqli_close($con);?>