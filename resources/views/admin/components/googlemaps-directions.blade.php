<div class="box box-solid">
  <div class="box-header">
    <h3 class="box-title">@lang('admin/general.Directions')</h3>
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
  function initMap() {
    var to = { lat: {{ $trip->destination()->first()->latitude }}, lng: {{ $trip->destination()->first()->longitude }} };
    @if($trip->driverLocation != '')
    var driverLocation = { lat: {{ $trip->driverLocation->latitude }}, lng: {{ $trip->driverLocation->longitude }} };
    @endif
    var from = { lat: {{ $trip->source()->first()->latitude }}, lng: {{ $trip->source()->first()->longitude }} };

    var map = new google.maps.Map(document.getElementById('map'), {
      center: from,
      scrollwheel: false,
      zoom: 7,
      streetViewControl: false
    });

    var directionsDisplay = new google.maps.DirectionsRenderer({
      map: map
    });

    // Set destination, origin and travel mode.
    var request = {
      @if(is_null($trip->driverLocation))
      origin: from,
      destination: to,
      travelMode: 'DRIVING'
      @else
      origin: driverLocation,
      destination: to,
      waypoints: [{location: from, stopover: true}],
      travelMode: 'DRIVING'
      @endif
    };

    // Pass the directions request to the directions service.
    var directionsService = new google.maps.DirectionsService();
    directionsService.route(request, function(response, status) {
      if (status == 'OK') {
        // Display the route on the map.
        directionsDisplay.setDirections(response);
      }
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ixd2rH_MR-etvMrw9EpCxbJ6ZEsz6OM&callback=initMap"
    async defer></script>
@endpush