<?php
include_once "../../Datos/conexion.php";
$cnn = new Conexion();
$con = $cnn -> Conectar();
$dataBase = mysqli_select_db($con,"naturezabdd") or die ("Error al conectar con la BD");

if (isset($_GET['id'])){

    $ID = $_GET['id'];
    $QUERY = "SELECT * FROM direccion WHERE idCliente='$ID'";
    $Obtener_usuario = mysqli_query($con,"SELECT * FROM usuario WHERE idUsuario='$ID'");
    $Dato = mysqli_fetch_assoc($Obtener_usuario);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Marker Animations</title>
   <style>
    #mapa{
        width: 596px;
        height: 400px;
        background: #99DD99;
    }
</style>

  </head>
  <body onload="drop()">
<div class="row" xmlns="http://www.w3.org/1999/html">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Administrar Direcciones</a></li>
            <li><a href="#">Direcciones</a></li>
        </ol>

    </div>
</div>
    <div class="col-xs-12 col-sm-6">
        <legend>Cliente: <?php echo $Dato['nombre']." ".$Dato['apPaterno']?></legend>
        </br>
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-table"></i>
                    <span>Lista de Direcciones</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
            <form id="defaultForm_1" class="form-horizontal">

                    <div class="col-sm-5">
                        <input type="hidden" class="form-control" name="cliente" value="<?php echo $ID;?>" />
                    </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                         $EXECUTE = mysqli_query($con, $QUERY);
                        while ($row = mysqli_fetch_assoc($EXECUTE)): ?>
                        <tr>
                            <td><?php echo $row['idDireccion'];?></td>
                            <td><?php echo $row['nombreDireccion'];?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="form-group">
                                <div class="col-sm-12 col-sm-offset-4" >
                                    <button type="button" onclick="aggdireccion(<?php echo $ID;?>)" class="btn btn-primary" >AGREGAR</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <!-- List of Users -->
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div id="mapa">
                        <h2>Google Maps</h2>
                    </div><br>
                </div>
    </div>
</div>



<script type="text/javascript" src="../js/jquery-latest.js"></script>
<script type="text/javascript" src="../js/menu.js"></script>
<script>
    var direcciones = [

    <?php
        $EXECUTE = mysqli_query($con, $QUERY);
        while ($row = mysqli_fetch_assoc($EXECUTE)): ?>
            {lat: <?php echo $row['latitud'];?>, lng: <?php echo $row['longitud'];?>},
        <?php endwhile; ?> 
        
    ];

    var markers = [];
    var map;

    function initMap() {
    map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 13,
        center: {lat: -17.3760165, lng: -66.1753268}
    });
}


    function drop() {
        clearMarkers();
        for (var i = 0; i < direcciones.length; i++) {
            addMarkerWithTimeout(direcciones[i], i * 200);
        }
    }

    function addMarkerWithTimeout(position, timeout) {
        window.setTimeout(function() {
            markers.push(new google.maps.Marker({
                position: position,
                map: map,
                animation: google.maps.Animation.DROP
            }));
        }, timeout);
    }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }

    window.onload= drop;

</script>
<script>
    function aggdireccion(id) {
        window.location.href = "index.php#ajax/formAgregarDireccion.php?id=" + id;
        location.reload();
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU&signed_in=true&callback=initMap"></script>
  </body>
</html>