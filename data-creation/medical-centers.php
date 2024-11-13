<?php include('../includes/header.php'); 
include('../includes/db_config.php');


?>

<body>
    <?php include('../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Medical Centers</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">

                    <a href="#modal6" data-bs-toggle="modal" data-animation="effect-slide-in-bottom">
                        <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="user-plus"></i>
                        </button>

                    </a>


                </div>
            </div>

            <div class="content">
            <table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "SELECT `MediName`, `AddressLine1`, `AddressLine2`, `mediCity`, `mediPhone`, `mediEmail`, `mediWebsite` FROM `medical_center` WHERE softdeletestatus=1";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Medical center name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th>Web site</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $mediCentName = $row['MediName'];
                        $mediAdd1 = $row['AddressLine1'];
                        $mediAdd2 = $row['AddressLine2'];
                        $mediCity = $row['mediCity'];
                        $mediPhone = $row['mediPhone'];
                        $mediEmail = $row['mediEmail'];
                        $mediWebsite = $row['mediWebsite'];
                        
                    ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-2">
                                    <?php echo $mediCentName; ?>
                                </div>
                                
                            </div>
                        </td>
                        <td><?php echo $mediAdd1 .'<br>'.$mediAdd2; ?></td>
                        <td><?php echo $mediCity; ?></td>
                        <td><?php echo '+'. $mediPhone; ?></td>
                        <td><?php echo $mediEmail; ?></td>
                        <td><?php echo $mediWebsite; ?></td>
                        <td>
                            <form action="../applications/edit_registration.php" style="display: inline-block;" method="POST">
                                <input type="hidden" name="applicationID" value="<?php echo $applicationID; ?>">
                                <button type="submit" class="btn btn-success btn-sm lni lni-pencil">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </button>
                            </form>
                            <button href="#" class="btn btn-danger btn-sm lni lni-trash">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            <?php } else {
                echo "<div class='alert alert-primary mt-2' role='alert'> No Available Applications !</div>";
            }
        } ?>
</table>




            </div>
        </div>
        <!--Popup form for Precheck Registration -->
        <?php include('popups/create-medical-center.php'); ?>
        <!-- End popup -->

        
    
    <?php include('../includes/footer.php'); ?>


</body>

</html>