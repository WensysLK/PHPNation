<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php

    // Query to get clients whose contracts have started
    $sqlmedical = "SELECT 
    contract_details.contractId, 
    contract_details.ContractStartus, 
    contract_details.MuzanedStatus,
    contract_details.fprintStatus,
    contract_details.EnjazSatus,
    contract_details.medicalStatus,
    applications.applicationID,
    applications.applicantDob,
    applications.applicantTitle, 
    applications.applicatFname, 
    applications.applicantLname, 
    applications.applicantPassno, 
    applications.profile_image,
    applications.applicantNICno,
    enjaz_details.EnjazRef, 
    enjaz_details.EnjazDate,
    enjaz_details.EnjazId,
    job_positions.positionName,
    job_orders.Visanumber,
    job_orders.VisaCategoryID,
    job_orders.JobOrderId, 
    foreign_agent_details.fagentId, 
    foreign_agent_details.fagentTitle, 
    foreign_agent_details.fagentFname, 
    foreign_agent_details.fagentLname
FROM 
    contract_details
JOIN 
    applications ON contract_details.applicationID = applications.applicationID
JOIN 
     enjaz_details ON contract_details.applicationID = enjaz_details.CleintId
JOIN 
     job_positions ON enjaz_details.jobpositionId = job_positions.positionId
JOIN 
    job_orders ON enjaz_details.jobOrderId = job_orders.JobOrderId
JOIN 
     foreign_agent_details ON job_orders.AgentID = foreign_agent_details.fagentId
WHERE 
    contract_details.ContractStartus = 'started'
    AND contract_details.softdeletestatus = 1
    AND contract_details.MuzanedStatus = 'completed'
    AND contract_details.fprintStatus = 'completed'
    AND contract_details.EnjazSatus = 'completed'
    AND contract_details.medicalStatus = 'completed'
    AND contract_details.BeauroStatus='not_started' ";

    $resmedical = mysqli_query($conn, $sqlmedical);

    if ($resmedical == true) {
        $count_rows = mysqli_num_rows($resmedical);
        $num = 1;

        if ($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Contract Number</th>
            <th>Name</th>
            <th>Passport</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resmedical)) {
                $contractId = $row['contractId']; // Contract ID
                $applicantID = $row['applicationID'];
                $enjazId = $row['EnjazId'];
                $applicantDob = $row['applicantDob'];
                $applicationTitle = $row['applicantTitle'];
                $applicationFname = $row['applicatFname'];
                $applicationLname = $row['applicantLname'];
                $applicationPassport = $row['applicantPassno'];
                $applicationnic = $row['applicantNICno'];
                $applicationPhoto = $row['profile_image'];
                $sponcertitle = $row['fagentTitle'];
                $sponcerfname = $row['fagentFname'];
                $sponcerLname = $row['fagentLname'];
                $visanumber = $row['Visanumber']; 
                $visacategory = $row['VisaCategoryID']; 
                $visaposition = $row['positionName'];
                              
                $profileImage = '../uploads/profile_images/'.$applicationPhoto;

                $fallbackimage = '../uploads/img/fallback-image.png';
 
                                  // Check if image path exists and is not empty
                $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;
                
                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $contractId; ?></td> <!-- Display Contract ID -->
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="<?php echo $imgSrc; ?>" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $applicationTitle . " " . $applicationFname . " " . $applicationLname; ?>
                    </div>
                </div>
            </td>
            <td><?php echo $applicationPassport; ?></td>
            <td>
                <a href="#submitburea" class="btn btn-primary btn-sm lni " data-bs-toggle="modal" 
                data-applicant-id="<?php echo $applicantID; ?>" 
                data-contract-id="<?php echo $contractId; ?>" 
                data-client-title="<?php echo $applicationTitle;?>"
                data-enjaz-id="<?php echo $enjazId;?>" 
                data-applicant-fname="<?php echo $applicationFname; ?>" 
                data-applicant-lname="<?php echo $applicationLname; ?>"
                data-sponcer-title="<?php echo $sponcertitle; ?>"
                data-sponcer-fname="<?php echo $sponcerfname; ?>" 
                data-sponcer-lname="<?php echo $sponcerLname; ?>"
                data-visanumber="<?php echo $visanumber; ?>"
                data-visacategory="<?php echo $visacategory; ?>"
                data-position="<?php echo $visaposition; ?>"
                data-dob="<?php echo $applicantDob; ?>" 
                data-passport="<?php echo $applicationPassport; ?>" 
                data-image="<?php echo $applicationPhoto; ?>"
                data-nic="<?php echo $applicationnic; ?>"
                     data-animation="effect-slide-in-bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-plus">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">

                        </path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </a>
                <a href="" class="btn btn-primary btn-sm lni ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-edit">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </a>
                <a href="#" class="btn btn-success btn-sm lni lni-eye">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
                <a href="#" class="btn btn-danger btn-sm lni lni-trash"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php 
        } else {
            echo "<div class='alert alert-primary mt-2' role='alert'> No Available Contracts for Bureau Submission!</div>";
        }
    } ?>
</table>
 <!--Popup form for Precheck Registration -->
 <?php include('popups/submit_bureau.php'); ?>
        <!-- End popup -->