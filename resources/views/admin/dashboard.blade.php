
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
<!-- End Status Area -->
<div style="margin-top: 30px;"></div>
<!-- Start Email and Posts Area -->
<div class="notika-email-post-area">
    <div class="container">
        <div class="row">
            <!-- Email Statistics -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="email-statis-inner notika-shadow">
                    <div class="email-rdn-hd">
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
                        <div class="recent-post-title">
                            <h2>Recent Posts</h2>
                        </div>
                    </div>
                    <div class="recent-post-items">
                        <!-- Content Here -->
                    </div>
                </div>
            </div>
            <!-- Recent Items -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
                    <div class="rc-it-ltd">
                        <div class="recent-items-ctn">
                            <div class="recent-items-title">
                                <h2>Recent Items</h2>
                            </div>
                        </div>
                        <div class="recent-items-inn">
                            <!-- Content Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Email and Posts Area -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
</script>
    @include('admin/footer')