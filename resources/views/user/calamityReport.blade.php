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
                                                <tr><td>RSBSA</td><td>{{ $calamity->rsbsa }}</td></tr>
                                                <tr><td>Calamity Type</td><td>{{ $calamity->calamity_type }}</td></tr>
                                                <tr><td>Farmer Type</td><td>{{ $calamity->farmer_type }}</td></tr>
                                                <tr><td>Birthdate</td><td>{{ $calamity->birthdate }}</td></tr>
                                                <tr><td>Region</td><td>{{ $calamity->region }}</td></tr>
                                                <tr><td>Province</td><td>{{ $calamity->province }}</td></tr>
                                                <tr><td>Municipality</td><td>{{ $calamity->municipality }}</td></tr>
                                                <tr><td>Barangay</td><td>{{ $calamity->barangay }}</td></tr>
                                                <tr><td>Organization Name</td><td>{{ $calamity->org_name }}</td></tr>
                                                <tr><td>Total Male</td><td>{{ $calamity->tot_male }}</td></tr>
                                                <tr><td>Total Female</td><td>{{ $calamity->tot_female }}</td></tr>
                                                <tr><td>Sex</td><td>{{ $calamity->sex }}</td></tr>
                                                <tr><td>Indigenous</td><td>{{ $calamity->indigenous }}</td></tr>
                                                <tr><td>Tribe Name</td><td>{{ $calamity->tribe_name }}</td></tr>
                                                <tr><td>PWD</td><td>{{ $calamity->pwd }}</td></tr>
                                                <tr><td>ARB</td><td>{{ $calamity->arb }}</td></tr>
                                                <tr><td>4Ps</td><td>{{ $calamity->fourps }}</td></tr>
                                                <tr><td>Crop Type</td><td>{{ $calamity->crop_type }}</td></tr>
                                                <tr><td>Partially Damaged (ha)</td><td>{{ $calamity->partially_damage }}</td></tr>
                                                <tr><td>Totally Damaged (ha)</td><td>{{ $calamity->totally_damage }}</td></tr>
                                                <tr><td>Total Area (ha)</td><td>{{ $calamity->total_area }}</td></tr>
                                                <tr><td>Livestock Type</td><td>{{ $calamity->livestock_type }}</td></tr>
                                                <tr><td>Animal Type</td><td>{{ $calamity->animal_type }}</td></tr>
                                                <tr><td>Age Class</td><td>{{ $calamity->age_class }}</td></tr>
                                                <tr><td>No. of Heads</td><td>{{ $calamity->no_heads }}</td></tr>
                                                <tr><td>Remarks</td><td>{{ $calamity->remarks }}</td></tr>
                                                <tr><td>Last Name</td><td>{{ $calamity->lastname }}</td></tr>
                                                <tr><td>First Name</td><td>{{ $calamity->firstname }}</td></tr>
                                                <tr><td>Middle Name</td><td>{{ $calamity->middlename }}</td></tr>
                                                <tr><td>Suffix</td><td>{{ $calamity->suffix }}</td></tr>
                                                <tr><td>Full Name</td><td>{{ $calamity->fullname }}</td></tr>
                                                <tr><td>Location</td><td>{{ $calamity->location }}</td></tr>
                                                <tr><td>Assistance Type</td><td>{{ $calamity->assistance_type }}</td></tr>
                                                <tr><td>Date Provided</td><td>{{ $calamity->date_provided }}</td></tr>
                                                <tr><td>Status</td><td>{{ $calamity->status }}</td></tr>
                                                <tr><td>Email</td><td>{{ $calamity->email }}</td></tr>
                                                <tr><td>Date Reported</td><td>{{ \Carbon\Carbon::parse($calamity->date_reported)->format('F j, Y') }}</td></tr>
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
      <form method="POST" action="/submit_calamity_report" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="calamity_type">Calamity</label>
                <input type="text" class="form-control" id="calamity_type" name="calamity_type" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" readonly data-bs-toggle="modal" data-bs-target="#locationModal">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="crop_type">Type of Crop</label>
                <input type="text" class="form-control" id="crop_type" name="crop_type" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="partially_damage">Partially Damaged Area (ha)</label>
                <input type="text" class="form-control" id="partially_damage" name="partially_damage" >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="totally_damage">Totally Damaged Area (ha)</label>
                <input type="text" class="form-control" id="totally_damage" name="totally_damage" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="total_area">Total Area Affected (ha)</label>
                <input type="text" class="form-control" id="total_area" name="total_area" >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="livestock_type">Type of Farm</label>
                <input type="text" class="form-control" id="livestock_type" name="livestock_type" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="animal_type">Animal Type</label>
                <input type="text" class="form-control" id="animal_type" name="animal_type" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="age_class">Age Classification</label>
                <input type="text" class="form-control" id="age_class" name="age_class" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="no_heads">No of Heads Affected</label>
                <input type="text" class="form-control" id="no_heads" name="no_heads" >
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="image">Proof Image</label>
                <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Submit</button>
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





<script async defer src="googlemapsAPI.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modalId = '{{ $calamity->id ?? null }}'; // Set modalId to null if $calamity->id is not available
    const calamityImages = {!! json_encode($calamity->calamityImages ?? []) !!}; // Handle empty or null calamityImages
    const totalImages = calamityImages.length;
    let currentIndex = 0;

    if (!modalId || totalImages === 0) {
        return; // Exit early if no calamity data or no images
    }

    const nextButton = document.getElementById(`nextImageBtn${modalId}`);
    const currentImageIndexSpan = document.getElementById(`currentImageIndex${modalId}`);
    
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

document.getElementById("viewlocationReport").addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const location = button.getAttribute("data-location"); // Get the location from data-location attribute
    initViewMap(location); // Initialize the map with the location
});

////////////////////////////////////////////////////////////////////


let map;
let geocoder;
let markers = [];
const farms = @json($farms); // Fetch farms data passed from the controller.

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 10.3157, lng: 123.8854 }, // Default center (Cebu City, Philippines)
        zoom: 8,
    });

    geocoder = new google.maps.Geocoder();

    farms.forEach(farm => {
        geocodeFarm(farm);
    });

    document.getElementById('locationSearch').addEventListener('input', searchMarkers);
}

function geocodeFarm(farm) {
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

            });
        } else {
            console.error("Geocode was not successful for the following reason: " + status);
        }
    });
}

function searchMarkers() {
    const query = document.getElementById('locationSearch').value.toLowerCase();
    let found = false;

    markers.forEach(({ marker, farm }) => {
        if (farm.location.toLowerCase().includes(query)) {
            marker.setVisible(true);
            map.setCenter(marker.getPosition());
            map.setZoom(12); // Set the zoom level to 12 for a more detailed view
            found = true;
        } else {
            marker.setVisible(false); // Hide the marker if it doesn't match the search
        }
    });

    if (!found && query) {
        map.setCenter({ lat: 10.3157, lng: 123.8854 }); // Default center (Cebu City)
        map.setZoom(8); // Zoom out to a default level
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





   
  

    

    