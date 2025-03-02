
@include('admin/header')

<style>
.status-badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: bold;
    color: white;
}

.active {
    background-color: green;
}

.inactive {
    background-color: red;
}

</style>
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="card-header" style="display: flex; justify-content: space-between;">
                            <h2>Farmer List</h2>
                            <button class="btn btn-lightgreen lightgreen-icon-notika" data-toggle="modal" data-target="#addFarmersModal">+ Farmer</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>RSBSA</th>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->rsbsa }}</td>
                                        <td>{{ $account->fullname }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->contact }}</td>
                                       <td>
                                            <span class="status-badge {{ $account->active_not == 'Active' ? 'active' : 'inactive' }}">
                                                {{ $account->active_not }}
                                            </span>
                                        </td>

                                        <td style="width: 15%; text-align: center;">
                                            @if($account->active_not == 'Active')
                                                <form action="{{ url('/archive_farmer/'.$account->id) }}" method="POST" id="archive-form-{{ $account->id }}" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmArchive({{ $account->id }})" style="background-color: transparent; border: none;">
                                                        <i class="bi bi-archive" style="color: #dc3545; font-size: 18px;"></i> <!-- Bootstrap archive icon -->
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ url('/active_farmer/'.$account->id) }}" method="POST" id="active-form-{{ $account->id }}" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmActive({{ $account->id }})" style="background-color: transparent; border: none;">
                                                        <i class="bi bi-person-check" style="color: green; font-size: 18px;"></i>
                                                    </button>
                                                </form>
                                            @endif


                                            <!-- Edit Icon -->
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $account->id }}" style="background-color: transparent; border: none;">
                                                <i class="bi bi-pencil" style="color: #007bff; font-size: 18px;"></i> <!-- Bootstrap icon with primary color and custom size -->
                                            </button>

                                            <form action="{{ url('/delete_farmer/'.$account->id) }}" method="POST" id="delete-form-{{ $account->id }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $account->id }})" style="background-color: transparent; border: none;">
                                                    <i class="bi bi-trash" style="color: #dc3545; font-size: 18px;"></i> <!-- Bootstrap icon with danger color and custom size -->
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $account->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $account->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $account->id }}">Edit Farmer</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/edit_farmer/'.$account->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="rsbsa">RSBSA</label>
                                                                <input type="text" class="form-control rsbsa-input" id="rsbsaID-{{ $account->id }}" name="rsbsa" value="{{ $account->rsbsa }}" oninput="this.value = this.value.toUpperCase()" required>
                                                                <small class="text-danger rsbsa-error" id="rsbsa-error-{{ $account->id }}" style="display: none;">
                                                                    RSBSA already exists.
                                                                </small>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="farmer_type">Type of Farmer</label>
                                                                <select class="form-control" id="farmer_type" name="farmer_type"> 
                                                                    <option value="{{ $account->farmer_type }}">{{ $account->farmer_type }}</option>
                                                                    <option value="INDIVIDUAL">INDIVIDUAL</option>
                                                                    <option value="GROUP">GROUP</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="firstname">Firstname</label>
                                                                <input type="text" class="form-control" id="firstname" value="{{ $account->firstname }}" name="firstname" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="middlename">Middlename</label>
                                                                <input type="text" class="form-control" id="middlename" value="{{ $account->middlename }}" name="middlename" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="lastname">Lastname</label>
                                                                <input type="text" class="form-control" id="lastname" value="{{ $account->lastname }}" name="lastname" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                        </div>
                                                        <!-- -------------------------->
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="suffix">Suffix</label>
                                                                <select class="form-control" id="suffix" name="suffix">
                                                                    <option value="{{ $account->suffix }}">{{ $account->suffix }}</option>
                                                                    <option value="Jr.">Jr.</option>
                                                                    <option value="Sr.">Sr.</option>
                                                                    <option value="I">I</option>
                                                                    <option value="II">II</option>
                                                                    <option value="III">III</option>
                                                                    <option value="IV">IV</option>
                                                                    <!-- Add more suffixes as needed -->
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="contact">Contact</label>
                                                                <input type="text" class="form-control" id="contact" value="{{ $account->contact }}" name="contact" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="birthdate">Birthdate</label>
                                                                <input type="date" class="form-control" id="birthdate" value="{{ $account->birthdate }}" name="birthdate">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="sex">Sex</label>
                                                                <select class="form-control" id="sex"  name="sex">
                                                                    <option value="{{ $account->sex }}">{{ $account->sex }}</option>
                                                                    <option value="MALE">MALE</option>
                                                                    <option value="FEMALE">FEMALE</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="fourps">4Ps</label>
                                                                <select class="form-control" id="fourps"  name="fourps">
                                                                    <option value="{{ $account->fourps }}">{{ $account->fourps }}</option>
                                                                    <option value="YES">YES</option>
                                                                    <option value="NO">NO</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="pwd">PWD</label>
                                                                <select class="form-control" id="pwd"  name="pwd">
                                                                    <option value="{{ $account->pwd }}">{{ $account->pwd }}</option>
                                                                    <option value="YES">YES</option>
                                                                    <option value="NO">NO</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="arb">ARB</label>
                                                                <select class="form-control" id="arb"  name="arb">
                                                                    <option value="{{ $account->arb }}">{{ $account->arb }}</option>
                                                                    <option value="YES">YES</option>
                                                                    <option value="NO">NO</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="indigenous">Indigenous</label>
                                                                <select class="form-control"  name="indigenous" >
                                                                    <option value="{{ $account->indigenous }}">{{ $account->indigenous }}</option>
                                                                    <option value="YES">YES</option>
                                                                    <option value="NO">NO</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="tribe_name">Name of Tribe</label>
                                                                <input type="text" class="form-control" value="{{ $account->tribe_name }}" name="tribe_name" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                            
                                                            <div class="col-md-4 mb-3">
                                                                <label for="region">Region</label>
                                                                <input type="text" class="form-control" id="region" value="{{ $account->region }}" name="region" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="province">Province</label>
                                                                <input type="text" class="form-control" id="province" value="{{ $account->province }}" name="province" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="municipality">Municipality</label>
                                                                <input type="text" class="form-control" id="municipality" value="{{ $account->municipality }}" name="municipality" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="barangay">Barangay</label>
                                                                <input type="text" class="form-control" id="barangay" value="{{ $account->barangay }}" name="barangay" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="org_name">Organization Name</label>
                                                                <input type="text" class="form-control" id="org_name" value="{{ $account->org_name }}" name="org_name" oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="tot_male">Total No. of Male</label>
                                                                <input type="text" class="form-control" id="tot_male" value="{{ $account->tot_male }}" name="tot_male" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="tot_female">Total No. of Female</label>
                                                                <input type="text" class="form-control" id="tot_female" value="{{ $account->tot_female }}" name="tot_female" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control" id="email" value="{{ $account->email }}" name="email" oninput="this.value = this.value.replace(/\s/g, '')">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="password">Password</label>
                                                                <input type="password" class="form-control"  name="password" oninput="this.value = this.value.replace(/\s/g, '')">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="confirm_password">Confirm Password</label>
                                                                <input type="password" class="form-control"  name="confirm_password" oninput="this.value = this.value.replace(/\s/g, '')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" id="save-btn-{{ $account->id }}">Save Changes</button>
                                                    </div>
                                                </form>
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



    <div class="modal fade" id="addFarmersModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Farmers</h4>
                </div>
                <div class="modal-body">
                    <form action="/add_farmer" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rsbsa">RSBSA</label>
                            <input type="text" class="form-control" id="rsbsa" name="rsbsa" autocomplete="off" oninput="this.value = this.value.toUpperCase()" required>
                            <small id="rsbsaFeedback" class="form-text text-danger"></small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="farmer_type">Type of Farmer</label>
                            <select class="form-control" id="farmer_type" name="farmer_type">
                                <option value="">Select</option>
                                <option value="INDIVIDUAL">INDIVIDUAL</option>
                                <option value="GROUP">GROUP</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename">Middlename</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <!-- -------------------------->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="suffix">Suffix</label>
                            <select class="form-control" id="suffix" name="suffix">
                                <option value="">None</option>
                                <option value="JR.">Jr.</option>
                                <option value="SR.">Sr.</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <!-- Add more suffixes as needed -->
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="sex">Sex</label>
                            <select class="form-control" id="sex" name="sex">
                                <option value="">Select Sex</option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="fourps">4Ps</label>
                            <select class="form-control" id="fourps" name="fourps">
                                <option value="">Select</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pwd">PWD</label>
                            <select class="form-control" id="pwd" name="pwd">
                                <option value="">Select</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="arb">ARB</label>
                            <select class="form-control" id="arb" name="arb">
                                <option value="">Select</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="indigenous">Indigenous</label>
                            <select class="form-control" id="indigenous" name="indigenous" onchange="toggleTribeInput()">
                                <option value="" disabled>Select</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tribe_name">Name of Tribe</label>
                            <input type="text" class="form-control" id="tribe_name" name="tribe_name" oninput="this.value = this.value.toUpperCase()" disabled>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="municipality">Municipality</label>
                            <input type="text" class="form-control" id="municipality" name="municipality" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="barangay">Barangay</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="org_name">Organization Name</label>
                            <input type="text" class="form-control" id="org_name" name="org_name" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tot_male">Total No. of Male</label>
                            <input type="text" class="form-control" id="tot_male" name="tot_male" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tot_female">Total No. of Female</label>
                            <input type="text" class="form-control" id="tot_female" name="tot_female" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" oninput="this.value = this.value.replace(/\s/g, '')">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" oninput="this.value = this.value.replace(/\s/g, '')">
                            <div id="error_message" style="color: red; display: none;">Passwords do not match.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" oninput="this.value = this.value.replace(/\s/g, '')">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addFarmerBtn">Add Farmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="map" style="display: none; height: 330px; width: 100%;"></div>
