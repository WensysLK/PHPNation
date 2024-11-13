<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "
        SELECT 
            fagent_company_details.fagentCompanyName, 
            fagent_company_details.fagentComID, 
            fagent_company_details.fagentRecruitmentID, 
            fagent_company_details.pi_contact_number, 
            fagent_company_details.pi_email_address,
            fagent_company_details.fagnetCompanyID, 
            foreign_agent_details.fagentTitle,
            foreign_agent_details.fagentFname,
            foreign_agent_details.fagentMname,
            foreign_agent_details.fagentLname,
            foreign_agent_details.fagentProfile,
            foreign_agent_details.fagentId,
            foreign_agent_details.fagentType
        FROM 
            fagent_company_details
        INNER JOIN 
            foreign_agent_details 
        ON 
            fagent_company_details.fagnetCompanyID = foreign_agent_details.fagentId WHERE fagent_company_details.softdeletestatus = 1 AND foreign_agent_details.fagentType = 'Recruitment_Company'
    ";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>BR No</th>
            <th>Agency License</th>
            <th>Contacts</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $agentId = $row['fagentId'];
                        $agenttitle = $row['fagentTitle'];
                        $agentFname = $row['fagentFname'];
                        $agentMname = $row['fagentMname'];
                        $agentLname = $row['fagentLname'];
                        $CompanyName = $row['fagentCompanyName'];
                        $companyBr = $row['fagentComID'];
                        $agencyLicense = $row['fagentRecruitmentID'];
                        $agencycontat = $row['pi_contact_number'];
                        $agencyemail = $row['pi_email_address'];
                        $companyId = $row['fagnetCompanyID'];
                        $agentType = $row['fagentType'];
                        $agentprofile = $row['fagentProfile'];
                        
                        
                    ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="../../uploads/img/fallback-image.png" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $agenttitle . " " . $agentFname . " " . $agentLname; ?>
                    </div>

                </div>
            </td>
            <td><?php echo $CompanyName; ?></td>
            <td><?php echo $companyBr; ?></td>
            <td><?php echo $agencyLicense; ?></td>
            <td>

                <button type="submit" class="btn btn-warning btn-sm lni lni-pencil" data-bs-placement="top"
                    title="<?php echo $agencycontat;  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-phone-call">
                        <path
                            d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="btn btn-info btn-sm lni lni-eye" data-bs-placement="top" title="<?php echo $agencyemail;  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-at-sign">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                    </svg>
                </a>
            </td>
            <td>
                <form action="../applications/edit_registration.php" style="display: inline-block;" method="POST">
                    <input type="hidden" name="applicationID" value="<?php echo $applicationID; ?>">
                    <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit-2">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </button>
                </form>
                <a href="#" class="btn btn-success btn-sm lni lni-eye">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
                <button href="#" class="btn btn-danger btn-sm lni lni-trash">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php } else {
                echo "<div class='alert alert-primary mt-2' role='alert'> No Registere Agencies!</div>";
            }
        } ?>
</table>


<script>
$('.btn-warning').tooltip({
    template: '<div class="tooltip tooltip-primary" role="tooltip"> <
        div class = "arrow" > < /div> <
        div class = "tooltip-inner" > < /div> <
        /div>'
})
</script>