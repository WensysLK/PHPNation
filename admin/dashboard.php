<?php include('../includes/header.php'); ?>

<body>
    <?php include('../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">Dashboard</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                    <!--<button type="button" class="btn btn-xs btn-primary">New Registration</button>-->
                </div>
            </div>
            <div class="content">
                <h2>Hi! <?php echo $username; ?> Welcome</h2>
                <div class="card-body pd-y-30">
                    <div class="d-sm-flex">
                        <div class="media">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">
                                    Pending Applications
                                </h6>
                                <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="pendingcount">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    <a href="<?php echo $baseUrl; ?>/applications/view_all_applications.php" class="mg-l-10">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1l0 50.8c27.6 7.1 48 32.2 48 62l0 40c0 8.8-7.2 16-16 16l-16 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l0-24c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 24c8.8 0 16 7.2 16 16s-7.2 16-16 16l-16 0c-8.8 0-16-7.2-16-16l0-40c0-29.8 20.4-54.9 48-62l0-57.1c-6-.6-12.1-.9-18.3-.9l-91.4 0c-6.2 0-12.3 .3-18.3 .9l0 65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7l0-59.1zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Medicals Today</h6>
                                    <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="currentmedical">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    <a href="<?php echo $baseUrl; ?>/medical/view_all_medicals.php" class="mg-l-10">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Contracts Processing</h6>
                                    <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="contractspro">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    <a href="<?php echo $baseUrl; ?>/Contracts/view_all_Contracts.php" class="mg-l-10">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Enjaz Processing</h6>
                                    <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="enjazpro">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    <a href="<?php echo $baseUrl; ?>/enjaz/view_all_enjaz.php" class="mg-l-10">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Muzaned Processing</h6>
                                    <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="muzanedpro">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    <a href="<?php echo $baseUrl; ?>/muzaned/view_all_muzaned.php" class="mg-l-10">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- card-body -->
            </div>
        </div>



        <?php include('../includes/footer.php'); ?>

        <!-- Ajax Dashboard Widget -->
        <?php 
        
        include('ajax-dashboards/application-ajax.php'); 
        include('ajax-dashboards/medical-current-ajax.php'); 
        include('ajax-dashboards/contract-processing-ajax.php');
        include('ajax-dashboards/enjaz-processing-ajax.php');
        include('ajax-dashboards/muzaned-processing-ajax.php');
        
        
        
        
        
        
        ?>

      
</body>

</html>