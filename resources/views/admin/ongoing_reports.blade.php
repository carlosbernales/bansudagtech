
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
                                    <td><form action="/updateToCompleted/{{ $calamity->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-lightgreen lightgreen-icon-notika">
                                            <i class="notika-icon notika-checked"></i>
                                        </button>
                                    </form></td>
                                </tr>

                                <div class="modal fade" id="viewDetails-{{ $calamity->id }}" tabindex="-1" aria-labelledby="viewDetailsLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewDetailsLabel">Calamity Details</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>RSBSA:</strong> {{ $calamity->rsbsa }}</p>
                                                <p><strong>Calamity Type:</strong> {{ $calamity->calamity_type }}</p>
                                                <p><strong>Farmer Type:</strong> {{ $calamity->farmer_type }}</p>
                                                <p><strong>Birthdate:</strong> {{ $calamity->birthdate }}</p>
                                                <p><strong>Region:</strong> {{ $calamity->region }}</p>
                                                <p><strong>Province:</strong> {{ $calamity->province }}</p>
                                                <p><strong>Municipality:</strong> {{ $calamity->municipality }}</p>
                                                <p><strong>Barangay:</strong> {{ $calamity->barangay }}</p>
                                                <p><strong>Organization Name:</strong> {{ $calamity->org_name }}</p>
                                                <p><strong>Total Male:</strong> {{ $calamity->tot_male }}</p>
                                                <p><strong>Total Female:</strong> {{ $calamity->tot_female }}</p>
                                                <p><strong>Sex:</strong> {{ $calamity->sex }}</p>
                                                <p><strong>Indigenous:</strong> {{ $calamity->indigenous }}</p>
                                                <p><strong>Tribe Name:</strong> {{ $calamity->tribe_name }}</p>
                                                <p><strong>PWD:</strong> {{ $calamity->pwd }}</p>
                                                <p><strong>ARB:</strong> {{ $calamity->arb }}</p>
                                                <p><strong>4Ps:</strong> {{ $calamity->fourps }}</p>
                                                <p><strong>Crop Type:</strong> {{ $calamity->crop_type }}</p>
                                                <p><strong>Partially Damaged:</strong> {{ $calamity->partially_damage }}</p>
                                                <p><strong>Totally Damaged:</strong> {{ $calamity->totally_damage }}</p>
                                                <p><strong>Total Area:</strong> {{ $calamity->total_area }}</p>
                                                <p><strong>Livestock Type:</strong> {{ $calamity->livestock_type }}</p>
                                                <p><strong>Animal Type:</strong> {{ $calamity->animal_type }}</p>
                                                <p><strong>Age Class:</strong> {{ $calamity->age_class }}</p>
                                                <p><strong>No. of Heads:</strong> {{ $calamity->no_heads }}</p>
                                                <p><strong>Remarks:</strong> {{ $calamity->remarks }}</p>
                                                <p><strong>Last Name:</strong> {{ $calamity->lastname }}</p>
                                                <p><strong>First Name:</strong> {{ $calamity->firstname }}</p>
                                                <p><strong>Middle Name:</strong> {{ $calamity->middlename }}</p>
                                                <p><strong>Suffix:</strong> {{ $calamity->suffix }}</p>
                                                <p><strong>Full Name:</strong> {{ $calamity->fullname }}</p>
                                                <p><strong>Email:</strong> {{ $calamity->email }}</p>
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
