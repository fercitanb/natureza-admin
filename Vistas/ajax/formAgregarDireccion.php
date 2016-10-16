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
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU"></script>


<style>
    #mapa{
        width: 1000px;
        height: 530px;
        background: #99DD99;
        
    }
</style>
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
<div class="col-xs-12 col-sm-8">
        <legend>Cliente: <?php echo $Dato['nombre']." ".$Dato['apPaterno']?></legend>
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
                    <div id="mapa">
                        <h2>Google Maps</h2>
                    </div><br>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label">Direccion</label>
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
</div>




<div id="modalProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crear Nueva Direccion</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="./js/jquery-latest.js"></script>
<script type="text/javascript" src="./js/menu.js"></script>
<script type="text/javascript">
    //variables generales
    //array para almacenar nuevos marcadores
    var marcadores_nuevos = [];

    //funcion para quitar marcadores de mapa
    function quitar_marcadores(lista)
    {
        //recorrer el array de marcadores
        for(i in lista)
        {
            //quitar marcador del mapa
            lista[i].setMap(null);
        }
    }


    $(document).on("ready",function(){

        //variable para punto inicial
        var punto = new google.maps.LatLng(-17.3760165,-66.1753268);
        //variable para configuracion inicial
        var config = {
            minZoom:5,
            zoom:13,
            center:punto,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        //variable mapa
        mapa=new google.maps.Map ($("#mapa")[0],config);

        //evento click en el mapa
        google.maps.event.addListener(mapa, "click", function(event){
            //MOSTRAR UNA ALERTA AL HACER CLICK AL MAPA
            //EL EVENTO CLICK EN EL MAPA OFRECE UN PARAMETRO EVENT
            //EL CUAL DEVUELVE LAS COORDENADAS DE DONDE SE HIZO CLICK!
            //alert(event.latLng);
            //Coordenadas
            var coordenadas = event.latLng.toString();

            //remover los parentesis
            coordenadas = coordenadas.replace("(", "");
            coordenadas = coordenadas.replace(")", "");

            //coordenadas por separado
            var lista = coordenadas.split(",");

            //alert("Las coordenada X es"+ lista[0]);
            //alert("Las coordenada Y es"+ lista[1]);

            //variable para dirección, punto o coordenada
            var direccion = new google.maps.LatLng(lista[0], lista[1]);

            //variable para marcador
            var marcador = new google.maps.Marker({
                position:direccion,//la posición del nuevo marcador
                map: mapa, //en que mapa se ubicará el marcador
                animation:google.maps.Animation.DROP,//como aparecerá el marcador
                draggable:false// no permitir el arrastre del marcador
            });

            //---MODIFIQUÉ DESDE AQUÍ----------------------------
            var geocoder = new google.maps.Geocoder();
            var yourLocation = new google.maps.LatLng(lista[0], lista[1]);
            geocoder.geocode({ 'latLng': yourLocation },processGeocoder);

            //--- HASTA AQUÍ------------------------------------

            //pasar las coordenadas al formulario
            $("#txtLatitud").val(lista[0]);
            $("#txtLongitud").val(lista[1]);

            //dejar solo 1 marcador en el mapa
            //guardar el marcador en el array
            marcadores_nuevos.push(marcador);

            //5555555555555555555555
            //agregar evento click al marcador
            google.maps.event.addListener(marcador, "click", function(){
                //mostrar una alerta al hacer click
                alert(marcador.entidadfinanciera);
            });

            //ubicar el marcador en el mapa
            //y asi solo dejar 1
            quitar_marcadores(marcadores_nuevos);
            //ubicar el marcador en el mapa
            marcador.setMap(mapa);


        });

        function processGeocoder(results, status){
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#txtDireccion').text(results[0].formatted_address);
                    //var r=results[0].address_components[2].long_name;
                    //alert(r);
                }
                else {
                    error('Google no retorno resultado alguno.');
                }

            }
            else {
                error("Geocoding fallo debido a : " + status);
            }
        }

        function error(msg) {
            alert(msg);
        }

    });

    $(document).on("change","#slcCiudad",function(){
        var selected = $(this).find('option:selected');
        var latitud = selected.data('latitud');
        var longitud = selected.data('longitud');
        var zoom=selected.data('zoom');
        var puntoc = new google.maps.LatLng(latitud,longitud);

        mapa.setZoom(zoom);
        mapa.setCenter(puntoc);

    });
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];
        //Backspace = 8, Flecha izq = 37, Flecha der = 39, Supr = 46
        especiales1=".\'%";
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if((letras.indexOf(tecla) == -1 && !tecla_especial) || especiales1.indexOf(tecla) != -1)
            return false;
    }
</script>