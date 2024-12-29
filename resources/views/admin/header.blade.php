<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Agtech</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="admin_template/img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/owl.carousel.css">
    <link rel="stylesheet" href="admin_template/css/owl.theme.css">
    <link rel="stylesheet" href="admin_template/css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/notika-custom-icon.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/wave/waves.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="admin_template/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="admin_template/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="admin_template/css/wave/button.css">
    <link rel="stylesheet" href="admin_template/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
<style>
.swal2-modal {
    max-width: 300px !important; /* Adjust the width as needed */
    max-height: 270px !important;
    }
.swal2-icon {
    font-size: 8px; /* Change the size to your desired value */
    }

/* Add this to your CSS file */
.notification-item {
    border-bottom: 1px solid #ccc;
    color: black;
    padding: 10px;
}

.notification-item:hover {
    background-color: #f9f9f9; /* Optional: Add a hover effect */
}

</style>
    

    
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item nc-al">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                    <span>
                                        <i class="notika-icon notika-alarm"></i>
                                        @if($unreadNotifications->count() > 0)
                                            <span class="badge badge-danger">{{ $unreadNotifications->count() }}</span>
                                        @endif
                                    </span>
                                </a>
                                <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Notification</h2>
                                    </div>
                                    <div class="hd-message-info">
                                        @if($unreadNotifications->count() > 0)
                                            @foreach($unreadNotifications as $notification)
                                                <a href="#" class="dropdown-item notification-item" data-id="{{ $notification->id }}" style="border-bottom: 1px solid #ccc; color: black; padding: 10px;">
                                                    <strong>{{ $notification->fullname }}</strong> sent a calamity report. 
                                                    <button class="btn btn-sm btn-link mark-as-viewed" style="float: right;">View</button>
                                                    <br>
                                                </a>
                                            @endforeach
                                        @else
                                            <p class="dropdown-item" style="padding: 10px; color: black;">No notifications</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <span><i class="fas fa-sign-out-alt"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a href="/dashboard">Home</a>
                                </li>
                                <li><a href="/announcement">Announcements</a>
                                </li>
                                <li><a href="/assistances">Assistances</a>
                                </li>
                                <li><a href="/farmers_farm">Farmers Farm</a>
                                </li>
                                <li><a href="/farmers">Farmer List</a>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Calamity Report</a>
                                    <ul id="Pagemob" class="collapse dropdown-header-top">
                                        <li><a href="/calamity_reports">Reports</a>
                                        </li>
                                        <li><a href="/shortlisted_reports">Shortlisted</a>
                                        </li>
                                        <li><a href="/ongoing_reports">Ongoing</a>
                                        </li>
                                        <li><a href="/completed_reports">Completed</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                            <a href="/dashboard"> Dashboard</a>
                        </li>
                        <li class="{{ Request::is('announcement') ? 'active' : '' }}">
                            <a href="/announcement"> Announcement</a>
                        </li>
                        <li class="{{ Request::is('assistances') ? 'active' : '' }}">
                            <a href="/assistances"> Assistance</a>
                        </li>
                        <li class="{{ Request::is('farmers_farm') ? 'active' : '' }}">
                            <a href="/farmers_farm"> Farmers Farm</a>
                        </li>
                        <li data-toggle="tab" href="#Tables" class="{{ Request::is('calamity_reports') ? 'active' : '' }}">
                            <a href="/calamity_reports"> Calamity Reports</a>
                        </li>
                        <li class="{{ Request::is('farmers') ? 'active' : '' }}">
                            <a href="/farmers"> Farmers</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Tables" class="tab-pane {{ request()->is('calamity_reports') || request()->is('shortlisted_reports') 
                        || request()->is('ongoing_reports') || request()->is('completed_reports') ? 'active' : '' }}
                            notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="/calamity_reports">Reports</a>
                                </li>
                                <li><a href="/shortlisted_reports">Shortlisted</a>
                                </li>
                                <li><a href="/ongoing_reports">Ongoing</a>
                                </li>
                                <li><a href="/completed_reports">Completed</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main Menu area End-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).on('click', '.mark-as-viewed', function (e) {
        e.preventDefault();
        var notificationId = $(this).closest('.notification-item').data('id');
        var $this = $(this); // Store the current button context in $this

        console.log(notificationId);  // Check if notificationId is valid

        $.ajax({
            url: '{{ url('/notifications/upstatus') }}',
            method: 'POST',
            data: {
                notification_id: notificationId,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    // Update notification item
                    $this.closest('.notification-item').css('background-color', '#f0f0f0');
                    $this.text('Viewed');

                    // Redirect to the calamity reports page
                    window.location.href = '{{ url('/calamity_reports') }}';
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Log any errors
                alert('Error updating notification status');
            }
        });
    });
</script>

