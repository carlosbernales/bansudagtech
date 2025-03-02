
@include('admin/header')

<style>

.glowing-text {
    font-size: 1.2rem;
    color: #FF0000; /* Red color for the text */
    text-shadow: 
        0 0 5px #FF0000, 
        0 0 10px #FF0000, 
        0 0 15px #FF0000, 
        0 0 20px #FF3300, 
        0 0 30px #FF3300, 
        0 0 40px #FF3300, 
        0 0 50px #FF3300;
    animation: glowing 1.5s infinite;
}

/* Animation for continuous glowing effect */
@keyframes glowing {
    0% {
        text-shadow: 
            0 0 5px #FF0000, 
            0 0 10px #FF0000, 
            0 0 15px #FF0000, 
            0 0 20px #FF3300, 
            0 0 30px #FF3300, 
            0 0 40px #FF3300, 
            0 0 50px #FF3300;
    }
    50% {
        text-shadow: 
            0 0 10px #FF0000, 
            0 0 20px #FF0000, 
            0 0 30px #FF0000, 
            0 0 40px #FF6600, 
            0 0 50px #FF6600, 
            0 0 60px #FF6600, 
            0 0 70px #FF6600;
    }
    100% {
        text-shadow: 
            0 0 5px #FF0000, 
            0 0 10px #FF0000, 
            0 0 15px #FF0000, 
            0 0 20px #FF3300, 
            0 0 30px #FF3300, 
            0 0 40px #FF3300, 
            0 0 50px #FF3300;
    }
}


    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-effect:hover {
        transform: scale(1.1);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
</style>


<!-- Start Status Area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <!-- Users Count -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 hover-effect" onclick="window.location.href='/farmers'">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $farmers }}</span></h2>
                        <p>Users</p>
                    </div>
                    <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 hover-effect" onclick="window.location.href='/farmers_farm'">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $farmCount }}</span></h2>
                        <p>Farms</p>
                    </div>
                    <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>
            </div>
            
            <!-- Calamity Reports -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 hover-effect" onclick="window.location.href='/calamity_reports'">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter">{{ $reports }}</span></h2>
                        <p>Calamity Reports</p>
                    </div>
                    <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                </div>
            </div>
            
            <!-- Assistance Provided -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 hover-effect" onclick="window.location.href='/completed_reports'">
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
            <div class="col-lg-12 col-md-10 col-sm-9 col-xs-12">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                        <div class="curved-ctn">
                            <h2>Farm Locations</h2>
                        </div>
                    </div>
                    <div id="weather_alert_map" style="height: 330px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sale-statistic-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-9 col-xs-12">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                        <div class="curved-ctn">
                            <h2>Monthly Calamity Reports and Prediction</h2>
                        </div>
                    </div>

                    <!-- Canvas for Chart.js -->
                    <canvas id="calamityChartBrief"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sale-statistic-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-9 col-xs-12">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                        <div class="curved-ctn">
                            <h2>Monthly Calamity Reports for 3 Years</h2>
                        </div>
                    </div>

                    <!-- Canvas for Chart.js -->
                    <canvas id="calamityChartBriefLine"></canvas>
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


 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-6lStYy7YLcsM1hg5Po9DuUht8N-eO1Y&callback=initMap" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var calamityDataForChart = @json($calamityStats);
var currentYear = new Date().getFullYear(); 
var currentMonth = new Date().getMonth() + 1; 
var monthLabelsForChart = [];
var calamityDataSets = {};
var fullBarLabels = [];

function generateRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getMonthNameForChart(month) {
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    return monthNames[month - 1];
}


for (var month = 1; month <= 12; month++) {
    let label = `${getMonthNameForChart(month)} ${currentYear}`;
    // Mark the next month as "Prediction"
    if (month === (currentMonth % 12) + 1) {
        label = `${label} (Prediction)`;
    }
    monthLabelsForChart.push(label);
}


calamityDataForChart.forEach(function(item) {
    var monthLabel = `${getMonthNameForChart(item.month)} ${item.year}`;
    var monthIndex = monthLabelsForChart.findIndex(label => label.startsWith(`${getMonthNameForChart(item.month)} ${item.year}`));

    
    if (!calamityDataSets[item.calamity_type]) {
        calamityDataSets[item.calamity_type] = {
            label: item.calamity_type,
            data: Array(monthLabelsForChart.length).fill(0), 
            backgroundColor: [],
            borderColor: 'rgba(0, 123, 255, 1)', 
            borderWidth: 1,
            municipalities: {}
        };
    }

  
    var groupKey = `${item.municipality}, ${item.barangay}`;

    if (!calamityDataSets[item.calamity_type].municipalities[groupKey]) {
        calamityDataSets[item.calamity_type].municipalities[groupKey] = Array(monthLabelsForChart.length).fill(0);
    }

    // Check if it's the current year
    if (item.year === currentYear) {
        calamityDataSets[item.calamity_type].municipalities[groupKey][monthIndex] += item.count;
    }

   
    if (item.year === (currentYear - 1) && item.month === (currentMonth % 12) + 1) {
        monthIndex = (currentMonth % 12); // Shift to next month for prediction
        calamityDataSets[item.calamity_type].municipalities[groupKey][monthIndex] += item.count;

  
        calamityDataSets[item.calamity_type].backgroundColor.push('rgba(0, 123, 255, 0.3)'); 
    } else {
        // Add normal data from the current year
        calamityDataSets[item.calamity_type].backgroundColor.push(generateRandomColor());
    }

    fullBarLabels.push(`${groupKey} - ${item.calamity_type}`);
});

var chartDataForCalamity = {
    labels: monthLabelsForChart,
    datasets: []
};


Object.keys(calamityDataSets).forEach(function(calamityType) {
    Object.keys(calamityDataSets[calamityType].municipalities).forEach(function(municipality) {
        chartDataForCalamity.datasets.push({
            label: `${municipality} (${calamityType})`,
            data: calamityDataSets[calamityType].municipalities[municipality],
            backgroundColor: calamityDataSets[calamityType].backgroundColor,
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        });
    });
});

var ctxForCalamityChart = document.getElementById('calamityChartBrief').getContext('2d');
var calamityChartInstanceForUnique = new Chart(ctxForCalamityChart, {
    type: 'bar',
    data: chartDataForCalamity,
    options: {
        responsive: true,
        scales: {
            x: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Month and Year' 
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Reports'  
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        var dataset = tooltipItem.dataset;
                        var index = tooltipItem.dataIndex;
                        return `${dataset.label}: ${dataset.data[index]} incidents`;
                    }
                }
            },
            legend: {
                display: false 
            }
        }
    }
});



