
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  
<!-- Mirrored from themewagon.github.io/AgiTechFarm/v1.0.0/? by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Dec 2024 12:16:40 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>AgTech</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="agtech.png">
    <link rel="icon" type="image/png" sizes="32x32" href="agtech.png">
    <link rel="icon" type="image/png" sizes="16x16" href="agtech.png">
    <link rel="shortcut icon" type="image/x-icon" href="agtech.png">
    <link rel="manifest" href="agtech.png">
    <meta name="msapplication-TileImage" content="agtech.png">
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="landingpage/assets/css/theme.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  @media (min-width: 768px) {
    .hide-desktop {
      display: none;
    }
  }
</style>
  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light opacity-85" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" ><img class="d-inline-block align-top img-fluid" src="agtech.png" alt="" width="50" /><span class="text-theme font-monospace fs-4 ps-2">AgTech</span></a><button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="#header">Home</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#announcements">Announcements</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#Offer">About Us</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-medium" href="#HowItWorks">How It Works</a></li>
             
            </ul>
            <div class="d-flex">
                <a href="/login" class="btn btn-lg btn-dark bg-gradient order-0 ms-3">Login</a>
            </div>


          </div>
        </div>
      </nav>
      <section class="py-0" id="header">
        <div class="bg-holder d-none d-md-block" style="background-image:url(landingpage/assets/img/illustrations/hero-header.png);background-position:right top;background-size:contain;"></div>
        <!--/.bg-holder-->
        <div class="bg-holder d-md-none" style="background-image:url(landingpage/assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row align-items-center min-vh-75 min-vh-lg-100">
            <div class="col-md-7 col-lg-6 col-xxl-5 py-6 text-sm-start text-center">
              <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">A New Way to Improve <br class="d-block d-lg-block" />your Agriculture</h1>
              <p class="mb-4 fs-1">AgTech provides a solution and assistances for the farmers and a way to improve it</p><a class="btn btn-lg btn-success hide-desktop" href="/login" role="button">Login</a>
            </div>
          </div>
        </div>
      </section>
      <section class="py-5" id="announcements">
        <div class="bg-holder d-none d-sm-block" style="background-image:url(landingpage/assets/img/illustrations/bg.png);background-position:top left;background-size:225px 755px;margin-top:-17.5rem;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row">
            <div class="col-lg-9 mx-auto text-center mb-3">
              <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Announcements</h5>
              <p class="mb-5">You are valuable for us and into this world so we eager to update you time to time!.</p>
            </div>
          </div>
              <div class="row flex-center h-100">
                <div class="col-xl-9">
                    <div class="row">
                        @forelse ($announcements as $item)
                            <div class="col-md-4 mb-5">
                                <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-0">
                                    <div class="text-center text-md-start card-hover">
                                        <div class="card-body">
                                            <h6 class="fw-bold fs-1 heading-color">{{ $item->title }}</h6>
                                            <p class="mt-3 mb-md-0 mb-lg-2">{{ $item->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>No current announcements</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
      </section>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-5" id="Offer">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-xl-9 mb-3">
                <div class="row">
                  <div class="col-lg-9 mb-3">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">About Us</h5>
                    <p class="mb-5">
                      Welcome to AgTech, a comprehensive system designed to drive innovation and efficiency in agriculture. Our mission is to empower farmers with cutting-edge technology and solutions that optimize productivity and sustainability.
                    </p>
                  </div>
                  <div class="col-md-6 mb-5">
                    <div class="card text-white">
                      <img class="card-img" src="landingpage/assets/img/gallery/short-terms.png" alt="Short-Term Solutions" />
                      <div class="card-img-overlay d-flex flex-column justify-content-center px-5 px-md-3 px-lg-5 bg-dark-gradient">
                       
                        <div class="pt-lg-3">
                         
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-5">
                    <div class="card text-white">
                      <img class="card-img" src="landingpage/assets/img/gallery/fully-funded.png" alt="Long-Term Initiatives" />
                      <div class="card-img-overlay d-flex flex-column justify-content-center px-5 px-md-3 px-lg-5 bg-light-gradient">
                       
                        <div class="pt-lg-3">
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      <!-- ============================================-->

     <section class="py-0" id="HowItWorks">
      <div class="bg-holder" style="background-image:url(landingpage/assets/img/illustrations/how-it-works.png);background-position:center bottom;background-size:cover;"></div>
      <!--/.bg-holder-->
      <div class="container-lg">
        <div class="row justify-content-center">
          <div class="col-sm-8 col-md-9 col-xl-5 text-center pt-8">
            <h5 class="fw-bold fs-3 fs-xxl-5 lh-sm mb-3 text-white">How it works</h5>
            <p class="mb-5 text-white">
             Create an account and log in to enjoy an amazing experience and eliminate inconvenience while using our website!
            </p>
          </div>
          <div class="col-sm-9 col-md-12 col-xxl-9">
            <div class="theme-tab">
              <ul class="nav justify-content-between">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active fw-semi-bold" href="#bootstrap-tab1" data-bs-toggle="tab" data-bs-target="#tab1" id="tab-1">
                    <span class="nav-item-circle-parent">
                      <span class="nav-item-circle">01</span>
                    </span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link fw-semi-bold" href="#bootstrap-tab2" data-bs-toggle="tab" data-bs-target="#tab2" id="tab-2">
                    <span class="nav-item-circle-parent">
                      <span class="nav-item-circle">02</span>
                    </span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link fw-semi-bold" href="#bootstrap-tab3" data-bs-toggle="tab" data-bs-target="#tab3" id="tab-3">
                    <span class="nav-item-circle-parent">
                      <span class="nav-item-circle">03</span>
                    </span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link fw-semi-bold" href="#bootstrap-tab4" data-bs-toggle="tab" data-bs-target="#tab4" id="tab-4">
                    <span class="nav-item-circle-parent">
                      <span class="nav-item-circle">04</span>
                    </span>
                  </a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab-1">
                  <div class="row align-items-center my-6 mx-auto">
                    <div class="col-md-6 col-lg-5 offset-md-1">
                      <h3 class="fw-bold lh-base text-white">
                        Register and login
                      </h3>
                    </div>
                    <div class="col-md-5 text-white offset-lg-1">
                      <p class="mb-0">
                       Create an account using your authenticated email and the RSBSA provided by AgTech, then log in to get started
                      </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab-2">
                  <div class="row align-items-center my-6 mx-auto">
                    <div class="col-md-6 col-lg-5 offset-md-1">
                      <h3 class="fw-bold lh-base text-white">
                        Add your farms
                      </h3>
                    </div>
                    <div class="col-md-5 text-white offset-lg-1">
                      <p class="mb-0">
                       Add your farms to monitor weather and temperature at your farm's location, helping you prepare for potential outcomes.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab-3">
                  <div class="row align-items-center my-6 mx-auto">
                    <div class="col-md-6 col-lg-5 offset-md-1">
                      <h3 class="fw-bold lh-base text-white">
                        Calamity Reports
                      </h3>
                    </div>
                    <div class="col-md-5 text-white offset-lg-1">
                      <p class="mb-0">
                        In the event of a calamity causing significant impact, you can easily report it by selecting your farm location and providing the necessary information.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab-4">
                  <div class="row align-items-center my-6 mx-auto">
                    <div class="col-md-6 col-lg-5 offset-md-1">
                      <h3 class="fw-bold lh-base text-white">
                        Assistances
                      </h3>
                    </div>
                    <div class="col-md-5 text-white offset-lg-1">
                      <p class="mb-0">
                        Simply wait for the admin's review and approval of your calamity report to receive assistance. Enjoy the convenience of managing everything through our online platform!
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

      

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="z-index-1 cta">
        <div class="container">
          <div class="row flex-center">
            <div class="col-12">
              <div class="card shadow h-100 py-5">
                <div class="card-body text-center">
                  <h1 class="fw-semi-bold mb-4">The future of &nbsp;<span class="text-success">Farm </span> &nbsp; is AgTech</h1><a class="btn btn-lg btn-success px-6" href="/login" role="button">Join Now</a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->

      <section class="py-0" id="contact">
        <div class="bg-holder" style="background-image:url(landingpage/assets/img/illustrations/footer-bg.png);background-position:center;background-size:cover;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row justify-content-lg-between min-vh-75" style="padding-top:21rem">
          
          <hr class="text-300 mb-0" />
          <div class="row flex-center py-5">
            <div class="col-12 col-sm-8 col-md-6 text-center text-md-start"> <a class="text-decoration-none" href="#"><img class="d-inline-block align-top img-fluid" src="images/agtech.jfif" alt="" width="40" /><span class="text-theme font-monospace fs-3 ps-2">AgTech</span></a></div>
            
          </div>
        </div>
      </section>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <div id="weather_alert_map" style="display: none; height: 330px; width: 100%;"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-6lStYy7YLcsM1hg5Po9DuUht8N-eO1Y&callback=initMap" async defer></script>
    <script src="landingapge/vendors/%40popperjs/popper.min.js"></script>
    <script src="landingapge/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="landingapge/vendors/is/is.min.js"></script>
    <script src="landingpage//polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
    <script src="landingpage/assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@300;400;700;900&amp;display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    window.onload = function () {
        if (typeof google !== 'undefined' && google.maps) {
            initFarmWeatherMap(); // Updated function name
        } else {
            console.error("Google Maps API failed to load.");
        }
    };

    function initFarmWeatherMap() {
        const farms = @json($farms);
        const defaultLocation = @json($defaultLocation);
        const farmLocations = farms.map(farm => farm.location);
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: defaultLocation }, (results, status) => {
            if (status === "OK") {
                const map = new google.maps.Map(document.getElementById('weather_alert_map'), {
                    zoom: 10,
                    center: results[0].geometry.location
                });

                farmLocations.forEach((address, index) => {
                    geocoder.geocode({ address: address }, (results, status) => {
                        if (status === "OK") {
                            const position = results[0].geometry.location;

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

                                if (temp < -7 || temp > 28) {
                                    sendWeatherAlert(farms[index], temp);
                                }
                            });
                        } else {
                            console.error(`Geocode was not successful for: ${status}`);
                        }
                    });
                });
            } else {
                console.error(`Geocode failed for default location: ${status}`);
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
                    callback('N/A');
                }
            })
            .catch(() => callback('N/A'));
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
                console.log('Weather alert submitted successfully.');
            } else {
                console.log('Failed to submit weather alert.');
            }
        })
        .catch(() => console.error('Error sending weather alert.'));
    }
</script>
  </body>


<!-- Mirrored from themewagon.github.io/AgiTechFarm/v1.0.0/? by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Dec 2024 12:16:49 GMT -->
</html>