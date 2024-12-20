
@include('user/header')

    

   

<section class="pb-5">
    <div class="container-lg">
        <!-- Section Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between my-4">
                    <h2 class="section-title">Calamity Reports</h2>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addFarmModal">Add Report</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Farms Grid -->
        <div class="row">
            <div class="col-md-12">
                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">

                        <div class="col">
                            <div class="product-item">
                                <!-- Thumbnail -->
                                <figure>
                                    <a href="#" title="" data-bs-toggle="modal" data-bs-target="#viewImageModal">
                                            <img src="default.png" alt="Default Thumbnail" class="tab-image">
                                    </a>
                                </figure>
                                
                                <!-- Farm Details -->
                                <div class="d-flex flex-column text-center">
                                    <h3 class="fs-6 fw-normal"></h3>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <span class="text-dark fw-semibold"></span>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3"></div>
                                            <div class="col-7">
                                                <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" data-location="" data-bs-toggle="modal" data-bs-target="#viewLocationModal">
                                                    View Location
                                                </a>
                                            </div>
                                            <div class="col-2">
                                            <form action="/delete_farm/" method="POST" id="delete-form-">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger rounded-1 p-2 fs-6" 
                                                    title="Delete" onclick="confirmDelete)">
                                                    <svg width="18" height="18">
                                                        <use xlink:href="#trash"></use>
                                                    </svg>
                                                </button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / Farm Details -->
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <!-- / Farms Grid -->
    </div>
</section>




<!-- Add Farm Modal -->
<div class="modal fade" id="addFarmModal" tabindex="-1" aria-labelledby="addFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFarmModalLabel">Add Farm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/add_farms" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="location" class="form-label">Farm Location</label>
            <div class="input-group">
            <input type="text" class="form-control" id="location" name="location" readonly required>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#mapModal">Select Location</button>
            </div>
        </div>
        <div class="mb-3">
            <label for="commodity" class="form-label">Commodity</label>
            <select class="form-control" id="commodity" name="commodity" required>
            <option value="">Select</option>
            <option value="CROP">CROP</option>
            <option value="LIVESTOCK">LIVESTOCK</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="farm_type" class="form-label">Farm Type</label>
            <input type="text" class="form-control" id="farm_type" name="farm_type" placeholder="eg: RICE or PIG" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Images</label>
            <input type="file" class="form-control" id="image" name="image[]" multiple required>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Google Maps Modal for Adding Farm Location -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel">Select Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="mapSearch" class="form-control mb-3" placeholder="Search location...">
        <div id="map" style="width: 100%; height: 400px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveLocation">Okay</button>
      </div>
    </div>
  </div>
</div>

<!-- Google Maps Modal for Viewing Location -->
<div class="modal fade" id="viewLocationModal" tabindex="-1" aria-labelledby="viewLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLocationModalLabel">Farm Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewMap" style="width: 100%; height: 400px;"></div>
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
            console.log('Confirmed delete for ID:', id);
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

</script>


@include('user/footer')





   
  

    

    