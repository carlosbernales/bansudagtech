
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
                                <button id="generateReport" class="btn btn-lightgreen lightgreen-icon-notika">
                                    Report
                                </button>
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
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($farmers as $farmer)
                                <tr>
                                    <td>{{ $farmer->rsbsa }}</td>
                                    <td>{{ $farmer->fullname }}</td>
                                    <td>{{ $farmer->commodity }}</td>
                                    <td>{{ $farmer->farm_type }}{{ $farmer->livestock_type }}</td>
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewLocationModal-{{ $farmer->id }}" onclick="initMap('{{ $farmer->location }}', '{{ $farmer->id }}')">
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
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewDetails-{{ $farmer->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="viewDetails-{{ $farmer->id }}" tabindex="-1" aria-labelledby="viewDetailsLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewDetailsLabel">Farm Full Details</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>RSBSA:</strong> {{ $farmer->rsbsa }}</p>
                                                <p><strong>Email:</strong> {{ $farmer->email }}</p>
                                                <p><strong>Firstname:</strong> {{ $farmer->firstname }}</p>
                                                <p><strong>Middlename:</strong> {{ $farmer->middlename }}</p>
                                                <p><strong>Lastname:</strong> {{ $farmer->lastname }}</p>
                                                <p><strong>Suffix:</strong> {{ $farmer->suffix }}</p>
                                                <p><strong>Sex:</strong> {{ $farmer->sex }}</p>
                                                <p><strong>Birthdate:</strong> {{ \Carbon\Carbon::parse($farmer->birthdate)->format('F d, Y') }}</p>
                                                <p><strong>Contact:</strong> {{ $farmer->contact }}</p>
                                                <p><strong>4Ps:</strong> {{ $farmer->fourps }}</p>
                                                <p><strong>Indigenous:</strong> {{ $farmer->indigenous }}</p>
                                                <p><strong>PWD:</strong> {{ $farmer->pwd }}</p>
                                                <p><strong>Commodity:</strong> {{ $farmer->commodity }}</p>
                                                <p><strong>Crop Type:</strong> {{ $farmer->farm_type ?? 'N/A' }}</p>
                                                <p><strong>Animal Type:</strong> {{ $farmer->livestock_type ?? 'N/A' }}</p>
                                                <p><strong>Type of Farm:</strong> {{ $farmer->forms_farm ?? 'N/A' }}</p>
                                                <p><strong>Region:</strong> {{ $farmer->region }}</p>
                                                <p><strong>Province:</strong> {{ $farmer->province }}</p>
                                                <p><strong>Municipality:</strong> {{ $farmer->municipality }}</p>
                                                <p><strong>Barangay:</strong> {{ $farmer->barangay	 }}</p>
                                                <p><strong>Farm Area:</strong> {{ $farmer->farm_area }}</p>
                                                <p><strong>Area Planted:</strong> {{ $farmer->area_planted }}</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Location -->
                                <div class="modal fade" id="viewLocationModal-{{ $farmer->id }}" tabindex="-1" aria-labelledby="viewLocationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewLocationModalLabel">Farm Location</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div id="map-{{ $farmer->id }}" style="height: 400px; width: 100%;"></div>
                                                <p id="location-name-{{ $farmer->id }}">{{ $farmer->location }}</p>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script async defer src="googlemapsAPI.js"></script>

<script>

document.getElementById("generateReport").addEventListener("click", function () {
    const tableData = [
        ['SYSTEM GENERATED RSBSA NUMBER', 'LASTNAME', 'FIRSTNAME', 'MIDDLENAME', 'SUFFIX', 'BARANGAY', 'MUNICIPALITY', 'PROVINCE', 'REGION', 'BIRTHDATE', 
        'SEX', 'CONTACT NO', '4Ps', 'INDIGENOUS', 'PWD', 'FARM AREA', 'AREA PLANTED', 'COMMODITY'],
        @foreach($farmers as $farmer)
        [
            '{{ $farmer->rsbsa }}',
            '{{ $farmer->lastname }}',
            '{{ $farmer->firstname }}',
            '{{ $farmer->middlename }}',
            '{{ $farmer->suffix }}',
            '{{ $farmer->barangay }}',
            '{{ $farmer->municipality }}',
            '{{ $farmer->province }}',
            '{{ $farmer->region }}',
            '{{ $farmer->birthdate }}',
            '{{ $farmer->sex }}',
            '{{ $farmer->contact }}',
            '{{ $farmer->fourps }}',
            '{{ $farmer->indigenous }}',
            '{{ $farmer->pwd }}',
            '{{ $farmer->farm_area }}',
            '{{ $farmer->area_planted }}',
            '{{ $farmer->farm_type }}{{ $farmer->livestock_type }}',
        ],
        @endforeach
    ];

    const worksheet = XLSX.utils.aoa_to_sheet(tableData);

    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Farmers Report");

    XLSX.writeFile(workbook, "Farmers_Report.xlsx");
});

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
/////////////////////////////////////////
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


////////////////////////////////////////////



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