<script async defer src="googlemapsAPI.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    window.onload = function () {
        if (typeof google !== 'undefined' && google.maps) {
            initMap(); // Ensure Google Maps API is available before calling initMap
        } else {
            console.error("Google Maps API failed to load.");
        }
    };
    
    function initMap() {
        // Full farm data
        const farms = @json($farms); 
        const defaultLocation = @json($defaultLocation);

        // Extract locations from the full farm data
        const farmLocations = farms.map(farm => farm.location);

        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: defaultLocation }, (results, status) => {
            if (status === "OK") {
                const map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: results[0].geometry.location
                });

                farmLocations.forEach((address, index) => {
                    geocoder.geocode({ address: address }, (results, status) => {
                        if (status === "OK") {
                            const position = results[0].geometry.location;

                            // Fetch weather data and add marker with temperature label
                            fetchWeather(position.lat(), position.lng(), (temp) => {
                                const marker = new google.maps.Marker({
                                    map: map,
                                    position: position,
                                    title: address,
                                    label: temp + '°C'
                                });

                                const infowindow = new google.maps.InfoWindow({
                                    content: `<p>${address}</p><p>Temperature: ${temp}°C</p>`
                                });

                                marker.addListener('click', () => {
                                    infowindow.open(map, marker);
                                });

                                // Send weather data and farm details to the backend only if temp < -7°C or temp > 29°C
                                if (temp < -7 || temp > 28) {
                                    sendWeatherAlert(farms[index], temp);
                                }
                            });
                        } else {
                            console.error(`Geocode was not successful for the following reason: ${status}`);
                        }
                    });
                });
            } else {
                console.error(`Geocode was not successful for the default location: ${status}`);
            }
        });
    }

    function fetchWeather(lat, lng, callback) {
        const apiKey = "4e89cb6596765628fd6138f58d7454e1";
        const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.main && data.main.temp !== undefined) {
                    callback(data.main.temp);
                } else {
                    console.log('Weather data not found for location.');
                    callback('N/A');
                }
            })
            .catch(error => {
                console.error('Error fetching weather:', error);
                callback('N/A');
            });
    }

    function sendWeatherAlert(farm, temperature) {
        const data = {
            id: farm.id,
            email: farm.email,
            commodity: farm.commodity,
            farm_type: farm.farm_type,
            livestock_type: farm.livestock_type,
            user_id: farm.user_id,
            temperature: temperature
        };

        fetch('/weather-alert', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.success) {
                console.log('Weather alert successfully submitted!');
            } else {
                console.log('Failed to submit weather alert:', responseData.message);
            }
        })
        .catch(error => {
            console.error('Error sending weather alert:', error);
        });
    }
