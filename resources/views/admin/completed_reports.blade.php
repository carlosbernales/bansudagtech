
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
                                        <th>Details</th>
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
                                    <td>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#viewDetails-{{ $calamity->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
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
                                                <p><strong>Assistance Received:</strong> {{ $calamity->assistance_type }}</p>
                                                <p><strong>Date Provided:</strong> {{ $calamity->date_provided }}</p>
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Generate</button>
                    </div>
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
            // Filter the response to include only reports where the status is 'Completed'
            const completedReports = response.data.filter(report => report.status === 'Completed');
            generateExcel(completedReports, fromDate, toDate); // Pass only completed reports
        },
        error: function(xhr, status, error) {
            alert('Error generating report');
        }
    });
});



function generateExcel(data, fromDate, toDate) {
    const ws_data = [
        ['CALAMITY', 'TYPE OF AFFECTED FARMER (Individual/Group)', 'NAME OF AFFECTED FARMER/FOCAL', 'HEADER 4', 'HEADER 5', 'HEADER 6', 'HEADER 7', 'HEADER 8', 
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

    data.forEach(report => {
        ws_data.push([ 
            report.calamity_type, report.farmer_type, report.rsbsa, report.lastname, report.firstname, report.middlename, report.suffix, report.birthdate, report.region, report.province, report.municipality, 
            report.barangay, report.org_name, report.tot_male, report.tot_female, report.sex, report.indigenous, report.tribe_name, 
            report.pwd, report.arb, report.fourps, report.crop_type, report.partially_damage, 
            report.totally_damage, report.total_area, report.livestock_type, report.animal_type, report.age_class, report.no_heads, 
            report.remarks, report.assistance_type, report.date_provided, report.date_reported
        ]);
    });

    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Calamity Report');

    ws['!merges'] = [
        { s: { r: 0, c: 0 }, e: { r: 3, c: 0 } }, // Merge A1 to A4
        { s: { r: 0, c: 1 }, e: { r: 3, c: 1 } }, // Merge B1 to B4
        { s: { r: 0, c: 2 }, e: { r: 0, c: 6 } },  // Merge C1 to G1
        { s: { r: 1, c: 2 }, e: { r: 2, c: 6 } },  // Merge C2 to G3
        { s: { r: 0, c: 7 }, e: { r: 3, c: 7 } },  // Merge H1 to H4 for DATE OF BIRTH
        { s: { r: 0, c: 8 }, e: { r: 2, c: 11 } }, // Merge I1 to L3 for FARM LOCATION / ORGANIZATION LOCATION ADDRESS
        { s: { r: 0, c: 12 }, e: { r: 0, c: 14 } }, // Merge M1 to O1 for GROUP BENEFICIARY
        { s: { r: 1, c: 13 }, e: { r: 2, c: 14 } },  // Merge N2 to O3 for TOTAL NUMBER OF
        { s: { r: 1, c: 12 }, e: { r: 3, c: 12 } },  // Merge M2 to M4 for NAME OF ORGANIZATION
        { s: { r: 0, c: 15 }, e: { r: 3, c: 15 } },  // Merge P1 to P4 for SEX
        { s: { r: 0, c: 16 }, e: { r: 2, c: 17 } },  // Merge Q1 to R3 for INDIGENOUS PEOPLE
        { s: { r: 0, c: 18 }, e: { r: 3, c: 18 } },  // Merge S1 to S4 for PWD
        { s: { r: 0, c: 19 }, e: { r: 3, c: 19 } },  // Merge T1 to T4 for ARB
        { s: { r: 0, c: 20 }, e: { r: 3, c: 20 } },  // Merge U1 to U4 for 4Ps
        { s: { r: 0, c: 21 }, e: { r: 0, c: 28 } },  // Merge V1 to AC1 for DETAILS OF DAMAGED AND LOSSES
        { s: { r: 1, c: 21 }, e: { r: 2, c: 24 } }, // Merge V2 to Y3 for CROP
        { s: { r: 1, c: 25 }, e: { r: 2, c: 28 } },
        { s: { r: 0, c: 29 }, e: { r: 3, c: 29 } },
        { s: { r: 0, c: 30 }, e: { r: 3, c: 30 } }, 
        { s: { r: 0, c: 31 }, e: { r: 3, c: 31 } }, // Merge AF1 to AF4 for DATE PROVIDED
        { s: { r: 0, c: 32 }, e: { r: 3, c: 32 } },
    ];

    ws['A1'] = { v: 'CALAMITY', t: 's' }; // Set value for A1 to A4
    ws['B1'] = { v: 'TYPE OF AFFECTED FARMER (Individual/Group)', t: 's' }; // Set value for B1 to B4
    ws['C1'] = { v: 'NAME OF AFFECTED FARMER/FOCAL', t: 's' }; // Set value for C1 to G1
    ws['C2'] = { v: 'NAME OF BENEFICIARY (for Individual) ORGANIZATION\'s FOCAL PERSON NAME (for Group)', t: 's' }; // Set value for C2 to G3
    ws['H1'] = { v: 'DATE OF BIRTH', t: 's' }; // Set value for H1 to H4
    ws['I1'] = { v: 'FARM LOCATION / ORGANIZATION LOCATION ADDRESS', t: 's' }; // Set value for I1 to L3
    ws['M1'] = { v: 'GROUP BENEFICIARY', t: 's' }; // Set value for M1 to O1
    ws['N2'] = { v: 'TOTAL NUMBER OF', t: 's' }; // Set value for N2 to O3
    ws['M2'] = { v: 'NAME OF ORGANIZATION', t: 's' }; // Set value for M2 to M4
    ws['P1'] = { v: 'SEX', t: 's' }; // Set value for P1 to P4
    ws['Q1'] = { v: 'INDIGENOUS PEOPLE', t: 's' }; // Set value for Q1 to R3
    ws['S1'] = { v: 'PWD', t: 's' }; // Set value for S1 to S4
    ws['T1'] = { v: 'ARB', t: 's' }; // Set value for T1 to T4
    ws['U1'] = { v: '4Ps', t: 's' }; // Set value for U1 to U4
    ws['V1'] = { v: 'DETAILS OF DAMAGED AND LOSSES', t: 's' }; // Set value for V1 to AC1
    ws['V2'] = { v: 'CROP', t: 's' }; // Set value for V2 to Y3
    ws['Z2'] = { v: 'LIVESTOCK', t: 's' };
    ws['AD1'] = { v: 'REMARKS', t: 's' };
    ws['AE1'] = { v: 'ASSISTANCE PROVIDED', t: 's' };
    ws['AF1'] = { v: 'DATE PROVIDED', t: 's' }; // Set value for AF1 to AF4
    ws['AG1'] = { v: 'DATE REPORTED', t: 's' };

    const fileName = `completed_calamity_report_${fromDate}_to_${toDate}.xlsx`; // Set dynamic filename
    XLSX.writeFile(wb, fileName);
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
