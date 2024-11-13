<?php
include('../../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $fagentType = $_POST['agentType'];
    $fAgentTitle = $_POST['name-title'];
    $fAgentFname = $_POST['ownerFname'];
    $fAgnetMname = $_POST['ownerFname'];
    $fAgentLname = $_POST['ownerLname'];
    $iqamaNo = $_POST['iqamaNumber'];
    $AgentWhatzapp = $_POST['ownerWhatzapp'];
    $AgentEMail = $_POST['ownerEmail'];
    $fagentRemark = $_POST['fAgentRemark'];
    $fagentMap = $_POST['mapEmbedCode'];

    // Insert into foreign_agent_details table
    $sql = "INSERT INTO `foreign_agent_details` (`fagentType`, `fagentTitle`, `fagentFname`, `fagentMname`, `fagentLname`, `fagentIqamaNo`, `fagentWhatzapp`, `fagentEmail`, `fagentRemark`, `fagentMap`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $fagentType, $fAgentTitle, $fAgentFname, $fAgnetMname, $fAgentLname, $iqamaNo, $AgentWhatzapp, $AgentEMail, $fagentRemark, $fagentMap);
    var_dump($sql);
    if (!$stmt->execute()) {
        echo "Error inserting agent details: " . $stmt->error;
        exit;
    }

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
    $agentsource = "FA";

    if (!empty($companyName)) {
        $sql = "INSERT INTO `fagent_company_details` (`fagentID`, `AgentSource`, `fagentRecruitmentID`, `AddressLine1`, `AddressLine2`, `companyCity`, `companyProvinceState`, `fagentCompanyName`, `fagnetComWebsite`, `personIncharge`, `pi_contact_number`, `pi_email_address`, `pi_designation`, `fagentComID`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssssss", $agent_id, $agentsource, $companyLNo, $CompanyAddress1, $CompanyAddress2, $companyCity, $CompanyProvince, $companyName, $CompanyWebsite, $contactPerson, $contactPno, $contactEmail, $contactDesignation, $companyBrNo);

        if (!$stmt->execute()) {
            echo "Error inserting company details: " . $stmt->error;
            exit;
        }

        $stmt->close();
    }

    // Check if any attachments are provided before inserting into attachments
    if (!empty($_FILES['documentAttachment']['name'][0])) {
        for ($i = 0; $i < count($_FILES['documentAttachment']['name']); $i++) {
            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['documentAttachment']['name'][$i]; // File name
            $doctype = 'Foreign-Agent';

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
                    $sql = "INSERT INTO `attachemnts_data` (`attachemnet_ClientID`, attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iisss", $agent_id, $agent_id, $doctype, $targetFile, $newFileName);

                    if (!$stmt->execute()) {
                        echo "Error inserting attachment: " . $stmt->error;
                        exit;
                    }
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect or show success message
    header("Location: ".$baseUrl."/agents/foreign-agent/view_all_foreign_agent.php");
    exit;
}
?>
