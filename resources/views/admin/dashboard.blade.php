
@include('admin/header')





<!-- Start Status Area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <!-- Users Count -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $farmCount }}</span></h2>
                        <p>Users</p>
                    </div>
                    <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                </div>
            </div>
            <!-- Farms Count -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $farmCount }}</span></h2>
                        <p>Farms</p>
                    </div>
                    <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>
            <!-- Calamity Reports -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $reports }}</span></h2>
                        <p>Calamity Reports</p>
                    </div>
                    <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                </div>
            </div>
            <!-- Assistance Provided -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $completedReports }}</span></h2>
                        <p>Given Assistance</p>
                    </div>
                    <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sale-statistic-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12" style="width: 100%;">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                    <div class="curved-ctn" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <h2>Farm Locations</h2>
                        <button class="btn btn-lightgreen lightgreen-icon-notika">Send Alarm</button>
                    </div>
                    </div>
                    <div id="map" style="height: 330px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Status Area -->


<!-- Start Email and Posts Area -->
<div class="notika-email-post-area">
    <div class="container">
        <div class="row">
            <!-- Email Statistics -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="email-statis-inner notika-shadow">
                    <div class="email-rdn-hd" style="height: 30px; width: 100%;">
                        <h2>Calamity Reports</h2>
                    </div>
                    <div class="email-statis-wrap">
                        <canvas id="calamityReportsChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Recent Posts -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-post-wrapper notika-shadow sm-res-mg-t-30 tb-res-ds-n dk-res-ds">
                    <div class="recent-post-ctn">
                        <div class="recent-post-title" style="height: 30px; width: 100%;">
                            <h2>Crop and Animal Reports</h2>
                        </div>
                    </div>
                    <div class="recent-post-items">
                        <canvas id="groupedCalamityChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Recent Items -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
                    <div class="rc-it-ltd">
                        <div class="recent-items-ctn">
                            <div class="recent-items-title">
                                <h2>Commodity Data</h2>
                            </div>
                        </div>
                        <div class="recent-items-inn">
                            <canvas id="commodityChart" class="small-chart"></canvas>  <!-- Add class for styling -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .small-chart {
    width: 150px !important;  /* Adjust to your desired width */
    height: 170px !important; /* Adjust to your desired height */
}
</style>

<!-- End Email and Posts Area -->
<script async defer src="googlemapsAPI.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('groupedCalamityChart').getContext('2d');
        const groupedCalamityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($groupedLabels),
                datasets: [
                    {
                        label: 'Crop Reports',
                        data: @json($groupedCrops),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4,
                    },
                    {
                        label: 'Animal Reports',
                        data: @json($groupedAnimals),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.4,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month Year'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Reports Count'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });

    

    function initMap() {
        const farmLocations = @json($farmLocations); 
        const defaultLocation = @json($defaultLocation); 

        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: defaultLocation }, (results, status) => {
            if (status === "OK") {
                const map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: results[0].geometry.location 
                });

                farmLocations.forEach(address => {
                    geocoder.geocode({ address: address }, (results, status) => {
                        if (status === "OK") {
                            const position = results[0].geometry.location;

                            // Fetch weather data and add marker with temperature label
                            fetchWeather(position.lat(), position.lng(), (temp) => {
                                const marker = new google.maps.Marker({
                                    map: map,
                                    position: position,
                                    title: address,
                                    label: temp + '°C' // Display temperature on marker
                                });

                                const infowindow = new google.maps.InfoWindow({
                                    content: `<p>${address}</p><p>Temperature: ${temp}°C</p>`
                                });

                                marker.addListener('click', () => {
                                    infowindow.open(map, marker);
                                });
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
                    callback(data.main.temp); // Pass temperature to callback
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


    /////////////////////////////////////////////////////////////////
    const ctx = document.getElementById('calamityReportsChart').getContext('2d');
    const calamityReportsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Reports per Month',
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxCommodity = document.getElementById('commodityChart').getContext('2d');
    const commodityChart = new Chart(ctxCommodity, {
        type: 'pie',  // Pie chart type
        data: {
            labels: @json($commodityData['labels']),
            datasets: [{
                label: 'Commodity Distribution',
                data: @json($commodityData['data']),
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',  // Color for crops
                    'rgba(255, 99, 132, 0.2)',  // Color for animals
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,  // Disable legend
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });

    
</script>
    @include('admin/footer')