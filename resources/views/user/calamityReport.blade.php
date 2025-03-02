@include('user.header', ['notificationCount' => $notificationCount, 'notifications' => $notifications])

    

<section class="pb-5">
    <div class="container-lg">
        <!-- Section Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between my-4">
                    <h2 class="section-title">Pending Reports</h2>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddReportModal">Add Report</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Farms Grid -->
        <div class="row">
            <div class="col-md-12">
                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                @if($calamities->isEmpty())
                    <div class="text-center mt-5">
                        <h4>No report found</h4>
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddReportModal">Add Report</a>
                    </div>
                @else
                    @foreach ($calamities as $calamity)
                        <div class="col">
                            <div class="product-item">
                                <!-- Thumbnail -->
                                <figure>
                                    <a href="#" title="{{ $calamity->farm_type }}" data-bs-toggle="modal" data-bs-target="#viewImageModal{{ $calamity->id }}">
                                        @if($calamity->crop_type == '')
                                            <img src="animal.png" alt="Livestock Thumbnail" class="tab-image">
                                        @elseif($calamity->animal_type == '')
                                            <img src="crop.png" alt="Crop Thumbnail" class="tab-image">
                                        @else
                                            <img src="default.png" alt="Default Thumbnail" class="tab-image">
                                        @endif
                                    </a>
                                </figure>
                                
                                <!-- Farm Details -->
                                <div class="d-flex flex-column text-center">
                                    <h3 class="fs-6 fw-normal">{{ \Carbon\Carbon::parse($calamity->date_reported)->format('F j, Y') }}</h3>

                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <span class="text-dark fw-semibold">{{ $calamity->crop_type }}</span>
                                        <span class="text-dark fw-semibold">{{ $calamity->animal_type }}</span>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewDetailsModal{{ $calamity->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            </div>

                                            <div class="col-7">
                                                <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" data-location="{{ $calamity->location }}" data-bs-toggle="modal" data-bs-target="#viewlocationReport">
                                                    View Location
                                                </a>
                                            </div>
                                            <div class="col-2">
                                            <form action="/delete_report/{{ $calamity->id }}" method="POST" id="delete-form-{{ $calamity->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger rounded-1 p-2 fs-6" 
                                                    title="Delete" onclick="confirmDelete({{ $calamity->id }})">
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

                        <div class="modal fade" id="viewDetailsModal{{ $calamity->id }}" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewDetailsModalLabel">Calamity Report Details</h5>
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
                                                @if(!empty($calamity->rsbsa))
                                                <tr><td>RSBSA</td><td>{{ $calamity->rsbsa }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->calamity_type))
                                                <tr><td>Calamity Type</td><td>{{ $calamity->calamity_type }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->farmer_type))
                                                <tr><td>Farmer Type</td><td>{{ $calamity->farmer_type }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->birthdate))
                                                <tr><td>Birthdate</td><td>{{ $calamity->birthdate }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->region))
                                                <tr><td>Region</td><td>{{ $calamity->region }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->province))
                                                <tr><td>Province</td><td>{{ $calamity->province }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->municipality))
                                                <tr><td>Municipality</td><td>{{ $calamity->municipality }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->barangay))
                                                <tr><td>Barangay</td><td>{{ $calamity->barangay }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->org_name))
                                                <tr><td>Organization Name</td><td>{{ $calamity->org_name }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->tot_male))
                                                <tr><td>Total Male</td><td>{{ $calamity->tot_male }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->tot_female))
                                                <tr><td>Total Female</td><td>{{ $calamity->tot_female }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->sex))
                                                <tr><td>Sex</td><td>{{ $calamity->sex }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->indigenous))
                                                <tr><td>Indigenous</td><td>{{ $calamity->indigenous }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->tribe_name))
                                                <tr><td>Tribe Name</td><td>{{ $calamity->tribe_name }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->pwd))
                                                <tr><td>PWD</td><td>{{ $calamity->pwd }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->arb))
                                                <tr><td>ARB</td><td>{{ $calamity->arb }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->fourps))
                                                <tr><td>4Ps</td><td>{{ $calamity->fourps }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->crop_type))
                                                <tr><td>Crop Type</td><td>{{ $calamity->crop_type }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->partially_damage))
                                                <tr><td>Partially Damaged (ha)</td><td>{{ $calamity->partially_damage }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->totally_damage))
                                                <tr><td>Totally Damaged (ha)</td><td>{{ $calamity->totally_damage }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->total_area))
                                                <tr><td>Total Area (ha)</td><td>{{ $calamity->total_area }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->livestock_type))
                                                <tr><td>Livestock Type</td><td>{{ $calamity->livestock_type }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->animal_type))
                                                <tr><td>Animal Type</td><td>{{ $calamity->animal_type }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->age_class))
                                                <tr><td>Age Class</td><td>{{ $calamity->age_class }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->no_heads))
                                                <tr><td>No. of Heads</td><td>{{ $calamity->no_heads }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->remarks))
                                                <tr><td>Remarks</td><td>{{ $calamity->remarks }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->lastname))
                                                <tr><td>Last Name</td><td>{{ $calamity->lastname }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->firstname))
                                                <tr><td>First Name</td><td>{{ $calamity->firstname }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->middlename))
                                                <tr><td>Middle Name</td><td>{{ $calamity->middlename }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->suffix))
                                                <tr><td>Suffix</td><td>{{ $calamity->suffix }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->fullname))
                                                <tr><td>Full Name</td><td>{{ $calamity->fullname }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->location))
                                                <tr><td>Location</td><td>{{ $calamity->location }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->assistance_type))
                                                <tr><td>Assistance Type</td><td>{{ $calamity->assistance_type }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->date_provided))
                                                <tr><td>Date Provided</td><td>{{ $calamity->date_provided }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->email))
                                                <tr><td>Email</td><td>{{ $calamity->email }}</td></tr>
                                                @endif
                                                
                                                @if(!empty($calamity->date_reported))
                                                <tr><td>Date Reported</td><td>{{ \Carbon\Carbon::parse($calamity->date_reported)->format('F j, Y') }}</td></tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Viewing Image -->
                        <div class="modal fade" id="viewImageModal{{ $calamity->id }}" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewImageModalLabel">{{ $calamity->farm_type }} Images</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <div id="imageNumber{{ $calamity->id }}" class="text-center mb-2">
                                                    <span id="currentImageIndex{{ $calamity->id }}">1</span> / 
                                                    <span id="totalImages{{ $calamity->id }}">{{ count($calamity->calamityImages) }}</span>
                                                </div>
                                                @foreach ($calamity->calamityImages as $index => $image)
                                                    <div class="image-gallery-item {{ $index == 0 ? 'active' : '' }}" 
                                                        style="display: {{ $index == 0 ? 'block' : 'none' }};" 
                                                        data-index="{{ $index }}">
                                                        <img src="{{ asset('calamity_images/' . $image->image) }}" alt="Calamity Image" 
                                                            class="img-fluid" style="max-width: 100%; max-height: 400px; object-fit: contain;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="nextImageBtn{{ $calamity->id }}">Next</button>
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
<div class="modal fade" id="AddReportModal" tabindex="-1" aria-labelledby="AddReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddReportModalLabel">Send Calamity Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/submit_calamity_report" enctype="multipart/form-data" onsubmit="return validateLocationAndImage()">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="calamity_type">Calamity</label>
                            <select class="form-control" id="calamity_type" name="calamity_type" required>
                                <option value="" selected disabled>-- Select Calamity Type --</option>
                                <option value="DROUGHT">DROUGHT</option>
                                <option value="PEST AND DISEASES">PEST AND DISEASES</option>
                                <option value="FLOOD">FLOOD</option>
                                <option value="EXTREME TEMPERATURE">EXTREME TEMPERATURE</option>
                                <option value="HEAT STRESS">HEAT STRESS</option>
                                <option value="DROWNED">DROWNED</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" readonly data-bs-toggle="modal" data-bs-target="#locationModal" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3" id="crop_type_container">
                            <label for="crop_type">Type of Crop</label>
                            <input type="text" class="form-control" id="crop_type" name="crop_type" readonly onchange="toggleFields()">
                        </div>
                        <div class="col-md-6 mb-3" id="partially_damage_container">
                            <label for="partially_damage">Partially Damaged Area (ha)</label>
                            <input type="text" class="form-control" id="partially_damage" name="partially_damage" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3" id="totally_damage_container">
                            <label for="totally_damage">Totally Damaged Area (ha)</label>
                            <input type="text" class="form-control" id="totally_damage" name="totally_damage" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-6 mb-3" id="total_area_container">
                            <label for="total_area">Total Area Affected (ha)</label>
                            <input type="text" class="form-control" id="total_area" name="total_area" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3" id="livestock_type_container">
                            <label for="livestock_type">Type of Farm</label>   
                            <input type="text" class="form-control" id="livestock_type" name="livestock_type" readonly onchange="toggleFields()">
                        </div>
                        
                        <div class="col-md-6 mb-3" id="age_class_container">
                            <label for="age_class">Age Classification</label>
                            <input type="text" class="form-control" id="age_class" name="age_class" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-6 mb-3" id="animal_type_container">
                            <label for="animal_type" >Animal Type</label>
                            <input type="text" class="form-control" id="animal_type" name="animal_type" readonly>
                        </div>
                        
                        <div class="col-md-6 mb-3" id="no_heads_container">
                            <label for="no_heads">No of Heads Affected</label>
                            <input type="text" class="form-control" id="no_heads" name="no_heads" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image">Proof Image</label>
                            <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Select Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="locationSearch" class="form-control mb-3" placeholder="Search for a location">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewlocationReport" tabindex="-1" aria-labelledby="viewlocationReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewlocationReportLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="maps" style="height: 400px; width: 100%;"></div>
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
    document.addEventListener("DOMContentLoaded", function () {
        @if(isset($calamities) && count($calamities) > 0)
            @foreach($calamities as $calamity)
                (function() {
                    const modalId = '{{ $calamity->id }}';
                    const calamityImages = {!! json_encode($calamity->calamityImages ?? []) !!};
                    const totalImages = calamityImages.length;
                    let currentIndex = 0;

                    if (!modalId || totalImages === 0) {
                        return; 
                    }

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
            console.warn("No calamity data is available.");
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
let viewMap, viewMarker, viewGeocoder;

function initViewMap(location) {
    viewGeocoder = new google.maps.Geocoder();
    
    viewMap = new google.maps.Map(document.getElementById("maps"), {
        center: { lat: -34.397, lng: 150.644 }, 
        zoom: 8,
    });

    viewMarker = new google.maps.Marker({
        map: viewMap,
        position: { lat: -34.397, lng: 150.644 },
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

document.getElementById("viewlocationReport").addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    const location = button.getAttribute("data-location"); 
    initViewMap(location); 
});

////////////////////////////////////////////////////////////////////
function validateLocationAndImage() {
    const location = document.getElementById("location").value;
    const imageInput = document.getElementById("image");
    const files = imageInput.files;

    if (!location) {
        alert("Please select a location on the map.");
        return false; 
    }

    if (files.length === 0) {
        alert("Please upload at least one image.");
        return false; 
    }

    return true; 
}
//////////////////////////////////////////////////
window.onload = function () {
    if (typeof google !== 'undefined' && google.maps) {
        initMap(); 
    } else {
        console.error("Google Maps API failed to load.");
    }

    toggleFields();
};

function toggleFields() {
    const cropType = document.getElementById("crop_type").value;
    const livestockType = document.getElementById("livestock_type").value;
    const animalType = document.getElementById("animal_type").value;

    if (!cropType) {
        document.getElementById("crop_type_container").style.display = "none";
        document.getElementById("partially_damage_container").style.display = "none";
        document.getElementById("totally_damage_container").style.display = "none";
        document.getElementById("total_area_container").style.display = "none";

        clearInputs(["partially_damage_container", "totally_damage_container", "total_area_container"]);
    } else {
        document.getElementById("crop_type_container").style.display = "block";
        document.getElementById("partially_damage_container").style.display = "block";
        document.getElementById("totally_damage_container").style.display = "block";
        document.getElementById("total_area_container").style.display = "block";
    }

    if (!livestockType) {
        document.getElementById("livestock_type_container").style.display = "none";
        document.getElementById("animal_type_container").style.display = "none";
        document.getElementById("age_class_container").style.display = "none";
        document.getElementById("no_heads_container").style.display = "none";

        clearInputs(["age_class_container", "no_heads_container"]);
    } else {
        document.getElementById("livestock_type_container").style.display = "block";
        document.getElementById("animal_type_container").style.display = "block";
        document.getElementById("age_class_container").style.display = "block";
        document.getElementById("no_heads_container").style.display = "block";
    }

    if (!animalType) {
        document.getElementById("animal_type_container").style.display = "none";
    } else {
        document.getElementById("animal_type_container").style.display = "block";
    }
}

function clearInputs(containerIds) {
    containerIds.forEach(containerId => {
        const container = document.getElementById(containerId);
        const inputs = container.querySelectorAll("input, select, textarea");

        inputs.forEach(input => {
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            } else {
                input.value = "";
            }
        });
    });
}


let map;
let geocoder;
let markers = [];
const farms = @json($farms); 

function initMap() {
    geocoder = new google.maps.Geocoder();

    geocodeFarm(farms[0]).then(() => {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: markers[0].marker.getPosition().lat(), lng: markers[0].marker.getPosition().lng() }, // Set center to the first farm's coordinates
            zoom: 8,
        });

        farms.forEach(farm => {
            geocodeFarm(farm);
        });

        document.getElementById('locationSearch').addEventListener('input', searchMarkers);
    }).catch(error => {
        console.error("Error geocoding default farm:", error);
        
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 10.3157, lng: 123.8854 },
            zoom: 8,
        });
    });
}

