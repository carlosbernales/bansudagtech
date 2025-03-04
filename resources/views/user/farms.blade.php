@include('user.header', ['notificationCount' => $notificationCount, 'notifications' => $notifications])


<section class="pb-5">
    <div class="container-lg">
        <!-- Section Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between my-4">
                    <h2 class="section-title">My Farms</h2>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addFarmModal">Add Farm</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Farms Grid -->
        <div class="row">
            <div class="col-md-12">
                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                @if($farmers->isEmpty())
                    <div class="text-center mt-5">
                        <h4>No farms found</h4>
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addFarmModal">Add Farm</a>
                    </div>
                @else
                    @foreach ($farmers as $farmer)
                        <div class="col">
                            <div class="product-item">
                                <!-- Thumbnail -->
                                <figure>
                                    <a href="#" title="{{ $farmer->farm_type }}" data-bs-toggle="modal" data-bs-target="#viewImageModal{{ $farmer->id }}">
                                        @if($farmer->commodity == 'LIVESTOCK')
                                            <img src="animal.png" alt="Livestock Thumbnail" class="tab-image">
                                        @elseif($farmer->commodity == 'CROP')
                                            <img src="crop.png" alt="Crop Thumbnail" class="tab-image">
                                        @else
                                            <img src="default.png" alt="Default Thumbnail" class="tab-image">
                                        @endif
                                    </a>
                                </figure>
                                
                                <!-- Farm Details -->
                                <div class="d-flex flex-column text-center">
                                    <h3 class="fs-6 fw-normal">{{ $farmer->farm_type }}</h3>
                                    <h3 class="fs-6 fw-normal">{{ $farmer->livestock_type }}</h3>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <span class="text-dark fw-semibold">{{ $farmer->commodity }}</span>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewDetailsModal{{ $farmer->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            </div>

                                            <div class="col-7">
                                                <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" data-location="{{ $farmer->location }}" data-bs-toggle="modal" data-bs-target="#viewLocationModal">
                                                    View Location
                                                </a>
                                            </div>
                                            <div class="col-2">
                                            <form action="/delete_farm/{{ $farmer->id }}" method="POST" id="delete-form-{{ $farmer->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger rounded-1 p-2 fs-6" 
                                                    title="Delete" onclick="confirmDelete({{ $farmer->id }})">
                                                    <svg width="18" height="18">
                                                        <use xlink:href="#trash"></use>
                                                    </svg>
                                                </button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / Farm Details -->
                            </div>
                        </div>


                        <div class="modal fade" id="viewDetailsModal{{ $farmer->id }}" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewDetailsModalLabel">My Farm Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td>RSBSA</td><td>{{ $farmer->rsbsa }}</td></tr>
                                                <tr><td>Email</td><td>{{ $farmer->email }}</td></tr>
                                                <tr><td>Firstname</td><td>{{ $farmer->firstname }}</td></tr>
                                                <tr><td>Middlename</td><td>{{ $farmer->middlename }}</td></tr>
                                                <tr><td>Lastname</td><td>{{ $farmer->lastname }}</td></tr>
                                                <tr><td>Suffix</td><td>{{ $farmer->suffix }}</td></tr>
                                                <tr><td>Sex</td><td>{{ $farmer->sex }}</td></tr>
                                                <tr><td>Birthdate</td><td>{{ \Carbon\Carbon::parse($farmer->birthdate)->format('F d, Y') }}</td></tr>
                                                <tr><td>Contact</td><td>{{ $farmer->contact }}</td></tr>
                                                <tr><td>4Ps</td><td>{{ $farmer->fourps }}</td></tr>
                                                <tr><td>Indigenous</td><td>{{ $farmer->indigenous }}</td></tr>
                                                <tr><td>PWD</td><td>{{ $farmer->pwd }}</td></tr>
                                                <tr><td>Commodity</td><td>{{ $farmer->commodity }}</td></tr>
                                                <tr><td>Crop Type</td><td>{{ $farmer->farm_type ?? 'N/A' }}</td></tr>
                                                <tr><td>Animal Type</td><td>{{ $farmer->livestock_type ?? 'N/A' }}</td></tr>
                                                <tr><td>Type of Farm</td><td>{{ $farmer->forms_farm ?? 'N/A' }}</td></tr>
                                                <tr><td>Region</td><td>{{ $farmer->region }}</td></tr>
                                                <tr><td>Province</td><td>{{ $farmer->province }}</td></tr>
                                                <tr><td>Municipality</td><td>{{ $farmer->municipality }}</td></tr>
                                                <tr><td>Barangay</td><td>{{ $farmer->barangay }}</td></tr>
                                                <tr><td>Farm Area</td><td>{{ $farmer->farm_area }}</td></tr>
                                                <tr><td>Area Planted</td><td>{{ $farmer->area_planted }}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Viewing Image -->
                        <div class="modal fade" id="viewImageModal{{ $farmer->id }}" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewImageModalLabel">{{ $farmer->farm_type }} Images</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <div id="imageNumber{{ $farmer->id }}" class="text-center mb-2">
                                                    <span id="currentImageIndex{{ $farmer->id }}">1</span> / 
                                                    <span id="totalImages{{ $farmer->id }}">{{ count($farmer->farmImages) }}</span>
                                                </div>
                                                @foreach ($farmer->farmImages as $index => $image)
                                                    <div class="image-gallery-item {{ $index == 0 ? 'active' : '' }}" 
                                                        style="display: {{ $index == 0 ? 'block' : 'none' }};" 
                                                        data-index="{{ $index }}">
                                                        <img src="{{ asset('farms_images/' . $image->image) }}" alt="Farm Image" 
                                                            class="img-fluid" style="max-width: 100%; max-height: 400px; object-fit: contain;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="nextImageBtn{{ $farmer->id }}">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
        <!-- / Farms Grid -->
    </div>
</section>




<!-- Add Farm Modal -->
<div class="modal fade" id="addFarmModal" tabindex="-1" aria-labelledby="addFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog modals-default" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFarmModalLabel">Add Farm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/add_farms" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="location" class="form-label">Farm Location</label>
            <div class="input-group">
            <input type="text" class="form-control" id="location" name="location" readonly required>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#mapModal">Select Location</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control" value="IV-B"  name="region" oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="col-md-6 mb-3">
                <label for="municipality" class="form-label">Municipality</label>
                <select class="form-control" id="municipality" name="municipality" onchange="updateBarangays()">
                    <option value="">Select Municipality</option>
                    @foreach($municipalities as $municipality => $barangays)
                        <option value="{{ $municipality }}">{{ $municipality }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control"  value="ORIENTAL MINDORO" name="province" oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="col-md-6 mb-3">
                <label for="barangay" class="form-label">Barangay</label>
                <select class="form-control" id="barangay" name="barangay">
                    <option value="">Select Barangay</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="farm_area" class="form-label">Farm Area</label>
                <input type="text" class="form-control" id="farm_area" name="farm_area" oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="col-md-6 mb-3">
                <label for="area_planted" class="form-label">Area Planted</label>
                <input type="text" class="form-control" id="area_planted" name="area_planted" >
            </div>
        </div>
        
        <div class="mb-3">
            <label for="commodity" class="form-label">Commodity</label>
            <select class="form-control" id="commodity" name="commodity" required>
                <option value="">Select</option>
                <option value="CROP">CROP</option>
                <option value="LIVESTOCK">LIVESTOCK</option>
            </select>
        </div>

        <div class="mb-3" id="farmTypeDiv" style="display: none;">
            <label for="forms_farm" class="form-label">Farm Type</label>
            <select class="form-control" id="forms_farm" name="forms_farm">
                <option value="">Select</option>
                <option value="BACKYARD">BACKYARD</option>
                <option value="COMMERCIAL">COMMERCIAL</option>
                <option value="SEMI-COMMERCIAL">SEMI-COMMERCIAL</option>
            </select>
        </div>

        <div class="mb-3" id="livestockTypeDiv"  style="display: none;">
            <label for="livestock_type" class="form-label">Livestock Type</label>
            <input type="text" class="form-control" id="livestock_type" name="livestock_type" placeholder="eg: PIG" oninput="this.value = this.value.toUpperCase()">
        </div>

        <div class="mb-3" id="cropTypeDiv"  style="display: none;">
            <label for="farm_type" class="form-label">Crop Type</label>
            <input type="text" class="form-control" id="farm_type" name="farm_type" placeholder="eg: RICE" oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Images</label>
            <input type="file" class="form-control" id="image" name="image[]" multiple required>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Google Maps Modal for Adding Farm Location -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel">Select Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="mapSearch" class="form-control mb-3" placeholder="Search location...">
        <div id="map" style="width: 100%; height: 400px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveLocation">Okay</button>
      </div>
    </div>
  </div>
</div>

<!-- Google Maps Modal for Viewing Location -->
<div class="modal fade" id="viewLocationModal" tabindex="-1" aria-labelledby="viewLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLocationModalLabel">Farm Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewMap" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>


 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-6lStYy7YLcsM1hg5Po9DuUht8N-eO1Y&callback=initMap" async defer></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  
    const municipalitiesData = @json($municipalities);

    function updateBarangays() {
        const municipality = document.getElementById('municipality').value;
        const barangaySelect = document.getElementById('barangay');
        
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (municipality) {
            const barangays = municipalitiesData[municipality];
            barangays.forEach(function(barangay) {
                const option = document.createElement('option');
                option.value = barangay;
                option.textContent = barangay;
                barangaySelect.appendChild(option);
            });
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(isset($farmers) && count($farmers) > 0)
            @foreach($farmers as $farmer)
                (function() {
                    const modalId = '{{ $farmer->id }}';
                    const totalImages = {{ count($farmer->farmImages ?? []) }};
                    let currentIndex = 0;

                    const nextButton = document.getElementById(`nextImageBtn${modalId}`);
                    const currentImageIndexSpan = document.getElementById(`currentImageIndex${modalId}`);

                    if (nextButton && currentImageIndexSpan) {
                        nextButton.addEventListener("click", function() {
                            if (currentIndex < totalImages - 1) {
                                currentIndex++;
                                updateImageDisplay();
                            } else {
                                currentIndex = 0;
                                updateImageDisplay();
                            }
                        });

                        function updateImageDisplay() {
                            const images = document.querySelectorAll(`#viewImageModal${modalId} .image-gallery-item`);
                            if (images.length === 0) {
                                return;
                            }

                            images.forEach(function(image) {
                                image.style.display = 'none';
                            });

                            const activeImage = document.querySelector(`#viewImageModal${modalId} .image-gallery-item[data-index="${currentIndex}"]`);
                            if (activeImage) {
                                activeImage.style.display = 'block';
                            }

                            currentImageIndexSpan.textContent = currentIndex + 1;
                        }
                    }
                })();
            @endforeach
        @else
            console.warn("Farmers data is not available.");
        @endif
    });
</script>

<script>
    alertify.set('notifier', 'position', 'top-right');

    @if(session('success'))
        alertify.success('{{ session('success') }}');
    @endif
</script>

<script>

document.getElementById('commodity').addEventListener('change', function () {
    const farmTypeDiv = document.getElementById('farmTypeDiv');
    const livestockTypeDiv = document.getElementById('livestockTypeDiv');
    const cropTypeDiv = document.getElementById('cropTypeDiv');
    
    document.getElementById('forms_farm').value = "";
    document.getElementById('livestock_type').value = "";
    document.getElementById('farm_type').value = "";

    if (this.value === 'LIVESTOCK') {
        farmTypeDiv.style.display = 'block'; // Hide the "Farm Type" dropdown
        livestockTypeDiv.style.display = 'block'; // Show the "Livestock Type" input
        cropTypeDiv.style.display = 'none'; // Hide the "Crop Type" input
    } else if (this.value === 'CROP') {
        farmTypeDiv.style.display = 'none'; // Show the "Farm Type" dropdown
        livestockTypeDiv.style.display = 'none'; // Hide the "Livestock Type" input
        cropTypeDiv.style.display = 'block'; // Show the "Crop Type" input
    } else {
        farmTypeDiv.style.display = 'none'; // Hide both
        livestockTypeDiv.style.display = 'none';
        cropTypeDiv.style.display = 'none';
    }
});


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
            console.log('Confirmed delete for ID:', id);
            document.getElementById('delete-form-' + id).submit();
        }
    });
}




    
    






