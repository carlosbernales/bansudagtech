
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
                                        <td style="width: 10%; text-align: center;">
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
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="rsbsa">RSBSA</label>
                                                                <input type="text" class="form-control rsbsa-input" id="rsbsa-{{ $account->id }}" name="rsbsa" value="{{ $account->rsbsa }}" required>
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
                                                                <input type="text" class="form-control" id="firstname" value="{{ $account->firstname }}" name="firstname">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="middlename">Middlename</label>
                                                                <input type="text" class="form-control" id="middlename" value="{{ $account->middlename }}" name="middlename">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="lastname">Lastname</label>
                                                                <input type="text" class="form-control" id="lastname" value="{{ $account->lastname }}" name="lastname">
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
                                                                <input type="text" class="form-control" id="contact" value="{{ $account->contact }}" name="contact">
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
                                                                <select class="form-control"  name="indigenous" onchange="toggleTribeInput()">
                                                                    <option value="{{ $account->indigenous }}">{{ $account->indigenous }}</option>
                                                                    <option value="YES">YES</option>
                                                                    <option value="NO">NO</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="tribe_name">Name of Tribe</label>
                                                                <input type="text" class="form-control" value="{{ $account->tribe_name }}" name="tribe_name" disabled>
                                                            </div>
                                                            
                                                            <div class="col-md-4 mb-3">
                                                                <label for="region">Region</label>
                                                                <input type="text" class="form-control" id="region" value="{{ $account->region }}" name="region">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="province">Province</label>
                                                                <input type="text" class="form-control" id="province" value="{{ $account->province }}" name="province">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="municipality">Municipality</label>
                                                                <input type="text" class="form-control" id="municipality" value="{{ $account->municipality }}" name="municipality">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="barangay">Barangay</label>
                                                                <input type="text" class="form-control" id="barangay" value="{{ $account->barangay }}" name="barangay">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="org_name">Organization Name</label>
                                                                <input type="text" class="form-control" id="org_name" value="{{ $account->org_name }}" name="org_name">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="tot_male">Total No. of Male</label>
                                                                <input type="text" class="form-control" id="tot_male" value="{{ $account->tot_male }}" name="tot_male">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="tot_female">Total No. of Female</label>
                                                                <input type="text" class="form-control" id="tot_female" value="{{ $account->tot_female }}" name="tot_female">
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control" id="email" value="{{ $account->email }}" name="email">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="password">Password</label>
                                                                <input type="password" class="form-control"  name="password">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="confirm_password">Confirm Password</label>
                                                                <input type="password" class="form-control"  name="confirm_password">
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
                            <input type="text" class="form-control" id="rsbsa" name="rsbsa" autocomplete="off">
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
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename">Middlename</label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>
                    </div>
                    <!-- -------------------------->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="suffix">Suffix</label>
                            <select class="form-control" id="suffix" name="suffix">
                                <option value="">None</option>
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
                            <input type="text" class="form-control" id="contact" name="contact">
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
                                <option value="">Select</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tribe_name">Name of Tribe</label>
                            <input type="text" class="form-control" id="tribe_name" name="tribe_name" disabled>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="municipality">Municipality</label>
                            <input type="text" class="form-control" id="municipality" name="municipality">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="barangay">Barangay</label>
                            <input type="text" class="form-control" id="barangay" name="barangay">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="org_name">Organization Name</label>
                            <input type="text" class="form-control" id="org_name" name="org_name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tot_male">Total No. of Male</label>
                            <input type="text" class="form-control" id="tot_male" name="tot_male">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tot_female">Total No. of Female</label>
                            <input type="text" class="form-control" id="tot_female" name="tot_female">
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div id="error_message" style="color: red; display: none;">Passwords do not match.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    let value = rsbsaInput.value.replace(/-/g, ''); 
    let formattedValue = value.match(/.{1,2}/g)?.join('-') || ''; 
    rsbsaInput.value = formattedValue;
});

//DISABLE TRIBE NAME

function toggleTribeInput() {
    const indigenous = document.getElementById("indigenous");
    const tribeName = document.getElementById("tribe_name");
    tribeName.disabled = indigenous.value === "NO";
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

</script>
<script>
    alertify.set('notifier', 'position', 'top-right');

    @if(session('success'))
        alertify.success('{{ session('success') }}');
    @endif
</script>

    <!-- Data Table area End-->

    @include('admin/footer')
