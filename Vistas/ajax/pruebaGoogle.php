<?php
?>
<div id="map">

</div>
<script type="text/javascript">
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5V9Adc4_zuFsLEfDktbyQ5RE0bFEmbI&callback=initMap">
</script>
