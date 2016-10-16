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
  <body>
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

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <legend>Cliente: <?php echo $Dato['nombre']." ".$Dato['apPaterno']?></legend>
        <?php
        $EXECUTE = mysqli_query($con, $QUERY);
        while ($row = mysqli_fetch_assoc($EXECUTE)): ?>
            <div class="col-xs-12 col-sm-3">
                <div class="box box-pricing">
                    <div class="thumbnail">

                        <div class="caption">
                            <h5 class="text-center"><?php echo $row['nombreDireccion'];?></h5>


                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="col-xs-12 col-sm-6">
        <!-- List of Users -->
        <form method="POST" action="../Procesos/insertarNuevaDireccion.php" class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="hidden" class="form-control" name="cliente" value="<?php echo $ID;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="hidden" class="form-control" id='txtLatitud' name='txtLatitud' />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="hidden" class="form-control" id='txtLongitud' name='txtLongitud' />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div id="mapa">
                        <h2>Google Maps</h2>
                    </div><br>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Direccion</label>
                    <div class="col-sm-12">
                        <textarea REQUIRED type="text" class="form-control" id='txtDireccion' name='txtDireccion' />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-20 col-sm-offset-5">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
        </form>

    </div>
    <div class="col-sm-20 col-sm-offset-5">
                        <button id="drop" onclick="drop()" >Ubicaciones</button>
                    </div>
</div>

    <script>

// The following example creates a marker in Stockholm, Sweden using a DROP
// animation. Clicking on the marker will toggle the animation between a BOUNCE
// animation and no animation.

var marker;

function initMap() {
  var mapa = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 13,
    center: {lat: 59.325, lng: 18.070}
  });

  marker = new google.maps.Marker({
    map: mapa,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: {lat: 59.327, lng: 18.067}
  });
  marker.addListener('click', toggleBounce);
}

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU&signed_in=true&callback=initMap"></script>
  </body>
</html>
