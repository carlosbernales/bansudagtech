
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
                                <h2>Completed Reports</h2>
                                <button class="btn btn-lightgreen lightgreen-icon-notika" data-toggle="modal" data-target="#generateReportModal">
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
                                        <th>Farm Type</th>
                                        <th>Location</th>
                                        <th>Proof Image</th>
                                        <th>Assistance</th>
                                        <th>Date Provided</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($calamities as $calamity)
                                <tr>
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
                                    <td>{{ $calamity->assistance_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($calamity->date_provided)->format('F j, Y') }}</td>
                                    <td><form action="/updateToOngoing/{{ $calamity->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-lightgreen lightgreen-icon-notika">
                                            <i class="notika-icon notika-checked"></i>
                                        </button>
                                    </form></td>
                                    

                                </tr>

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


    <!-- Modal -->
<div class="modal fade" id="generateReportModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Generate Report</h4>
            </div>
            <div class="modal-body">
                <form id="reportForm">
                    <div class="form-group">
                        <label for="fromDate">From:</label>
                        <input type="date" class="form-control" id="fromDate" name="from_date">
                    </div>
                    <div class="form-group">
                        <label for="toDate">To:</label>
                        <input type="date" class="form-control" id="toDate" name="to_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script async defer src="googlemapsAPI.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Include SheetJS (xlsx) library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<!-- Include jQuery if not already included -->

<!-- Include Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
    $('#fromDate').flatpickr({
        dateFormat: 'Y-m-d', // This ensures it's in the correct format
    });
    $('#toDate').flatpickr({
        dateFormat: 'Y-m-d',
    });
});

$('#reportForm').submit(function(e) {
    e.preventDefault();

    let fromDate = $('#fromDate').val();
    let toDate = $('#toDate').val();

    // Ensure the dates are in the correct format
    console.log('From Date:', fromDate);
    console.log('To Date:', toDate);

    $.ajax({
        url: '/fetch-calamity-reports', // Route to fetch filtered reports
        method: 'POST',
        data: {
            from_date: fromDate,
            to_date: toDate,
            _token: '{{ csrf_token() }}', // CSRF token for security
        },
        success: function(response) {
            generateExcel(response.data);
        },
        error: function(xhr, status, error) {
            alert('Error generating report');
        }
    });
});


function generateExcel(data) {
    const ws_data = [
        // First row (merged cells A1 to A4 and B1 to B4 will contain their respective values)
        ['CALAMITY', 'TYPE OF AFFECTED FARMER (Individual/Group)', 'HEADER 3', 'HEADER 4', 'HEADER 5', 'HEADER 6', 'HEADER 7', 'HEADER 8', 
        'HEADER 9', 'HEADER 10', 'HEADER 11', 'HEADER 12', 'HEADER 13', 'HEADER 14', 'HEADER 15', 'HEADER 16',
        'HEADER 17', 'HEADER 18', 'HEADER 19', 'HEADER 20', 'HEADER 21', 'HEADER 22', 'HEADER 23', 'HEADER 24', 
        'HEADER 25', 'HEADER 26', 'HEADER 27', 'HEADER 28', 'HEADER 29', 'HEADER 30', 'HEADER 31', 'HEADER 32', 'HEADER 33'],
        // Second row
        ['VALUE 1', 'VALUE 2', 'VALUE 3', 'VALUE 4', 'VALUE 5', 'VALUE 6', 'VALUE 7', 'VALUE 8',
        'VALUE 9', 'VALUE 10', 'VALUE 11', 'VALUE 12', 'VALUE 13', 'VALUE 14', 'VALUE 15', 'VALUE 16', 
        'VALUE 17', 'VALUE 18', 'VALUE 19', 'VALUE 20', 'VALUE 21', 'VALUE 22', 'VALUE 23', 'VALUE 24', 
        'VALUE 25', 'VALUE 26', 'VALUE 27', 'VALUE 28', 'VALUE 29', 'VALUE 30', 'VALUE 31', 'VALUE 32', 'VALUE 33'],
        // Third row
        ['DETAIL 1', 'DETAIL 2', 'DETAIL 3', 'DETAIL 4', 'DETAIL 5', 'DETAIL 6', 'DETAIL 7', 'DETAIL 8',
        'DETAIL 9', 'DETAIL 10', 'DETAIL 11', 'DETAIL 12', 'DETAIL 13', 'DETAIL 14', 'DETAIL 15', 'DETAIL 16', 
        'DETAIL 17', 'DETAIL 18', 'DETAIL 19', 'DETAIL 20', 'DETAIL 21', 'DETAIL 22', 'DETAIL 23', 'DETAIL 24', 
        'DETAIL 25', 'DETAIL 26', 'DETAIL 27', 'DETAIL 28', 'DETAIL 29', 'DETAIL 30', 'DETAIL 31', 'DETAIL 32', 'DETAIL 33'],
        // Column headers
        ['CALAMITY', 'TYPE OF AFFECTED FARMER (Individual or Group)', 'RSBSA REFERENCE NUMBER', 'SURNAME', 'FIRSTNAME', 'MIDDLENAME', 'EXTENSION NAME', 'DATE OF BIRTH', 
        'REGION', 'PROVINCE', 'MUNICIPALITY', 'BARANGAY', 'NAME OF ORGANIZATION', 'MALE', 'FEMALE', 'SEX', 'INDIGENOUS', 'NAME OF TRIBE',
        'PWD', 'ARB', '4Ps', 'TYPE OF CROP', 'PARTIALLY DAMAGED AREA (ha)', 'TOTALLY DAMAGED AREA (ha)', 'TOTAL AREA AFFECTED (ha)', 
        'TYPE OF FARM', 'ANIMAL TYPE', 'AGE CLASSIFICATION', 'NO OF HEADS AFFECTED', 'REMARKS', 'ASSISTANCE PROVIDED', 'DATE PROVIDED', 'DATE REPORTED']
    ];

    // Add the data to the worksheet
    data.forEach(report => {
        ws_data.push([ 
            report.calamity_type, report.farmer_type, report.rsbsa, report.lastname, report.firstname, report.middlename, 
            report.suffix, report.birthdate, report.region, report.province, report.municipality, report.barangay, 
            report.org_name, report.tot_male, report.tot_female, report.sex, report.indigenous, report.tribe_name, 
            report.pwd, report.arb, report.fourps, report.crop_type, report.partially_damage, 
            report.totally_damage, report.total_area, report.livestock_type, report.animal_type, report.age_class, report.no_heads, 
            report.remarks, report.assistance_type, report.date_provided, report.date_reported
        ]);
    });

    // Create a new workbook and add the data
    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Calamity Report');

    // Merge cells A1 to A4 and B1 to B4 and set the values
    ws['!merges'] = [
        { s: { r: 0, c: 0 }, e: { r: 3, c: 0 } }, // Merge A1 to A4
        { s: { r: 0, c: 1 }, e: { r: 3, c: 1 } }  // Merge B1 to B4
    ];

    // Set the values for the merged cells
    ws['A1'] = { v: 'CALAMITY', t: 's' }; // Set value for A1 to A4
    ws['B1'] = { v: 'TYPE OF AFFECTED FARMER (Individual/Group)', t: 's' }; // Set value for B1 to B4

    // Export the Excel file
    XLSX.writeFile(wb, 'calamity_report.xlsx');
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