var calamityDataForChart = @json($calamityStatsLine);
var currentYear = new Date().getFullYear();
var currentMonth = new Date().getMonth() + 1;
var monthLabelsForChart = [];
var calamityDataSets = {};
var fullBarLabels = [];


for (var year = currentYear - 2; year <= currentYear; year++) {
    for (var month = 1; month <= 12; month++) {
        if (year === currentYear && month > currentMonth) break;
        monthLabelsForChart.push(`${getMonthNameForChart(month)} ${year}`);
    }
}


calamityDataForChart.forEach(function(item) {
    var monthLabel = `${getMonthNameForChart(item.month)} ${item.year}`;
    var monthIndex = monthLabelsForChart.indexOf(monthLabel);

    if (!calamityDataSets[item.calamity_type]) {
        calamityDataSets[item.calamity_type] = {
            label: item.calamity_type,
            data: Array(monthLabelsForChart.length).fill(0),
            borderColor: generateRandomColor(),
            tension: 0.4,
            fill: false,
            municipalities: {}
        };
    }

    var groupKey = `${item.municipality}, ${item.barangay}`;
    if (!calamityDataSets[item.calamity_type].municipalities[groupKey]) {
        calamityDataSets[item.calamity_type].municipalities[groupKey] = Array(monthLabelsForChart.length).fill(0);
    }

    if (monthIndex >= 0) {
        calamityDataSets[item.calamity_type].municipalities[groupKey][monthIndex] += item.count;
    }
    fullBarLabels.push(`${groupKey} - ${item.calamity_type}`);
});


var chartDataForCalamity = {
    labels: monthLabelsForChart,
    datasets: []
};


Object.keys(calamityDataSets).forEach(function(calamityType) {
    Object.keys(calamityDataSets[calamityType].municipalities).forEach(function(municipality) {
        chartDataForCalamity.datasets.push({
            label: `${municipality} (${calamityType})`,
            data: calamityDataSets[calamityType].municipalities[municipality],
            borderColor: calamityDataSets[calamityType].borderColor,
            tension: 0.4,
            fill: false
        });
    });
});


var ctxForCalamityChart = document.getElementById('calamityChartBriefLine').getContext('2d');
var calamityChartInstanceForUnique = new Chart(ctxForCalamityChart, {
    type: 'line',
    data: chartDataForCalamity,
    options: {
        responsive: true,
        scales: {
            x: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Month and Year'
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Reports'
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        var dataset = tooltipItem.dataset;
                        var index = tooltipItem.dataIndex;
                        return `${dataset.label}: ${dataset.data[index]} incidents`;
                    }
                }
            },
            legend: {
                display: false
            }
        }
    }
});



</script>



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

///////////////////////////////////////////////////////////////////

