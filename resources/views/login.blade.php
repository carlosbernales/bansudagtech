
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="zxx">


<!-- Mirrored from p.w3layouts.com/demos_new/template_demo/06-03-2019/triple_forms-demo_Free/1611343419/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Dec 2024 13:12:40 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>Agi Tech</title>
	<!-- Meta tag Keywords -->
    <link rel="shortcut icon" type="image/x-icon" href="agtech.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Triple Forms Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->

	<!-- css files -->
	<link rel="stylesheet" href="login_template/css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="login_template/css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->

	<!-- web-fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext"
	 rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- //web-fonts -->
</head>

<body>
<script src="../../../../../../../m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>
<script>
(function(){
	if(typeof _bsa !== 'undefined' && _bsa) {
  		// format, zoneKey, segment:value, options
  		_bsa.init('flexbar', 'CKYI627U', 'placement:w3layoutscom');
  	}
})();
</script>
<script>
(function(){
if(typeof _bsa !== 'undefined' && _bsa) {
	// format, zoneKey, segment:value, options
	_bsa.init('fancybar', 'CKYDL2JN', 'placement:demo');
}
})();
</script>
<script>
(function(){
	if(typeof _bsa !== 'undefined' && _bsa) {
  		// format, zoneKey, segment:value, options
  		_bsa.init('stickybox', 'CKYI653J', 'placement:w3layoutscom');
  	}
})();
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src='https://www.googletagmanager.com/gtag/js?id=G-98H8KRKT85'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-98H8KRKT85');
</script>

<meta name="robots" content="noindex">
<body><link rel="stylesheet" href="../../../../../../assests/login_template/css/font-awesome.min.css">
<!-- New toolbar-->
<style>
* {
  box-sizing: border-box;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}


#w3lDemoBar.w3l-demo-bar {
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  padding: 40px 5px;
  padding-top:70px;
  margin-bottom: 70px;
  background: #0D1326;
  border-top-left-radius: 9px;
  border-bottom-left-radius: 9px;
}

#w3lDemoBar.w3l-demo-bar a {
  display: block;
  color: #e6ebff;
  text-decoration: none;
  line-height: 24px;
  opacity: .6;
  margin-bottom: 20px;
  text-align: center;
}

#w3lDemoBar.w3l-demo-bar span.w3l-icon {
  display: block;
}

#w3lDemoBar.w3l-demo-bar a:hover {
  opacity: 1;
}

#w3lDemoBar.w3l-demo-bar .w3l-icon svg {
  color: #e6ebff;
}
#w3lDemoBar.w3l-demo-bar .responsive-icons {
  margin-top: 30px;
  border-top: 1px solid #41414d;
  padding-top: 40px;
}
#w3lDemoBar.w3l-demo-bar .demo-btns {
  border-top: 1px solid #41414d;
  padding-top: 30px;
}
#w3lDemoBar.w3l-demo-bar .responsive-icons a span.fa {
  font-size: 26px;
}
#w3lDemoBar.w3l-demo-bar .no-margin-bottom{
  margin-bottom:0;
}
.toggle-right-sidebar span {
  background: #0D1326;
  width: 50px;
  height: 50px;
  line-height: 50px;
  text-align: center;
  color: #e6ebff;
  border-radius: 50px;
  font-size: 26px;
  cursor: pointer;
  opacity: .5;
}
.pull-right {
  float: right;
  position: fixed;
  right: 0px;
  top: 70px;
  width: 90px;
  z-index: 99999;
  text-align: center;
}
/* ============================================================
RIGHT SIDEBAR SECTION
============================================================ */

#right-sidebar {
  width: 90px;
  position: fixed;
  height: 100%;
  z-index: 1000;
  right: 0px;
  top: 0;
  margin-top: 60px;
  -webkit-transition: all .5s ease-in-out;
  -moz-transition: all .5s ease-in-out;
  -o-transition: all .5s ease-in-out;
  transition: all .5s ease-in-out;
  overflow-y: auto;
}


/* ============================================================
RIGHT SIDEBAR TOGGLE SECTION
============================================================ */

.hide-right-bar-notifications {
  margin-right: -300px !important;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
}



@media (max-width: 992px) {
  #w3lDemoBar.w3l-demo-bar a.desktop-mode{
      display: none;

  }
}
@media (max-width: 767px) {
  #w3lDemoBar.w3l-demo-bar a.tablet-mode{
      display: none;

  }
}
@media (max-width: 568px) {
  #w3lDemoBar.w3l-demo-bar a.mobile-mode{
      display: none;
  }
  #w3lDemoBar.w3l-demo-bar .responsive-icons {
      margin-top: 0px;
      border-top: none;
      padding-top: 0px;
  }
  #right-sidebar,.pull-right {
      width: 90px;
  }
  #w3lDemoBar.w3l-demo-bar .no-margin-bottom-mobile{
      margin-bottom: 0;
  }
}


.custom-swal-size {
    max-width: 400px; /* Adjust the width */
    padding: 1rem;   /* Adjust padding */
}

.custom-swal-size .swal2-title {
    font-size: 1rem; /* Adjust title font size */
}

.custom-swal-size .swal2-content {
    font-size: 0.9rem; /* Adjust text font size */
}
</style>

<div class="pull-right toggle-right-sidebar">
</div>

