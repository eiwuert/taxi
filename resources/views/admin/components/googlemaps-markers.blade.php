@if(! str_contains(Request::url(), route('maps.fullscreen')))
<div class="box box-solid">
  <div class="box-header">
    <h3 class="box-title">Directions</h3>
    <div class="box-tools">
    <a href="{{ route('maps.fullscreen') }}">Go full screen <i class="ion-arrow-expand"></i></a>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div id="map" style="min-height: {{ $height or '400px' }};"></div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@else
<div id="map"></div>
@endif
@push('js')
<script>
  var markers = [];
  var map;
  var image = "{{ asset('img/driver.png') }}";
  function initMap() {
    @if(str_contains(Request::url(), route('maps.fullscreen')))
    var body = document.body,
        html = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
    var height = (height - 162) + 'px;'
    document.getElementById('map').setAttribute("style","min-height: " + height);
    window.scrollTo(0, 100);
    @endif
    var neighborhoods = {!! $drivers !!};
    var info = {!! $info !!};
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: {lat: 35.757610, lng: 51.409954}
    });

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map.setCenter(pos);
      });
    }
    clearMarkers();
    updateMarkers();
    for (var i = 0; i < neighborhoods.length; i++) {
      addMarkerWithTimeout(neighborhoods[i], 300, info[i]);
    }
  }

  function addMarkerWithTimeout(position, timeout, info) {
    window.setTimeout(function() {
      var marker = new google.maps.Marker({
        position: {lat: parseFloat(position.lat), lng: parseFloat(position.lng)},
        map: map,
        icon: image
      });
      markers.push(marker);
      var infoWindow = new google.maps.InfoWindow();
      google.maps.event.addListener(marker, 'click', (function(marker) {
        return function() {
          infoWindow.setContent(info);
          infoWindow.open(map, marker);
        }
      })(marker));
    }, timeout);
  }

  function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
    markers = [];
  }

  function updateMarkers() {
    setTimeout(updateMarkers, 10000);
    var newDrivers = [];
    var newInfo = [];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
           if (xmlhttp.status == 200) {
            newDrivers = JSON.parse(xmlhttp.responseText).drivers;
            newInfo = JSON.parse(xmlhttp.responseText).info;
            clearMarkers();
            for (var i = 0; i < newDrivers.length; i++) {
              addMarkerWithTimeout(newDrivers[i], 300, newInfo[i]);
            }
           }
           else if (xmlhttp.status == 400) {
              console.log('There was an error 400');
           }
           else {
               console.log('something else other than 200 was returned');
           }
        }
    };
    xmlhttp.open("GET", "{{ route('getDriversJson', Request::all()) }}", true);
    xmlhttp.send();
  };
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ixd2rH_MR-etvMrw9EpCxbJ6ZEsz6OM&callback=initMap"></script>
@endpush