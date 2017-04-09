@if(! str_contains(Request::url(), route('maps.track', ['driver' => $driverModel])))
<div class="box box-solid">
  <div class="box-header with-border">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    <h3 class="box-title">@lang('admin/general.Markers')</h3>
    <div class="box-tools">
    <a href="{{ route('maps.track', ['driver' => $driverModel]) }}">@lang('admin/general.Go full screen') <i class="ion-arrow-expand"></i></a>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <input id="pac-input" class="controls" type="text"
        placeholder="Enter a location">
    <div id="map" style="min-height: {{ $height or '400px' }};"></div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@else
<input id="pac-input" class="controls" type="text"
    placeholder="Enter a location">
<div id="map"></div>
@endif
@push('style')
<style type="text/css">
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: calc(100% - 120px);
  height: 29px;
  border-radius: 2px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}
</style>
@endpush
@push('js')
<script>
  var markers = [];
  var map;
  var image = "{{ asset('img/driver.png') }}";
  var refreshTime = 10000;
  function initMap() {
    @if(str_contains(Request::url(), route('maps.track', ['driver' => $driverModel])))
    var body = document.body,
        html = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
    var height = (height - 162) + 'px;'
    document.getElementById('map').setAttribute("style","min-height: " + height);
    window.scrollTo(0, 100);
    @endif
    var neighborhoods = @jsonify($driver);
    var info = @jsonify($info);
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: {lat: parseFloat(neighborhoods[0].lat), lng: parseFloat(neighborhoods[0].lng)},
      streetViewControl: false
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
    for (var i = 0; i < neighborhoods.length; i++) {
      addMarker(neighborhoods[i], info[i]);
    }
    setTimeout(function() {
      updateMarkers();
    }, refreshTime);
    autocomplete(map);
  }

  function addMarker(position, info) {
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
  }

  function clearMarkers() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
    markers = [];
  }

  function updateMarkers() {
    setTimeout(this.updateMarkers, refreshTime);
    var newDriver = [];
    var newInfo = [];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
           if (xmlhttp.status == 200) {
            newDriver = JSON.parse(xmlhttp.responseText).driver;
            newInfo = JSON.parse(xmlhttp.responseText).info;
            clearMarkers();
            for (var i = 0; i < newDriver.length; i++) {
              addMarker(newDriver[i], newInfo[i]);
              map.setCenter({lat: parseFloat(newDriver[i].lat), 
                             lng: parseFloat(newDriver[i].lng)}); 
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
    @php
      $segments = Request::segments();
    @endphp
    xmlhttp.open("GET", "{{ route('getDriverJson', ['driver' => end($segments)]) }}", true);
    xmlhttp.send();
  };

  function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  };

  function autocomplete(map) {
    var input = (document.getElementById('pac-input'));
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      marker.setIcon(/** @type {google.maps.Icon} */({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
      }));
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, marker);
    });
  };
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ixd2rH_MR-etvMrw9EpCxbJ6ZEsz6OM&libraries=places&callback=initMap"></script>
@endpush