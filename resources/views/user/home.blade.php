@include('user.header', ['notificationCount' => $notificationCount, 'notifications' => $notifications])

    
   

<section class="py-5 overflow-hidden">
  <div class="container-lg">
    <div class="row">
      <div class="col-md-12">
        <p>My Crop and Farms</p>
      <div id="map" style="height: 500px; width: 100%;"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Google Maps container -->
      </div>
    </div>
  </div>
</section>


    

   



<script async defer src="googlemapsAPI.js"></script>
    
<script>
  function initMap() {
    var locations = @json($locations); 

    if (locations.length > 0) {
      var mapCenter = { lat: 0, lng: 0 }; 

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: mapCenter
      });

      var geocoder = new google.maps.Geocoder();

      locations.forEach(function(location) {
        geocodeAddress(geocoder, map, location.address);
      });
    } else {
      console.log('No farm locations found.');
    }
  }

  function geocodeAddress(geocoder, map, address) {
    geocoder.geocode({ 'address': address }, function(results, status) {
      if (status === 'OK') {
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
        });

        map.setCenter(results[0].geometry.location);
      } else {
        console.log('Geocode was not successful for the following reason: ' + status);
      }
    });
  }

  window.onload = initMap;
</script>
@include('user/footer')





   
  

    

    