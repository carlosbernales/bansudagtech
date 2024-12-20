
@include('admin/header')


	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="card-header" style="display: flex; justify-content: space-between;">
                                <h2>Farmers Farm</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>RSBSA</th>
                                        <th>Full Name</th>
                                        <th>Commodity</th>
                                        <th>Farm Type</th>
                                        <th>Location</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($farmers as $farmer)
                                <tr>
                                    <td>{{ $farmer->rsbsa }}</td>
                                    <td>{{ $farmer->fullname }}</td>
                                    <td>{{ $farmer->commodity }}</td>
                                    <td>{{ $farmer->farm_type }}</td>
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewLocationModal-{{ $farmer->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($farmer->farmImages->isNotEmpty())
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewImageModal-{{ $farmer->id }}">
                                            <i class="bi bi-eye"></i> 
                                        </button>
                                        @else
                                        No Images
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal for Location -->
                                <div class="modal fade" id="viewLocationModal-{{ $farmer->id }}" tabindex="-1" aria-labelledby="viewLocationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewLocationModalLabel">Farm Location</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div id="map-{{ $farmer->id }}" style="height: 400px; width: 100%;"></div>
                                                <p id="location-address-{{ $farmer->id }}"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Image -->
                                <div class="modal fade" id="viewImageModal-{{ $farmer->id }}" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewImageModalLabel">{{ $farmer->farm_type }} Images</h5>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUlV2s9XbLAsllvpPnFoxkznXbdFqUXK4&callback=initMap"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Initialize the Google Map when a location modal is shown
    $('.modal').on('shown.bs.modal', function (e) {
        const modalId = $(this).attr('id');
        if (modalId.startsWith('viewLocationModal')) {
            const farmerId = modalId.split('-')[1];
            const location = '{{ $farmer->location }}'; // Fetch location dynamically

            if (location) {
                geocodeAddress(location, farmerId);
            }
        }
    });

    function geocodeAddress(address, farmerId) {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: address }, function (results, status) {
            if (status === 'OK') {
                const map = new google.maps.Map(document.getElementById('map-' + farmerId), {
                    zoom: 16,
                    center: results[0].geometry.location,
                });
                new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                });
                document.getElementById('location-address-' + farmerId).textContent = results[0].formatted_address;
            } else {
                alert('Geocode was not successful: ' + status);
            }
        });
    }

    // Image Carousel Logic
    $('.modal').on('show.bs.modal', function (e) {
        const modal = $(this);
        const images = modal.find('.image-gallery-item');
        const modalId = modal.attr('id').split('-')[1];
        let currentIndex = 0;

        // Show the first image
        images.hide().first().show();
        $('#currentImageIndex' + modalId).text(1);
        $('#totalImages' + modalId).text(images.length);

        // Next Button Logic
        modal.find('#nextImageBtn').off('click').on('click', function () {
            images.eq(currentIndex).hide();
            currentIndex = (currentIndex + 1) % images.length; // Loop to the first image
            images.eq(currentIndex).show();
            $('#currentImageIndex' + modalId).text(currentIndex + 1);
        });
    });
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
            // Submit the form after confirmation
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

<script>
    alertify.set('notifier', 'position', 'top-right');

    @if(session('success'))
        alertify.success('{{ session('success') }}');
    @endif
</script>
<!-- Data Table area End-->

@include('admin/footer')
