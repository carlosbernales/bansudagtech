@include('user.header', ['notificationCount' => $notificationCount, 'notifications' => $notifications])

    
   

<section class="py-5 overflow-hidden">
  <div class="container-lg">
    <div class="row">
      <!-- Column 1 -->
      <div class="col-md-4">
        <div class="p-3 border d-flex justify-content-between align-items-center">
          <!-- Text -->
          <p class="mb-0">My Farms</p>
          <!-- Icon -->
          <img src="path/to/farm-icon.png" alt="Farm Icon" style="width: 24px; height: 24px;">
        </div>
      </div>
      <!-- Column 2 -->
      <div class="col-md-4">
        <div class="p-3 border">
          <!-- Content for column 2 -->
          <p>Column 2 Content</p>
        </div>
      </div>
      <!-- Column 3 -->
      <div class="col-md-4">
        <div class="p-3 border">
          <!-- Content for column 3 -->
          <p>Column 3 Content</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p>My Crop and Farms</p>
        <div id="map" style="height: 500px; width: 100%;"></div>
      </div>
    </div>
  </div>
</section>




@include('user/footer')





   
  

    

    