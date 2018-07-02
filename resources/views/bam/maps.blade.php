@extends('layouts.overtsidebar')

@section('css')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

@stop

@section('content')

<div class="row"> 
    
    <div class="col-md-9">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">API

          </h4>
          <div class="card-body">
            <div id="map"></div>
          </div>
        </div>
    </div>

</div>


@endsection
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBOM9nddVvB1lw17plPjToM4hLV8XdU0c"></script>

<script>

    function initialize() {

        var latitude = -19.9364521;
        var longitude = -44.1801882;
        var local = new google.maps.LatLng(latitude,longitude);

        var mapOptions = {
            center:local,
            zoom: 17,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = new google.maps.Marker({
            position : local,
            map: map,
            title: 'Posição Atual'
        });

    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>


@section('js')


@stop