window.onload = function () {
    if (typeof google !== 'undefined' && google.maps) {
        initMap(); // Ensure Google Maps API is available before calling initMap
    } else {
        console.error("Google Maps API failed to load.");
    }
};

function initMap() {
    const farms = @json($farms); 
    const mostAffectedLocations = @json($mostAffectedLocations); 
    let defaultLocation = @json($defaultLocation);

    if (!defaultLocation || defaultLocation.trim() === '') {
        defaultLocation = "Bansud, Oriental Mindoro, Philippines";
    }

    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ address: defaultLocation }, (results, status) => {
        if (status === "OK") {
            const map = new google.maps.Map(document.getElementById('weather_alert_map'), {
                zoom: 10,
                center: results[0].geometry.location
            });

            if (!farms || farms.length === 0) {
                console.log("No farm data available. Showing default location only.");
                return;
            }

            farms.forEach((farm) => {
                geocoder.geocode({ address: farm.location }, (results, status) => {
                    if (status === "OK") {
                        const position = results[0].geometry.location;

                        fetchWeather(position.lat(), position.lng(), (currentTemp, tomorrowTemp) => {
                            const marker = new google.maps.Marker({
                                map: map,
                                position: position,
                                title: farm.location,
                                label: `${currentTemp}°C`
                            });

                            const infowindow = new google.maps.InfoWindow({
                                content: `
                                    <p>${farm.location}</p>
                                    <p>Current Temperature: ${currentTemp}°C</p>
                                    <p>Tomorrow's Temperature: ${tomorrowTemp}°C</p>
                                `
                            });

                            marker.addListener('click', () => {
                                infowindow.open(map, marker);
                            });

                            if (currentTemp < -7 || currentTemp > 28) {
                                sendWeatherAlert(farm, currentTemp);
                            }
                        });

                        const isMostAffected = mostAffectedLocations.some(loc => loc.location === farm.location);
                        if (isMostAffected) {
                            const rippleCircle = new google.maps.Circle({
                                map: map,
                                center: position,
                                radius: 500, // Initial radius of 500 meters
                                strokeColor: 'red',
                                strokeOpacity: 0.8,
                                strokeWeight: 3,
                                fillColor: 'red',
                                fillOpacity: 0.2
                            });

                            let growing = true;
                            setInterval(() => {
                                let radius = rippleCircle.getRadius();
                                if (growing && radius >= 2000) growing = false; 
                                if (!growing && radius <= 500) growing = true;

                                rippleCircle.setRadius(radius + (growing ? 50 : -50)); 
                            }, 100);

                            const largeRipple = new google.maps.Circle({
                                map: map,
                                center: position,
                                radius: 1000,
                                strokeColor: 'red',
                                strokeOpacity: 0.4,
                                strokeWeight: 3,
                                fillColor: 'red',
                                fillOpacity: 0.1
                            });

                            let largeRippleGrowing = true;
                            setInterval(() => {
                                let radius = largeRipple.getRadius();
                                if (largeRippleGrowing && radius >= 2000) largeRippleGrowing = false; 
                                if (!largeRippleGrowing && radius <= 1000) largeRippleGrowing = true; 

                                largeRipple.setRadius(radius + (largeRippleGrowing ? 75 : -75)); 
                            }, 150);
                        }
                    } else {
                        console.error(`Geocode failed for ${farm.location}: ${status}`);
                    }
                });
            });
        } else {
            console.error(`Geocode failed for the default location: ${status}`);
        }
    });
}



function fetchWeather(lat, lng, callback) {
    const apiKey = "4e89cb6596765628fd6138f58d7454e1";

    const currentWeatherUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`;

    const forecastWeatherUrl = `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`;

    let currentTemp = 'N/A';
    let tomorrowTemp = 'N/A';

    fetch(currentWeatherUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.main && data.main.temp !== undefined) {
                currentTemp = data.main.temp;
            }
        })
        .catch(error => console.error('Error fetching current weather:', error))
        .finally(() => {
            fetch(forecastWeatherUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.list) {
                        // Find tomorrow's weather using the timestamp
                        const tomorrowTimestamp = new Date();
                        tomorrowTimestamp.setDate(tomorrowTimestamp.getDate() + 1);

                        const tomorrowWeather = data.list.find(item => {
                            const itemDate = new Date(item.dt * 1000);
                            return itemDate.getDate() === tomorrowTimestamp.getDate();
                        });

                        if (tomorrowWeather && tomorrowWeather.main) {
                            tomorrowTemp = tomorrowWeather.main.temp;
                        }
                    }
                })
                .catch(error => console.error('Error fetching forecast weather:', error))
                .finally(() => {
                    // Call the callback with both temperatures
                    callback(currentTemp, tomorrowTemp);
                });
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