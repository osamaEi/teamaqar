@extends('admin.index')
@section('admin') 

<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header" style="background: rgb(122, 165, 122)">
            <h3 class="card-title" style="float:right;">{{ __('All Places')}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Map Container -->
            <div id="map" style="height: 500px;"></div>
        </div> 
        <!-- /.card-body -->
    </div>
</div>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: { lat: 0, lng: 0 } // Update this with an appropriate center
        });

        // Fetch locations from database
        var locations = [
            @foreach($places as $place)
                { name: '{{ $place->name }}', lat: {{ $place->latitude }}, lng: {{ $place->longitude }} },
            @endforeach
        ];

        // Create a LatLngBounds object to fit all markers
        var bounds = new google.maps.LatLngBounds();

        // Display markers for each location
        var infowindow = new google.maps.InfoWindow();
        var markers = [];

        locations.forEach(function(location) {
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(location.lat), lng: parseFloat(location.lng) },
                map: map
            });

            marker.addListener('click', function() {
                infowindow.setContent(location.name);
                infowindow.open(map, marker);
            });

            markers.push(marker);
            bounds.extend(marker.getPosition());
        });

        // Fit the map to the bounds containing all markers
        map.fitBounds(bounds);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbgI1lSYiI8QtiLhSxiW-nIuMOdFti0rs&callback=initMap" async defer></script>

@endsection

