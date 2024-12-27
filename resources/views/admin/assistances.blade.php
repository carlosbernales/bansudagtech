
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
                            <h2>Assistances</h2>
                            <button class="btn btn-lightgreen lightgreen-icon-notika"  data-toggle="modal" data-target="#addAssistanceModal">+ Assistance</button>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th style="width: 8%; text-align: center;">
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($assistance as $assistance)
                                    <tr>
                                        <td>{{ $assistance->assistance_type }}</td>
                                        <td>
                                            <div style="display: flex; gap: 10px; align-items: center;">
                                                <!-- Edit Button -->
                                                <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $assistance->id }}" style="background-color: transparent; border: none;">
                                                    <i class="bi bi-pencil" style="color: #007bff; font-size: 18px;"></i>
                                                </button> -->

                                                <!-- Delete Button -->
                                                <form action="{{ url('/delete_assistance/'.$assistance->id) }}" method="POST" id="delete-form-{{ $assistance->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $assistance->id }})" style="background-color: transparent; border: none;">
                                                        <i class="bi bi-trash" style="color: #dc3545; font-size: 18px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                    
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addAssistanceModal" role="dialog">
        <div class="modal-dialog modal-md"> <!-- Increased the size to modal-lg for more space -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Assistance</h4>
                </div>
                <div class="modal-body">
                    <form action="/add_assistance" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="Assitance Type">Assitance Type</label>
                                <input type="text" class="form-control" id="Assitance Type" name="assistance_type" placeholder="Enter Assistance Type" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Submit</button>
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
                // Submit the form after confirmation
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

    <!-- Data Table area End-->

    @include('admin/footer')
