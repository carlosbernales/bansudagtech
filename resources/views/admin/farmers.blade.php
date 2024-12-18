
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
                                <button class="btn btn-lightgreen lightgreen-icon-notika"  data-toggle="modal" data-target="#addFarmersModal">+ Farmer</button>
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
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->rsbsa }}</td>
                                        <td>{{ $account->fullname }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->contact }}</td>
                                    </tr>
                                @endforeach
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
                        <div class="col-md-12 mb-3">
                            <label for="rsbsa">RSBSA</label>
                            <input type="text" class="form-control" id="rsbsa" name="rsbsa" autocomplete="off">
                            <small id="rsbsaFeedback" class="form-text text-danger"></small>
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
                    <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    document.getElementById('rsbsa').addEventListener('input', function () {
        const rsbsa = this.value;
        const feedback = document.getElementById('rsbsaFeedback');
        const submitButton = document.getElementById('submitButton');

        if (rsbsa.length > 0) {
            fetch('{{ url("/check_rsbsa_add_farmer") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ rsbsa: rsbsa })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    feedback.textContent = 'RSBSA already exists.';
                    submitButton.disabled = true; 
                } else {
                    feedback.textContent = '';
                    submitButton.disabled = false; 
                }
            })
            .catch(error => {
                feedback.textContent = 'Error checking RSBSA. Please try again.';
                console.error('Error:', error);
                submitButton.disabled = false; 
            });
        } else {
            feedback.textContent = '';
            submitButton.disabled = false; 
        }
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
        const submitButton = document.getElementById('submitButton');


        if (password !== confirmPassword) {
            errorMessage.style.display = "block"; 
            submitButton.disabled = true; 

        } else {
            errorMessage.style.display = "none"; 
            submitButton.disabled = false; 
        }
    });

</script>
<script>
    alertify.set('notifier', 'position', 'top-right');

    @if(session('success'))
        alertify.success('{{ session('success') }}');
    @endif
</script>

    <!-- Data Table area End-->

    @include('admin/footer')