</script>
<script>
//CHECK RSBSA ON EDIT AND DASH PER 2 INPUT
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.rsbsa-input').forEach(function (input) {
        input.addEventListener('input', function () {
            let rsbsa = this.value.replace(/[^A-Za-z0-9]/g, ''); // Remove non-alphanumeric characters
            rsbsa = rsbsa.match(/.{1,2}/g)?.join('-') || ''; // Insert dash after every 2 characters
            this.value = rsbsa;

            const farmerId = this.id.split('-')[1];
            const errorElem = document.getElementById(`rsbsa-error-${farmerId}`);
            const saveBtn = document.getElementById(`save-btn-${farmerId}`);

            if (rsbsa.trim() === '') {
                errorElem.style.display = 'none';
                saveBtn.disabled = false;
                return;
            }

            fetch(`/check-rsbsa?rsbsa=${rsbsa}&excludeId=${farmerId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        errorElem.style.display = 'block';
                        saveBtn.disabled = true;
                    } else {
                        errorElem.style.display = 'none';
                        saveBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
});

//CHECK RSBSA ON ADD FARMER
$(document).ready(function() {
    $('#rsbsa').on('input', function() {
        var rsbsa = $(this).val();
        
        if (rsbsa.length > 0) {
            $.ajax({
                url: '/check_rsbsa_add_farmer',
                method: 'POST',
                data: {
                    rsbsa: rsbsa,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.exists) {
                        $('#rsbsaFeedback').text('RSBSA already exists!').show();
                        $('#addFarmerBtn').prop('disabled', true); 
                    } else {
                        $('#rsbsaFeedback').text('RSBSA is available.').css('color', 'green').show();
                        $('#addFarmerBtn').prop('disabled', false); 
                    }
                },
                error: function() {
                    $('#rsbsaFeedback').text('An error occurred.').show();
                }
            });
        } else {
            $('#rsbsaFeedback').hide();
            $('#addFarmerBtn').prop('disabled', false); 
        }
    });
});

//ACCEPT CHARACTER DASHH RSBSA

const rsbsaInput = document.getElementById('rsbsa');

rsbsaInput.addEventListener('input', function () {
    // Remove all non-numeric characters
    let value = rsbsaInput.value.replace(/[^0-9]/g, '');

    // Limit to 15 digits
    value = value.substring(0, 15);

    // Add dashes dynamically even for incomplete inputs
    let formattedValue = value
        .replace(/^(\d{2})(\d)?/, '$1-$2')
        .replace(/^(\d{2}-\d{2})(\d)?/, '$1-$2')
        .replace(/^(\d{2}-\d{2}-\d{2})(\d)?/, '$1-$2')
        .replace(/^(\d{2}-\d{2}-\d{2}-\d{3})(\d)?/, '$1-$2')
        .replace(/^(\d{2}-\d{2}-\d{2}-\d{3}-\d{6})(.*)$/, '$1');

    // Update the input value
    rsbsaInput.value = formattedValue;
});

document.addEventListener('DOMContentLoaded', function () {
    @foreach ($accounts as $account)
    let rsbsaInput_{{ $account->id }} = document.getElementById('rsbsaID-{{ $account->id }}');
    
    if (rsbsaInput_{{ $account->id }}) {
        rsbsaInput_{{ $account->id }}.addEventListener('input', function () {
            // Remove all non-numeric characters
            let value = this.value.replace(/[^0-9]/g, '');

            // Limit to 15 digits
            value = value.substring(0, 15);

            // Add dashes dynamically even for incomplete inputs
            let formattedValue = value
                .replace(/^(\d{2})(\d)?/, '$1-$2')
                .replace(/^(\d{2}-\d{2})(\d)?/, '$1-$2')
                .replace(/^(\d{2}-\d{2}-\d{2})(\d)?/, '$1-$2')
                .replace(/^(\d{2}-\d{2}-\d{2}-\d{3})(\d)?/, '$1-$2')
                .replace(/^(\d{2}-\d{2}-\d{2}-\d{3}-\d{6})(.*)$/, '$1');

            // Update the input value
            this.value = formattedValue;
        });
    }
    @endforeach
});

//DISABLE TRIBE NAME

function toggleTribeInput() {
    const indigenous = document.getElementById("indigenous");
    const tribeName = document.getElementById("tribe_name");
    tribeName.disabled = indigenous.value === "NO";
    document.getElementById('tribe_name').value = "";
}

document.getElementById("confirm_password").addEventListener("input", function() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var errorMessage = document.getElementById("error_message");
    const submitButton = document.getElementById('addFarmerBtn');

    // Check if password is not empty before comparing
    if (password && confirmPassword && password !== confirmPassword) {
        errorMessage.style.display = "block"; 
        submitButton.disabled = true; 
    } else {
        errorMessage.style.display = "none"; 
        submitButton.disabled = false; 
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
            // Submit the form after confirmation
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

function confirmArchive(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This farmer is not active?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form after confirmation
            document.getElementById('archive-form-' + id).submit();
        }
    });
}

function confirmActive(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This farmer is active again?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form after confirmation
            document.getElementById('active-form-' + id).submit();
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
