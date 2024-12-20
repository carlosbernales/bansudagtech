
@include('user/header')

    

   

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
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <span class="text-dark fw-semibold">{{ $farmer->commodity }}</span>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3"></div>
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
                                                    <div class="image-gallery-item {{ $index == 0 ? 'active' : '' }}" style="display: {{ $index == 0 ? 'block' : 'none' }};" data-index="{{ $index }}">
                                                        <img src="{{ asset('farms_images/' . $image->image) }}" alt="Farm Image" class="img-fluid" style="max-width: 100%; max-height: 400px; object-fit: contain;">
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
  <div class="modal-dialog">
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
        <div class="mb-3">
            <label for="commodity" class="form-label">Commodity</label>
            <select class="form-control" id="commodity" name="commodity" required>
            <option value="">Select</option>
            <option value="CROP">CROP</option>
            <option value="LIVESTOCK">LIVESTOCK</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="farm_type" class="form-label">Farm Type</label>
            <input type="text" class="form-control" id="farm_type" name="farm_type" placeholder="eg: RICE or PIG" required>
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


<script async defer src="googlemapsAPI.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    alertify.set('notifier', 'position', 'top-right');

    @if(session('success'))
        alertify.success('{{ session('success') }}');
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
            console.log('Confirmed delete for ID:', id);
            document.getElementById('delete-form-' + id).submit();
        }
    });
}




    
    
document.addEventListener("DOMContentLoaded", function() {
    const modals = document.querySelectorAll('.modal');

    modals.forEach(modal => {
        const nextButton = modal.querySelector('.btn-primary'); // Next button for each modal

        nextButton.addEventListener("click", function() {
            const images = modal.querySelectorAll('.image-gallery-item'); // Get all images in the modal
            let activeImage = modal.querySelector('.image-gallery-item.active'); // Find the currently active image

            // Get the next image or loop back to the first image if the last one is reached
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




let map, marker, geocoder;

function initMap() {
  geocoder = new google.maps.Geocoder();
  const defaultLocation = { lat: -34.397, lng: 150.644 }; // Default location

  map = new google.maps.Map(document.getElementById("map"), {
    center: defaultLocation,
    zoom: 8,
  });

  marker = new google.maps.Marker({
    map: map,
    position: defaultLocation,
  });

  const searchBox = new google.maps.places.SearchBox(document.getElementById("mapSearch"));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchBox);

  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();
    if (places.length === 0) return;

    const place = places[0];
    if (!place.geometry || !place.geometry.location) return;

    map.setCenter(place.geometry.location);
    map.setZoom(15);
    marker.setPosition(place.geometry.location);

    updateLocationInput(place.geometry.location);
  });

  map.addListener("click", (event) => {
    const clickedLocation = event.latLng;
    marker.setPosition(clickedLocation);
    updateLocationInput(clickedLocation);
  });
}

function updateLocationInput(location) {
  geocoder.geocode({ location }, (results, status) => {
    if (status === "OK" && results[0]) {
      document.getElementById("location").value = results[0].formatted_address;
    }
  });
}

document.getElementById("saveLocation").addEventListener("click", () => {
  const mapModalElement = document.getElementById("mapModal");
  const mapModalInstance = bootstrap.Modal.getInstance(mapModalElement);
  mapModalInstance.hide();

  const addFarmModalElement = document.getElementById("addFarmModal");
  const addFarmModalInstance = bootstrap.Modal.getInstance(addFarmModalElement);
  if (addFarmModalInstance) {
    addFarmModalInstance.show();
  }
});







// For viewing farm location
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





   
  

    

    