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
<div class="col-xs-12 col-sm-12">
    <!-- List of Users -->
    <div class="box">
        <div class="box-header">
            <div class="box-name">
                <i class="fa fa-search"></i>
                <span>Lista de Clientes</span>
            </div>
            <div class="no-move"></div>
        </div>
        <div class="box-content">
            <legend>Clientes</legend>
            <table class="table" id="datatable-1">
                <thead>
                <tr>
                    <th>C.I.</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Direcciones</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $QUERY = "SELECT u.idUsuario, u.ci, u.nombre, u.apPaterno, u.apMaterno, u.estado, u.email,u.telefono, r.idUsuario FROM usuario u, usuariorol r  WHERE u.idUsuario=r.idUsuario AND r.idRol=4";
                $EXECUTE = mysqli_query($con, $QUERY);
                while ($row = mysqli_fetch_array($EXECUTE)):

                    ?>
                    <tr>
                        <td><?php echo $row['ci'];?></td>
                        <td><?php echo $row['nombre'];?></td>
                        <td><?php echo $row['apPaterno']." ".$row['apMaterno']?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['telefono'];?></td>
                        <td><?php $EDIT = $row['idUsuario']; echo "<button onclick=\"vermasdireccion($EDIT)\" type=\"button\" >ver mas direcciones</button>" ?></td>
                    </tr>
                    <?php
                endwhile;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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
    function vermasdireccion(id) {
        window.location.href = "index.php#ajax/formNuevaDireccion.php?id=" + id;
        location.reload();
    }

</script>