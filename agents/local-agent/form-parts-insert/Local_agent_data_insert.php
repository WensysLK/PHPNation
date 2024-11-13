<?php
include('../../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $lagentType = $_POST['agentType'];
    $lAgentTitle = $_POST['name-title'];
    $lAgentFname = $_POST['ownerFname'];
    $lAgnetMname = $_POST['ownerFname'];
    $lAgentLname = $_POST['ownerLname'];
    $nicNo = $_POST['nicNumber'];
    $lgentWhatzapp = $_POST['phoneNumber'];
    $lgentEMail = $_POST['ownerEmail'];
    $lagentRemark = $_POST['fAgentRemark'];
    $lagentMap = $_POST['mapEmbedCode'];
    

    $sql = "INSERT INTO `local_agent_details`(`localAgentType`, `Local_Agent_Title`, `Local_Agent_Fname`, `Local_Agent_Mname`, `Local_Agent_Lname`, `Local_Agent_Nic`, `Local_Agent_Phone`, `Local_Agent_Email`, `Local_Agent_Remark`, `Local_Agent_Map`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $lagentType, $lAgentTitle,$lAgentFname,$lAgnetMname,$lAgentLname,$nicNo,$lgentWhatzapp,$lgentEMail,$lagentRemark,$lagentMap);
    $stmt->execute();
    $agent_id = $stmt->insert_id; // Get the last inserted ID for the agent to use in the other tables
    $stmt->close();

    // Check if company data is provided before inserting into agentcompany
    $companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';
    $CompanyWebsite = $_POST['companyWebsite'];
    $companyBrNo = $_POST['companyBr'];
    $companyLNo = $_POST['RecLicens'];
    $CompanyAddress1 = $_POST['fagentddress1'];
    $CompanyAddress2 = $_POST['fagentaddress2'];
    $companyCity = $_POST['fagentcity'];
    $CompanyProvince = $_POST['fagentprovince'];
    $contactPerson = $_POST['inchargeName'];
    $contactPno = $_POST['inchargePhone'];
    $contactEmail = $_POST['inchargeEmail'];
    $contactDesignation = $_POST['inchargedesignation'];
    $agentsource = "LA";
    
    if (!empty($companyName)) {
        $sql = "INSERT INTO `fagent_company_details`
        (`fagentID`,`AgentSource`, 
        `fagentRecruitmentID`, `AddressLine1`, 
        `AddressLine2`, `companyCity`, 
        `companyProvinceState`, `fagentCompanyName`, 
        `fagnetComWebsite`, `personIncharge`, 
        `pi_contact_number`, `pi_email_address`, 
        `pi_designation`, 
        `fagentComID`) VALUES 
        (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssssss", $agent_id,$agentsource, 
        $companyLNo,$CompanyAddress1,$CompanyAddress2,
        $companyCity,$CompanyProvince,$companyName,$CompanyWebsite,$contactPerson,
        $contactPno,$contactEmail,$contactDesignation, $companyBrNo);
        $stmt->execute();
        $stmt->close();
    }

    // Check if any attachments are provided before inserting into attachments
    if (!empty($_FILES['documentAttachment']['name'][0])) {
        for ($i = 0; $i < count($_FILES['documentAttachment']['name']); $i++) {
            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['documentAttachment']['name'][$i]; // File name
            $doctype = 'Local-Agent';
    
            // Check if both document name and attachment are provided
            if (!empty($documentName) && !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";
    
                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);
    
                // Create a new file name with the document type and agent_id
                $newFileName = $documentName . "_" . $agent_id . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;
    
                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['documentAttachment']['tmp_name'][$i], $targetFile)) {
                    // Insert the file details into the attachments table
                    $sql = "INSERT INTO `attachemnts_data` 
                            (`attachemnet_ClientID`,attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) 
                            VALUES (?, ?, ?, ?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iisss", $agent_id, $agent_id, $doctype, $targetFile, $newFileName);
                    $stmt->execute();
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }
        }
    }
       

    // Close the database connection
    $conn->close();

    // Redirect or show success message
    header("Location: ".$baseUrl."../view_all_local_agent.php");
}