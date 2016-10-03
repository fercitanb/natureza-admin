<!--
<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h3>My Google Maps Demo</h3>
<div id="map"></div>
<script>
    function initMap() {
        //-17.418617, -66.165595
        var uluru = {lat: -17.418617, lng: -66.165595};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU&callback=initMap">
</script>
</body>
</html>-->

<!DOCTYPE html>
<html>
<head>

    <meta charset="ISO-8859-1" />
    <title>FORMULARIO DE REGISTRO</title>
    <style>
        #mapa{
            width: 400px;
            height: 400px;
            background: #99DD99;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="./css/menu.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/formRegistro.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC6ng1uHCtw3tSewr-WFnc8DhRik2yocHU"></script>
    <script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>



</head>
<body>
<header>


</header>


<section>

    <form name="frmRegistro" id="frmRegistro" method="post" action="guardaRegistro.php">



        <div id="mapa">
            <h2>Google Maps</h2>
        </div><br>
        <textarea id='txtDireccion' name='txtDireccion' required placeholder="Direccion"></textarea>
        <center>
            <div class="g-recaptcha" data-sitekey="6Leo7wwTAAAAACP2Vx93MxFEY5HXp4jTemGkbgA0">

            </div></center><br>

        <input id="boton" type="submit" name="btnRegistrar" value="Registrarse">

    </form>



</section>
</body>
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
            zoom:12,
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
</html>