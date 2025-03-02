
@include('admin/header')

<style>
.custom-swal-size {
    max-width: 400px; /* Adjust the width */
    padding: 1rem;   /* Adjust padding */
}

.custom-swal-size .swal2-title {
    font-size: 1rem; /* Adjust title font size */
}

.custom-swal-size .swal2-content {
    font-size: 0.9rem; /* Adjust text font size */
}
</style>
<!-- Breadcomb area End-->
<!-- Data Table area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="card-header" style="display: flex; justify-content: space-between;">
                            <h2>Announcements</h2>
                            <button class="btn btn-lightgreen lightgreen-icon-notika"  data-toggle="modal" data-target="#addAnnouncementModal">+ Announcement</button>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th style="width: 5%; text-align: center;">
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($announcement as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->content }}</td>
                                        <td>
                                        <form action="{{ url('/delete_announcement/'.$announcement->id) }}" method="POST" id="delete-form-{{ $announcement->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $announcement->id }})" style="background-color: transparent; border: none;">
                                                <i class="bi bi-trash" style="color: #dc3545; font-size: 18px;"></i> <!-- Bootstrap icon with danger color and custom size -->
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addAnnouncementModal" role="dialog">
        <div class="modal-dialog modal-md"> <!-- Increased the size to modal-lg for more space -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Announcement</h4>
                </div>
                <div class="modal-body">
                    <form action="/add_announcement" method="POST" id="addAnnc">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter Content" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success submit" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div id="map" style="display: none; height: 330px; width: 100%;"></div>
<script async defer src="googlemapsAPI.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('addAnnc').addEventListener('submit', function (event) {
   
    Swal.fire({
        title: 'Please Wait!',
        text: 'Announcement is sending to all farmers.',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            popup: 'custom-swal-size',
        },
    });
});

</script>
<script>
    window.onload = function () {
        if (typeof google !== 'undefined' && google.maps) {
            initMap(); // Ensure Google Maps API is available before calling initMap
        } else {
            console.error("Google Maps API failed to load.");
        }
    };
    
    function initMap() {
        // Full farm data
        const farms = @json($farms); 
        const defaultLocation = @json($defaultLocation);

        // Extract locations from the full farm data
        const farmLocations = farms.map(farm => farm.location);

        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: defaultLocation }, (results, status) => {
            if (status === "OK") {
                const map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: results[0].geometry.location
                });

                farmLocations.forEach((address, index) => {
                    geocoder.geocode({ address: address }, (results, status) => {
                        if (status === "OK") {
                            const position = results[0].geometry.location;

                            // Fetch weather data and add marker with temperature label
                            fetchWeather(position.lat(), position.lng(), (temp) => {
                                const marker = new google.maps.Marker({
                                    map: map,
                                    position: position,
                                    title: address,
                                    label: temp + '°C'
                                });

                                const infowindow = new google.maps.InfoWindow({
                                    content: `<p>${address}</p><p>Temperature: ${temp}°C</p>`
                                });

                                marker.addListener('click', () => {
                                    infowindow.open(map, marker);
                                });

                                // Send weather data and farm details to the backend only if temp < -7°C or temp > 29°C
                                if (temp < -7 || temp > 28) {
                                    sendWeatherAlert(farms[index], temp);
                                }
                            });
                        } else {
                            console.error(`Geocode was not successful for the following reason: ${status}`);
                        }
                    });
                });
            } else {
                console.error(`Geocode was not successful for the default location: ${status}`);
            }
        });
    }

    function fetchWeather(lat, lng, callback) {
        const apiKey = "4e89cb6596765628fd6138f58d7454e1";
        const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.main && data.main.temp !== undefined) {
                    callback(data.main.temp);
                } else {
                    console.log('Weather data not found for location.');
                    callback('N/A');
                }
            })
            .catch(error => {
                console.error('Error fetching weather:', error);
                callback('N/A');
            });
    }

    function sendWeatherAlert(farm, temperature) {
        const data = {
            id: farm.id,
            email: farm.email,
            commodity: farm.commodity,
            farm_type: farm.farm_type,
            livestock_type: farm.livestock_type,
            user_id: farm.user_id,
            temperature: temperature
        };

        fetch('/weather-alert', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.success) {
                console.log('Weather alert successfully submitted!');
            } else {
                console.log('Failed to submit weather alert:', responseData.message);
            }
        })
        .catch(error => {
            console.error('Error sending weather alert:', error);
        });
    }
</script>
<script>
	alertify.set('notifier', 'position', 'top-right');

	@if(session('success'))
		alertify.success('{{ session('success') }}');
	@endif

	@if(session('alertify_error'))
		alertify.error('{{ session('alertify_error') }}');
	@endif
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form after confirmation
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

    <!-- Data Table area End-->

    @include('admin/footer')
