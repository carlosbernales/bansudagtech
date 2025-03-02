
@include('admin/header')

    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="card-header" style="display: flex; justify-content: space-between;">
                                <h2>Ongoing Reports</h2>
                                <button id="update-status-btn" class="btn btn-lightgreen lightgreen-icon-notika" style="display: none;">
                                    <i class="notika-icon notika-checked"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                        <th>RSBSA</th>
                                        <th>Full Name</th>
                                        <th>Farm Type</th>
                                        <th>Location</th>
                                        <th>Proof Image</th>
                                        <th>Date Reported</th>
                                        <th>Details</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($calamities as $calamity)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="row-checkbox" value="{{ $calamity->id }}">
                                    </td>
                                    <td>{{ $calamity->rsbsa }}</td>
                                    <td>{{ $calamity->fullname }}</td>
                                    <td>{{ $calamity->crop_type }}{{ $calamity->animal_type }}</td>
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewLocationModal-{{ $calamity->id }}" onclick="initMap('{{ $calamity->location }}', '{{ $calamity->id }}')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($calamity->calamityImages->isNotEmpty())
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewImageModal-{{ $calamity->id }}">
                                            <i class="bi bi-eye"></i> 
                                        </button>
                                        @else
                                        No Images
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($calamity->date_reported)->format('F d, Y') }}</td>
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewDetails-{{ $calamity->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                    <td><button type="button" class="btn btn-lightgreen lightgreen-icon-notika" data-toggle="modal" data-target="#addRemarks{{ $calamity->id }}">
                                        <i class="notika-icon notika-checked"></i>
                                    </button></td>
                                </tr>
                                
                                
                                <!-- Modal -->
                                <div class="modal fade" id="addRemarks{{ $calamity->id }}" tabindex="-1" role="dialog" aria-labelledby="addRemarksLabel{{ $calamity->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-between align-items-center">
                                                <h5 class="modal-title" id="addRemarksLabel{{ $calamity->id }}"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form inside the modal with action moved here -->
                                                <form action="/updateToCompleted/{{ $calamity->id }}" method="POST" id="modalForm{{ $calamity->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="remarks">Remarks</label>
                                                        <input type="text" class="form-control" name="remarks" value="{{ $calamity->remarks }}" oninput="this.value = this.value.toUpperCase()">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <!-- Save changes button inside modal -->
                                                <button type="submit" class="btn btn-primary" form="modalForm{{ $calamity->id }}">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="viewDetails-{{ $calamity->id }}" tabindex="-1" aria-labelledby="viewDetailsLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewDetailsLabel">Calamity Details</h5>
                                            </div>
                                            <div class="modal-body">
                                                @if(!empty($calamity->rsbsa))
                                                <p><strong>RSBSA:</strong> {{ $calamity->rsbsa }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->calamity_type))
                                                <p><strong>Calamity Type:</strong> {{ $calamity->calamity_type }}</p>
                                                @endif
                                                 
                                                @if(!empty($calamity->farmer_type))
                                                <p><strong>Farmer Type:</strong> {{ $calamity->farmer_type }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->birthdate))
                                                <p><strong>Birthdate:</strong> {{ $calamity->birthdate }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->region))
                                                <p><strong>Region:</strong> {{ $calamity->region }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->province))
                                                <p><strong>Province:</strong> {{ $calamity->province }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->municipality))
                                                <p><strong>Municipality:</strong> {{ $calamity->municipality }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->barangay))
                                                <p><strong>Barangay:</strong> {{ $calamity->barangay }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->org_name))
                                                <p><strong>Organization Name:</strong> {{ $calamity->org_name }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->tot_male))
                                                <p><strong>Total Male:</strong> {{ $calamity->tot_male }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->tot_female))
                                                <p><strong>Total Female:</strong> {{ $calamity->tot_female }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->sex))
                                                <p><strong>Sex:</strong> {{ $calamity->sex }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->indigenous))
                                                <p><strong>Indigenous:</strong> {{ $calamity->indigenous }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->tribe_name))
                                                <p><strong>Tribe Name:</strong> {{ $calamity->tribe_name }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->pwd))
                                                <p><strong>PWD:</strong> {{ $calamity->pwd }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->arb))
                                                <p><strong>ARB:</strong> {{ $calamity->arb }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->fourps))
                                                <p><strong>4Ps:</strong> {{ $calamity->fourps }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->crop_type))
                                                <p><strong>Crop Type:</strong> {{ $calamity->crop_type }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->partially_damage))
                                                <p><strong>Partially Damaged:</strong> {{ $calamity->partially_damage }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->totally_damage))
                                                <p><strong>Totally Damaged:</strong> {{ $calamity->totally_damage }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->total_area))
                                                <p><strong>Total Area:</strong> {{ $calamity->total_area }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->livestock_type))
                                                <p><strong>Livestock Type:</strong> {{ $calamity->livestock_type }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->animal_type))
                                                <p><strong>Animal Type:</strong> {{ $calamity->animal_type }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->age_class))
                                                <p><strong>Age Class:</strong> {{ $calamity->age_class }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->no_heads))
                                                <p><strong>No. of Heads:</strong> {{ $calamity->no_heads }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->remarks))
                                                <p><strong>Remarks:</strong> {{ $calamity->remarks }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->lastname))
                                                <p><strong>Last Name:</strong> {{ $calamity->lastname }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->firstname))
                                                <p><strong>First Name:</strong> {{ $calamity->firstname }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->middlename))
                                                <p><strong>Middle Name:</strong> {{ $calamity->middlename }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->suffix))
                                                <p><strong>Suffix:</strong> {{ $calamity->suffix }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->fullname))
                                                <p><strong>Full Name:</strong> {{ $calamity->fullname }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->email))
                                                <p><strong>Email:</strong> {{ $calamity->email }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->assistance_type))
                                                <p><strong>Assistance given:</strong> {{ $calamity->assistance_type }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->other_assistances))
                                                <p><strong>Other assistance given:</strong> {{ $calamity->other_assistances }}</p>
                                                @endif
                                                
                                                @if(!empty($calamity->date_provided))
                                                <p><strong>Date Provided:</strong> {{ $calamity->date_provided }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Modal for Location -->
                                <div class="modal fade" id="viewLocationModal-{{ $calamity->id }}" tabindex="-1" aria-labelledby="viewLocationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewLocationModalLabel">Farm Location</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div id="map-{{ $calamity->id }}" style="height: 400px; width: 100%;"></div>
                                                <p id="location-name-{{ $calamity->id }}">{{ $calamity->location }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal for Image -->
                                <div class="modal fade" id="viewImageModal-{{ $calamity->id }}" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewImageModalLabel">{{ $calamity->farm_type }} Images</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <div id="imageNumber{{ $calamity->id }}" class="text-center mb-2">
                                                            <span id="currentImageIndex{{ $calamity->id }}">1</span> / 
                                                            <span id="totalImages{{ $calamity->id }}">{{ count($calamity->calamityImages) }}</span>
                                                        </div>
                                                        @foreach ($calamity->calamityImages as $index => $image)
                                                            <div class="image-gallery-item {{ $index == 0 ? 'active' : '' }}" style="display: {{ $index == 0 ? 'block' : 'none' }};" data-index="{{ $index }}">
                                                                <img src="{{ asset('calamity_images/' . $image->image) }}" alt="Farm Image" class="img-fluid" style="max-width: 100%; max-height: 400px; object-fit: contain;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="nextImageBtn">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div id="weather_alert_map" style="display: none; height: 330px; width: 100%;"></div>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-6lStYy7YLcsM1hg5Po9DuUht8N-eO1Y&callback=initMap" async defer></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.onload = function () {
        if (typeof google !== 'undefined' && google.maps) {
            initFarmWeatherMap(); // Updated function name
        } else {
            console.error("Google Maps API failed to load.");
        }
    };

    function initFarmWeatherMap() {
        const farms = @json($farms);
        const defaultLocation = @json($defaultLocation);
        const farmLocations = farms.map(farm => farm.location);
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: defaultLocation }, (results, status) => {
            if (status === "OK") {
                const map = new google.maps.Map(document.getElementById('weather_alert_map'), {
                    zoom: 10,
                    center: results[0].geometry.location
                });

                farmLocations.forEach((address, index) => {
                    geocoder.geocode({ address: address }, (results, status) => {
                        if (status === "OK") {
                            const position = results[0].geometry.location;

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

                                if (temp < -7 || temp > 28) {
                                    sendWeatherAlert(farms[index], temp);
                                }
                            });
                        } else {
                            console.error(`Geocode was not successful for: ${status}`);
                        }
                    });
                });
            } else {
                console.error(`Geocode failed for default location: ${status}`);
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
                    callback('N/A');
                }
            })
            .catch(() => callback('N/A'));
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
                console.log('Weather alert submitted successfully.');
            } else {
                console.log('Failed to submit weather alert.');
            }
        })
        .catch(() => console.error('Error sending weather alert.'));
    }
