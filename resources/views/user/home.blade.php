@include('user.header', ['notificationCount' => $notificationCount, 'notifications' => $notifications])

    
   

<section class="py-5 overflow-hidden">
  <div class="container-lg">
    <div class="row">
      <!-- Column 1 -->
      <div class="col-md-4">
        <div class="p-3 border d-flex justify-content-between align-items-center">
          <!-- Text -->
          <p class="mb-0">You have {{ $farmCount }} farm(s)</p>
          <!-- Icon -->
          <img src="cropicon.png" alt="Farm Icon" style="width: 24px; height: 24px;">
        </div>
      </div>
      <!-- Column 2 -->
      <div class="col-md-4">
      <div class="p-3 border d-flex justify-content-between align-items-center">
          <!-- Text -->
          <p class="mb-0">You have {{ $totReports }} reported calamity</p>
          <!-- Icon -->
          <img src="calamity_icon.png" alt="Farm Icon" style="width: 24px; height: 24px;">
        </div>
      </div>
      <!-- Column 3 -->
      <div class="col-md-4">
      <div class="p-3 border d-flex justify-content-between align-items-center">
          <!-- Text -->
          <p class="mb-0">You received {{ $completedReports }} assistance</p>
          <!-- Icon -->
          <img src="assistance_icon.png" alt="Farm Icon" style="width: 24px; height: 24px;">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p>My Crop and Farms</p>
        <div id="map" style="height: 500px; width: 100%;"></div>
      </div>
    </div>
  </div>
</section>



    

   



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-6lStYy7YLcsM1hg5Po9DuUht8N-eO1Y&callback=initMap" async defer></script>
    
<script>
  function initMap() {
    var locations = @json($locations); // Server-side data

    // Default location: Bansud, Oriental Mindoro, Philippines
    var defaultCenter = { lat: 12.8575, lng: 121.4707 };

    var mapCenter = locations.length > 0 ? { lat: 0, lng: 0 } : defaultCenter;

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: locations.length > 0 ? 8 : 12, // Zoom adjusted for default location
        center: mapCenter
    });

    if (locations.length > 0) {
        var geocoder = new google.maps.Geocoder();

        locations.forEach(function(location) {
            geocodeAddress(geocoder, map, location.address);
        });
    } else {
        console.log('No farm locations found. Showing default location: Bansud, Oriental Mindoro, Philippines.');
    }
}

function geocodeAddress(geocoder, map, address) {
    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
            var position = results[0].geometry.location;

            fetchWeather(position.lat(), position.lng(), function(currentTemp, tomorrowTemp) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: position,
                    label: currentTemp + '°C' 
                });

                var infowindow = new google.maps.InfoWindow({
                    content: `<p>${address}</p>
                              <p>Current Temperature: ${currentTemp}°C</p>
                              <p>Tomorrow's Temperature: ${tomorrowTemp}°C</p>`
                });

                marker.addListener('click', () => {
                    infowindow.open(map, marker);
                });

                map.setCenter(position);
            });
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function fetchWeather(lat, lng, callback) {
    var apiKey = "4e89cb6596765628fd6138f58d7454e1";

    // Fetch current weather
    var currentWeatherUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`;

    // Fetch forecast
    var forecastWeatherUrl = `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`;

    var currentTemp = 'N/A';
    var tomorrowTemp = 'N/A';

    fetch(currentWeatherUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.main && data.main.temp !== undefined) {
                currentTemp = data.main.temp;
            }
        })
        .catch(error => console.error('Error fetching current weather:', error))
        .finally(() => {
            fetch(forecastWeatherUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.list) {
                        // Find tomorrow's weather using the timestamp
                        var tomorrowTimestamp = new Date();
                        tomorrowTimestamp.setDate(tomorrowTimestamp.getDate() + 1);

                        var tomorrowWeather = data.list.find(item => {
                            var itemDate = new Date(item.dt * 1000);
                            return itemDate.getDate() === tomorrowTimestamp.getDate();
                        });

                        if (tomorrowWeather && tomorrowWeather.main) {
                            tomorrowTemp = tomorrowWeather.main.temp;
                        }
                    }
                })
                .catch(error => console.error('Error fetching forecast weather:', error))
                .finally(() => {
                    // Call the callback with both temperatures
                    callback(currentTemp, tomorrowTemp);
                });
        });
}

window.onload = initMap;

</script>

@include('user/footer')





   
  

    

    