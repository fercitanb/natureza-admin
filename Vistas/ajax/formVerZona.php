<!DOCTYPE html>
<html>
  <head>
    <title>Drawing tools</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
    #map{
        width: 1000px;
        height: 600px;
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
            <li><a href="#">Administrar Zonas</a></li>
            <li><a href="#">Gestion Zonas</a></li>
        </ol>

    </div>
</div>
    <div class="col-xs-10 col-sm-8">
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
                    <div id="map">
                        <h2>Google Maps</h2>
                    </div><br>
                </div>
                
        </form>
    </div>
</div>
    <script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -17.3760165, lng: -66.1753268},
    zoom: 13
  });

  var drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.MARKER,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: [
        /*google.maps.drawing.OverlayType.MARKER,
        google.maps.drawing.OverlayType.CIRCLE,*/
        google.maps.drawing.OverlayType.POLYGON,
        /*google.maps.drawing.OverlayType.POLYLINE,
        google.maps.drawing.OverlayType.RECTANGLE*/
      ]
    },
    markerOptions: {icon: 'images/beachflag.png'},
    circleOptions: {
      fillColor: '#ffff00',
      fillOpacity: 1,
      strokeWeight: 5,
      clickable: false,
      editable: true,
      zIndex: 1
    }
  });
  drawingManager.setMap(map);
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU&signed_in=true&libraries=drawing&callback=initMap"
         async defer></script>
  </body>
</html>