<?php
    include("db_connection.php");
    session_start();

    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: login/index.php");
    }

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: login/index.php");
    }

    if(isset($_POST["login"])){
        $sql = "SELECT * FROM accounts WHERE email = '$_POST[email]' AND password = '$_POST[password]' AND status = 'Active'";
        $account = $conn->query($sql);
        if($account->num_rows > 0){
            foreach($account as $data){
                $_SESSION['account_id']   = $data["id"];
                $_SESSION['email']        = $data["email"];
                $_SESSION['password']     = $data["password"];
                $_SESSION['display_name'] = $data["display_name"];
                $_SESSION['type']         = $data["type"];
            }
            if($_SESSION['type'] == "Administrator"){
                header("Location: index-admin.php");
            }
            else{
                header("Location: index-client.php");
            }
        }
        else{
            header("Location: login/index.php?error=1");
        }
    }

    if(isset($_POST["addNewForm"])){
        if($_FILES['form_attachment']['size'] > 0){
            $tmpFilePath1 = $_FILES["form_attachment"]['tmp_name'];
            $filePath1 = $_FILES["form_attachment"]['name'];
            $ext1  = pathinfo($filePath1, PATHINFO_EXTENSION);
            $newFilePath1 = "uploads/$filePath1";
            $filename1 = "$filePath1";
            move_uploaded_file($tmpFilePath1, $newFilePath1);
        }
        if($_FILES['thumbnail']['size'] > 0){
            $tmpFilePath2 = $_FILES["thumbnail"]['tmp_name'];
            $filePath2 = $_FILES["thumbnail"]['name'];
            $ext2  = pathinfo($filePath2, PATHINFO_EXTENSION);
            $newFilePath2 = "uploads/$filePath2";
            $filename2 = "$filePath2";
            move_uploaded_file($tmpFilePath2, $newFilePath2);
        }
        if($_FILES['workflow']['size'] > 0){
            $tmpFilePath3 = $_FILES["workflow"]['tmp_name'];
            $filePath3 = $_FILES["workflow"]['name'];
            $ext3  = pathinfo($filePath3, PATHINFO_EXTENSION);
            $newFilePath3 = "uploads/$filePath3";
            $filename3 = "$filePath3";
            move_uploaded_file($tmpFilePath3, $newFilePath3);
        }
        $sql = "INSERT INTO forms VALUES(
                id, 
                '$_POST[form_name]',
                '$_POST[reference_id]',
                '$_POST[form_index]',
                $_POST[form_category],
                '$filename1',
                '$filename2',
                '$filename3',
                '$_POST[form_description]',
                '$_POST[form_link]',
                'Active'
            )";
        $conn->query($sql);
        header("Location: forms-library.php?success=1");
    }

    if(isset($_POST["updateForm"])){
        $sql = "UPDATE forms SET
                form_name = '$_POST[form_name]',
                reference_id = '$_POST[reference_id]',
                form_index = '$_POST[form_index]',
                form_description = '$_POST[form_description]' 
                WHERE id = $_POST[form_id];
            ";
        $conn->query($sql);
        header("Location: forms-library.php?edit=1");
    }

    if(isset($_POST["archiveForm"])){
        $sql = "UPDATE forms SET
                status = '$_POST[status]' 
                WHERE id = $_POST[form_id];
            ";
        $conn->query($sql);
        if($_POST['status'] == 'Active')
            header("Location: forms-library.php?archived=1");
        else
            header("Location: forms-archived.php?archived=1");
    }

    if(isset($_POST["requestForm"])){
        $today = date('Y-m-d H:i:s');
        if(isset($_POST['form_id']))
            $formID = $_POST['form_id'];
        else
            $formID = -1;
        $sql = "INSERT INTO form_requests VALUES(
                id, 
                $formID,
                $_SESSION[account_id],
                '$_POST[requestor_email]',
                '$_POST[requestor_name]',
                '$_POST[phone_number]',
                '$_POST[request_notes]',
                '$today',
                '$today',
                'Pending'
            )";
        $conn->query($sql);
        header("Location: forms-request-client.php?success=1");
    }

    if(isset($_POST["cancelRequest"])){
        $sql = "UPDATE form_requests SET 
                status = 'Canceled' 
                WHERE id = $_POST[form_request_id]";
        $conn->query($sql);
        header("Location: forms-request-client.php?canceled=1");
    }

    if(isset($_POST["completeRequest"])){
        $sql = "UPDATE form_requests SET 
                status = 'Completed' 
                WHERE id = $_POST[form_request_id]";
        $conn->query($sql);
        header("Location: forms-request-completed.php?complete=1");
    }

    if(isset($_POST["reportRequest"])){
        $sql = "UPDATE form_requests SET 
                status = 'Reported' 
                WHERE id = $_POST[form_request_id]";
        $conn->query($sql);
        $sql = "INSERT INTO form_request_reports VALUES(
                id,
                $_POST[form_request_id],
                '$_POST[request_concerns]'
            )";
        $conn->query($sql);
        header("Location: forms-request-reported.php?reported=1");
    }

    if(isset($_POST["addNewAccount"])){
        $sql = "INSERT INTO accounts VALUES(
                id, 
                '$_POST[email]',
                '$_POST[password]',
                '$_POST[display_name]',
                '$_POST[contact_num]',
                '$_POST[type]',
                'Active'
            )";
        $conn->query($sql);
        header("Location: manage-users.php?success=1");
    }

    if(isset($_POST["accountStatus"])){
        $sql = "UPDATE accounts SET 
                status = '$_POST[status]' 
                WHERE id = $_POST[account_id]";
        $conn->query($sql);
        header("Location: manage-users.php?status=1");
    }

    if(isset($_POST["updateAccount"])){
        $sql = "UPDATE accounts SET 
                display_name = '$_POST[display_name]', 
                email = '$_POST[email]', 
                contact_num = '$_POST[contact_num]' 
                WHERE id = $_POST[account_id]";
        $conn->query($sql);
        header("Location: manage-users.php?update=1");
    }
?>