window.onload = function () {
    if (typeof google !== 'undefined' && google.maps) {
        initMap(); 
    } else {
        console.error("Google Maps API failed to load.");
    }
};

let map;
let marker;
let geocoder;

function initMap() {
    const initialLocation = { lat: 12.8578, lng: 121.4526 }; 

    map = new google.maps.Map(document.getElementById('map'), {
        center: initialLocation,
        zoom: 12,
    });

    geocoder = new google.maps.Geocoder();

    marker = new google.maps.Marker({
        position: initialLocation,
        map: map,
        draggable: true, 
    });

    google.maps.event.addListener(marker, 'dragend', function () {
        const position = marker.getPosition();
        getAddressFromLatLng(position);  
    });

    const input = document.getElementById('mapSearch');
    
    input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            geocodeAddress(input.value);  
        }
    });

    google.maps.event.addListener(map, 'click', function (event) {
        const clickedLocation = event.latLng;

        marker.setPosition(clickedLocation);

        getAddressFromLatLng(clickedLocation);
    });
}

function geocodeAddress(address) {
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status === 'OK') {
            const location = results[0].geometry.location;
            map.setCenter(location);  
            marker.setPosition(location);  
            getAddressFromLatLng(location);  
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function getAddressFromLatLng(latLng) {
    geocoder.geocode({ 'location': latLng }, function (results, status) {
        if (status === 'OK') {
            if (results[0]) {
                document.getElementById('location').value = results[0].formatted_address;

                $('#addFarmModal').modal('show');  
            } else {
                alert('No address found for this location.');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}

document.getElementById('saveLocation').addEventListener('click', function () {
    const locationValue = document.getElementById('location').value;
    if (locationValue) {
        console.log('Selected Address:', locationValue);
        $('#mapModal').modal('hide'); 
    } else {
        alert('Please select a location on the map.');
    }
});






/////////////////////////////////////////////////////////////

let viewMap, viewMarker, viewGeocoder;

function initViewMap(location) {
    viewGeocoder = new google.maps.Geocoder();
    
    viewMap = new google.maps.Map(document.getElementById("viewMap"), {
        center: { lat: -34.397, lng: 150.644 }, // Default to somewhere
        zoom: 8,
    });

    viewMarker = new google.maps.Marker({
        map: viewMap,
        position: { lat: -34.397, lng: 150.644 }, // Default marker position
    });

    viewGeocoder.geocode({ address: location }, (results, status) => {
        if (status === "OK") {
            const location = results[0].geometry.location;
            viewMap.setCenter(location);
            viewMarker.setPosition(location);
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

document.getElementById("viewLocationModal").addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const location = button.getAttribute("data-location"); // Get the location from data-location attribute
    initViewMap(location); // Initialize the map with the location
});


</script>


@include('user/footer')





   
  

    

    