</div>

	<div class="main-bg">
		<!-- title -->
		<h1></h1>
		<!-- //title -->
<!---728x90--->

		<div class="sub-main-w3">
			<div class="image-style">

			</div>
			<!-- vertical tabs -->
			<div class="vertical-tab">
				<div id="section1" class="section-w3ls">
					<input type="radio" name="sections" id="option1" checked>
					<label for="option1" class="icon-left-w3pvt"><span class="fa fa-user-circle" aria-hidden="true"></span>Login</label>
					<article>
						<form action="/login_submit" method="post">
							@csrf
							<h3 class="legend">Login Here</h3>
							<div class="input">
								<span class="fa fa-envelope-o" aria-hidden="true"></span>
								<input type="email" placeholder="Email" name="email" oninput="this.value = this.value.replace(/\s/g, '')" required />
							</div>
							<div class="input">
								<span class="fa fa-key" aria-hidden="true"></span>
								<input type="password" placeholder="Password" name="password" oninput="this.value = this.value.replace(/\s/g, '')" required />
							</div>
							@if(session('error'))
								<div class="alert alert-danger">{{ session('error') }}</div>
							@endif
							<button type="submit" class="btn submit">Login</button>
						</form>
					</article>
				</div>
				<div id="section2" class="section-w3ls">
					<input type="radio" name="sections" id="option2">
					<label for="option2" class="icon-left-w3pvt"><span class="fa fa-pencil-square" aria-hidden="true"></span>Register</label>
					<article>
					<form action="/register" method="POST" id="registerForm">
						@csrf
						<h3 class="legend">Register Here</h3>
						<div class="input">
							<span aria-hidden="true"></span>
							<input type="text" placeholder="Email" name="email" value="{{ old('email') }}" oninput="this.value = this.value.replace(/\s/g, '')" required />
							@error('email', 'register_error')
							<small class="error">{{ $message }}</small>
							@enderror
						</div>
						
						<div class="input">
							<span aria-hidden="true"></span>
							<input type="password" placeholder="Password" name="password" id="password" oninput="this.value = this.value.replace(/\s/g, '')" required />
						</div>
						
						<div class="input">
							<span aria-hidden="true"></span>
							<input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" oninput="this.value = this.value.replace(/\s/g, '')" required />
						</div>
						
						<div class="input">
							<span aria-hidden="true"></span>
							<input type="text" placeholder="RSBSA" name="rsbsa" id="rsbsa" value="{{ old('rsbsa') }}" required />
							@error('rsbsa', 'register_error')
							<small class="error">{{ $message }}</small>
							@enderror
						</div>
						<div id="error_message" style="color: red; display: none;">Passwords do not match.</div>
						
						<button type="submit" class="btn submit" id="registerBtn">Register</button>
					</form>
					</article>
				</div>
				<div id="section3" class="section-w3ls">
					<input type="radio" name="sections" id="option3">
					<label for="option3" class="icon-left-w3pvt"><span class="fa fa-lock" aria-hidden="true"></span>Forgot Password?</label>
					<article>
						<form action="/reset_password" method="post" id="resetPassForm">
							@csrf
							<h3 class="legend last">Reset Password</h3>
							<p class="para-style">Enter your email address below and we'll send you a reset link.</p>
							<div class="input">
								<span class="fa fa-envelope-o" aria-hidden="true"></span>
								<input type="email" placeholder="Email" name="email" oninput="this.value = this.value.replace(/\s/g, '')" required />
							</div>
							@if(session('error'))
								<div class="alert alert-danger">{{ session('error') }}</div>
							@endif
							<button type="submit" class="btn submit last-btn">Reset</button>
						</form>
					</article>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- copyright -->
		<div class="copyright">
			<h2>&copy; 2024 AgTech. All rights reserved
			</h2>
		</div>
		<!-- //copyright -->
	</div>
<div id="weather_alert_map" style="display: none; height: 330px; width: 100%;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-6lStYy7YLcsM1hg5Po9DuUht8N-eO1Y&callback=initMap" async defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('registerForm').addEventListener('submit', function (event) {
    // Show the SweetAlert "Please wait" message
    Swal.fire({
        title: 'Please Wait!',
        text: 'Your registration is being processed.',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            popup: 'custom-swal-size',
        },
    });
});

document.getElementById('resetPassForm').addEventListener('submit', function (event) {
    // Show the SweetAlert "Please wait" message
    Swal.fire({
        title: 'Please Wait!',
        text: 'Sending reset link!',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            popup: 'custom-swal-size',
        },
    });
});

</script>
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
<script>
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

document.getElementById("confirm_password").addEventListener("input", function() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var errorMessage = document.getElementById("error_message");
    const submitButton = document.getElementById('registerBtn');

    // Check if password is not empty before comparing
    if (password && confirmPassword && password !== confirmPassword) {
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

	@if(session('alertify_error'))
		alertify.error('{{ session('alertify_error') }}');
	@endif
</script>


<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'8f05ba398850f8ea',t:'MTczMzkyMjc1OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='../../../../../../cdn-cgi/challenge-platform/h/g/scripts/jsd/f9063374b04d/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>


<!-- Mirrored from p.w3layouts.com/demos_new/template_demo/06-03-2019/triple_forms-demo_Free/1611343419/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Dec 2024 13:12:54 GMT -->
</html>