</script>
<script>
    alertify.set('notifier', 'position', 'top-right');

    @if(session('success'))
        alertify.success('{{ session('success') }}');
    @endif

    @if(session('error'))
        alertify.error('{{ session('error') }}');
    @endif
    
</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const updateBtn = document.getElementById('update-status-btn');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const selectAll = document.getElementById('select-all');

    const toggleButton = () => {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        updateBtn.style.display = anyChecked ? 'inline-block' : 'none';
    };

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleButton);
    });

    selectAll.addEventListener('change', () => {
        const isChecked = selectAll.checked;
        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        toggleButton();
    });

    updateBtn.addEventListener('click', () => {
        const selectedIds = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        if (selectedIds.length > 0) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/multipleUpdateToCompleted';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrfInput);

            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    });
});




//////////////////////////////////////////////////////////////////////////
    
function initMap(location, calamityId) {
    console.log("Location:", location); 

    var geocoder = new google.maps.Geocoder();

    if (location) {
        geocoder.geocode({ 'address': location }, function(results, status) {
            if (status == 'OK') {
                var map = new google.maps.Map(document.getElementById('map-' + calamityId), {
                    center: results[0].geometry.location,
                    zoom: 15
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });

                document.getElementById('location-name-' + calamityId).innerHTML = results[0].formatted_address;
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    } 
}

///////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
    $('.modal').on('show.bs.modal', function (e) {
        const modal = $(this);
        const images = modal.find('.image-gallery-item');
        const modalId = modal.attr('id').split('-')[1];
        let currentIndex = 0;

        images.hide().first().show();
        $('#currentImageIndex' + modalId).text(1);
        $('#totalImages' + modalId).text(images.length);

        modal.find('#nextImageBtn').off('click').on('click', function () {
            images.eq(currentIndex).hide();
            currentIndex = (currentIndex + 1) % images.length; 
            images.eq(currentIndex).show();
            $('#currentImageIndex' + modalId).text(currentIndex + 1);
        });
    });
});



///////////////////////////////////////
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
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>


<!-- Data Table area End-->

@include('admin/footer')
