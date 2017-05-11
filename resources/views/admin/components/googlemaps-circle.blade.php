<div class="box box-solid">
  <div class="box-header">
    <h3 class="box-title">@lang('admin/general.Zone')</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div id="map" style="min-height: {{ $height or '400px' }};"></div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@push('js')
<script>
  var citymap = {{$cities}};

  function initMap() {
    // Create the map.
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 35.757610, lng: 51.409954},
      zoom: 7,
      mapTypeId: 'roadmap',
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

    // Construct the circle for each value in citymap.
    // Note: We scale the area of the circle based on the population.
    for (var city in citymap) {
      // Add the circle for this city to the map.
      var cityCircle = new google.maps.Circle({
        strokeColor: '#3c8dbc',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#3c8dbc',
        fillOpacity: 0.35,
        map: map,
        center: citymap[city].center,
        radius: citymap[city].radius
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ixd2rH_MR-etvMrw9EpCxbJ6ZEsz6OM&callback=initMap"
    async defer></script>
@endpush