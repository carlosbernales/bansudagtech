
@include('user/header')

    

   

<section class="pb-5">
    <div class="container-lg">
        <!-- Section Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between my-4">
                    <h2 class="section-title">Calamity Reports</h2>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addFarmModal">Add Report</a>
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
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addFarmModal">Add Report</a>
                    </div>
                @else
                    @foreach ($calamities as $calamity)
                        <div class="col">
                            <div class="product-item">
                                <!-- Thumbnail -->
                                <figure>
                                    <a href="#" title="{{ $calamity->farm_type }}" data-bs-toggle="modal" data-bs-target="#viewImageModal{{ $calamity->id }}">
                                        @if($calamity->crop_type !== 'NULL')
                                            <img src="animal.png" alt="Livestock Thumbnail" class="tab-image">
                                        @elseif($calamity->animal !== 'NULL')
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
                                                <button type="button" class="btn btn-link">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>

                                            <div class="col-7">
                                                <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" data-location="{{ $calamity->location }}" data-bs-toggle="modal" data-bs-target="#viewlocationReport">
                                                    View Location
                                                </a>
                                            </div>
                                            <div class="col-2">
                                            <form action="/delete_farm/{{ $calamity->id }}" method="POST" id="delete-form-{{ $calamity->id }}">
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
                @endif
                </div>
            </div>
        </div>
        <!-- / Farms Grid -->
    </div>
</section>




<!-- Add Farm Modal -->
<div class="modal fade" id="addFarmModal" tabindex="-1" aria-labelledby="addFarmModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFarmModalLabel">Send Calamity Report</h5>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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



document.addEventListener("DOMContentLoaded", function() {
    const modals = document.querySelectorAll('.modal');

    modals.forEach(modal => {
        const nextButton = modal.querySelector('.btn-primary'); // Next button for each modal

        nextButton.addEventListener("click", function() {
            const images = modal.querySelectorAll('.image-gallery-item'); // Get all images in the modal
            let activeImage = modal.querySelector('.image-gallery-item.active'); // Find the currently active image

            let nextImage = activeImage ? activeImage.nextElementSibling : images[0];
            if (!nextImage) {
                nextImage = images[0]; // If no next image, loop back to the first one
            }

            activeImage.classList.remove('active');
            activeImage.style.display = 'none';

            nextImage.classList.add('active');
            nextImage.style.display = 'block';

            const currentIndex = Array.from(images).indexOf(nextImage) + 1;
            const modalId = modal.getAttribute('id').replace('viewImageModal', '');
            document.getElementById('currentImageIndex' + modalId).textContent = currentIndex; // Update current image number
        });
    });

    modals.forEach(modal => {
        const images = modal.querySelectorAll('.image-gallery-item');
        images.forEach((image, index) => {
            if (index !== 0) {
                image.classList.remove('active');
                image.style.display = 'none'; // Hide all except the first
            }
        });

        const modalId = modal.getAttribute('id').replace('viewImageModal', '');
        document.getElementById('currentImageIndex' + modalId).textContent = 1; // Start with the first image
    });
});


//////////////////////////////////////////////////

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
                modal.hide();
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





   
  

    

    