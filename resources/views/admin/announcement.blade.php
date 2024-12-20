
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
                            <button class="btn btn-lightgreen lightgreen-icon-notika"  data-toggle="modal" data-target="#addAnnouncementModal">+ Announcement</button>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th style="width: 5%; text-align: center;">
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($announcement as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->content }}</td>
                                        <td>
                                        <form action="{{ url('/delete_announcement/'.$announcement->id) }}" method="POST" id="delete-form-{{ $announcement->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $announcement->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
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


    <div class="modal fade" id="addAnnouncementModal" role="dialog">
        <div class="modal-dialog modal-md"> <!-- Increased the size to modal-lg for more space -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Farmers</h4>
                </div>
                <div class="modal-body">
                    <form action="/add_announcement" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter Content" required></textarea>
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