function geocodeFarm(farm) {
    return new Promise((resolve, reject) => {
        geocoder.geocode({ address: farm.location }, (results, status) => {
            if (status === "OK") {
                const marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: farm.location,
                });

                markers.push({ marker, farm });

                marker.addListener("click", () => {
                    document.getElementById("location").value = farm.location;
                    document.getElementById("crop_type").value = farm.farm_type || '';
                    document.getElementById("animal_type").value = farm.livestock_type || '';
                    document.getElementById("livestock_type").value = farm.forms_farm || '';

                    const modal = bootstrap.Modal.getInstance(document.getElementById("locationModal"));
                    const modals = bootstrap.Modal.getInstance(document.getElementById("AddReportModal"));
                    modal.hide();
                    modals.show();

                    toggleFields();
                });

                resolve(); 
            } else {
                console.error("Geocode was not successful for the location: " + farm.location + ", reason: " + status);
                reject(status); 
            }
        });
    });
}

function searchMarkers() {
    const query = document.getElementById('locationSearch').value.toLowerCase();
    let found = false;

    markers.forEach(({ marker, farm }) => {
        if (farm.location.toLowerCase().includes(query)) {
            marker.setVisible(true);
            map.setCenter(marker.getPosition());
            map.setZoom(12); 
            found = true;
        } else {
            marker.setVisible(false); 
        }
    });

    if (!found && query) {
        map.setCenter({ lat: 10.3157, lng: 123.8854 }); 
        map.setZoom(8); 
    }
}




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
            console.log('Confirmed delete for ID:', id);
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

</script>


@include('user/footer')





   
  

    

    