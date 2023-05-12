<?php
    include("db_connection.php");
    session_start();

    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: index.php");
    }

    if(isset($_POST["login"])){
        if($_POST["mode"] == "applicant"){
            $sql = "SELECT * FROM applicants WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                foreach($results as $row){
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["firstname"] = $row["firstname"];
                    $_SESSION["middlename"] = $row["middlename"];
                    $_SESSION["lastname"] = $row["lastname"];
                    $_SESSION["gender"] = $row["gender"];
                    $_SESSION["date_of_birth"] = $row["date_of_birth"];
                    $_SESSION["address"] = $row["address"];
                    $_SESSION["contact_num"] = $row["contact_num"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["resume"] = $row["resume"];
                    $_SESSION["education_attainment"] = $row["education_attainment"];
                    $_SESSION["last_school"] = $row["last_school"];
                    $_SESSION["skills"] = $row["skills"];
                    $_SESSION["type"] = "Applicant";
                }
                header("Location: dashboardA.php");
            }
            else{
                header("Location: index.php?error=1");
            }
        }
        else if($_POST["mode"] == "employer"){
            $sql = "SELECT * FROM employers WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                foreach($results as $row){
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["company"] = $row["company"];
                    $_SESSION["contact_person"] = $row["contact_person"];
                    $_SESSION["address"] = $row["address"];
                    $_SESSION["contact_num"] = $row["contact_num"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["company_profile"] = $row["company_profile"];
                    $_SESSION["type"] = "Employer";
                }
                header("Location: dashboardE.php");
            }
            else{
                header("Location: login_employer.php?error=1");
            }
        }
        else if($_POST["mode"] == "peso"){
            $sql = "SELECT * FROM admin WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                foreach($results as $row){
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["password"] = $row["password"];
                    $_SESSION["fullname"] = $row["fullname"];
                    $_SESSION["type"] = "Peso";
                }
                header("Location: dashboardP.php");
            }
            else{
                header("Location: login_employer.php?error=1");
            }
        }
    }

    if(isset($_POST["addNewForm"])){
        if($_FILES['form_attachment']['size'] > 0){
            $tmpFilePath = $_FILES["form_attachment"]['tmp_name'];
            $filePath = $_FILES["form_attachment"]['name'];
            $ext  = pathinfo($filePath, PATHINFO_EXTENSION);
            $newFilePath = "uploads/$filePath.$ext";
            $filename = "$filePath.$ext";
            move_uploaded_file($tmpFilePath, $newFilePath);
        }
        $sql = "INSERT INTO forms VALUES(
                id, 
                '$_POST[form_name]',
                '$_POST[reference_id]',
                '$_POST[form_index]',
                $_POST[form_category],
                '$filename',
                '$_POST[form_description]',
                '$_POST[form_link]'
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

    if(isset($_POST["updateApplication"])){
        $sql = "UPDATE job_applications set application_status = '$_POST[status]' WHERE id = $_POST[application_id]";
        $conn->query($sql);
        $sql = "INSERT INTO job_results VALUES(
                id,
                $_POST[application_id],
                '$_POST[interview_date]',
                '$_POST[interview_remarks]'
        )";
        $conn->query($sql);
        header("Location: dashboardP.php");
    }

    if(isset($_POST["newJobPost"])){
        $sql = "INSERT INTO jobs VALUES(id, $_SESSION[user_id], '$_POST[title]', '$_POST[work_address]', '$_POST[contact_person]', '$_POST[cp_num]', '$_POST[cp_email]', '$_POST[type]', '$_POST[description]', '$_POST[skills]', 'Open')";
        $conn->query($sql);
        $skillList = explode(" ", $_POST["skills"]);
        foreach($skillList as $skill){
            $sql = "SELECT * FROM applicants WHERE skills LIKE '%$skill%'";
            $theNumber = $conn->query($sql);
            foreach($theNumber as $number){
                $message = "Good Day, A new $_POST[type] job has been posted that matches one of your skillsets. The job position $_POST[title] is for $_SESSION[company] and job location is at $_POST[work_address]";
                $ch = curl_init();
                $parameters = array(
                    'apikey' => '8a555d02ac845e9cb359cdb27c300cd5', //Your API KEY
                    'number' => "$number[contact_num]",
                    'message' => "$message",
                    'sendername' => 'SEMAPHORE'
                );
                curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
                curl_setopt( $ch, CURLOPT_POST, 1 );
                //Send the parameters set above with the request
                curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
                // Receive response from server
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                $output = curl_exec( $ch );
                curl_close ($ch);
            }
        }
        header("Location: dashboardE.php");
    }

    if(isset($_POST["editJobPost"])){
        $sql = "UPDATE jobs SET title = '$_POST[title]', work_address = '$_POST[work_address]', contact_person = '$_POST[contact_person]', cp_num = '$_POST[cp_num]', cp_email = '$_POST[cp_email]', type = '$_POST[type]', description = '$_POST[description]', skills = '$_POST[skills]' WHERE id = $_POST[id]";
        $conn->query($sql);
        header("Location: dashboardE.php");
    }

    if(isset($_POST["closeJob"])){
        $sql = "UPDATE jobs SET status = 'Close' WHERE id = $_POST[job_id]";
        echo $sql;
        $conn->query($sql);
        header("Location: dashboardE.php");
    }

    if(isset($_POST["updateApplicantInfo"])){
        $tmpFilePath = $_FILES["resume"]['tmp_name'];
        $filePath = $_FILES["resume"]['name'];
        $ext  = pathinfo($filePath, PATHINFO_EXTENSION);
        $newFilePath = "resumes/$_POST[lastname], $_POST[firstname].$ext";
        if($ext != null)
            $filename = "$_POST[lastname], $_POST[firstname].$ext";
        else
            $filename = "";
        move_uploaded_file($tmpFilePath, $newFilePath);
        $sql = "UPDATE applicants SET password = '$_POST[password]', firstname = '$_POST[firstname]', middlename = '$_POST[middlename]', lastname = '$_POST[lastname]', gender = '$_POST[gender]', date_of_birth = '$_POST[date_of_birth]', address = '$_POST[address]', contact_num = '$_POST[contact_num]', email = '$_POST[email]', education_attainment = '$_POST[education_attainment]', last_school = '$_POST[last_school]', skills = '$_POST[skills]', resume = '$filename' WHERE id = $_SESSION[user_id]";
        $conn->query($sql);
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["middlename"] = $_POST["middlename"];
        $_SESSION["lastname"] = $_POST["lastname"];
        $_SESSION["gender"] = $_POST["gender"];
        $_SESSION["date_of_birth"] = $_POST["date_of_birth"];
        $_SESSION["address"] = $_POST["address"];
        $_SESSION["contact_num"] = $_POST["contact_num"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["resume"] = "";
        $_SESSION["education_attainment"] = $_POST["education_attainment"];
        $_SESSION["last_school"] = $_POST["last_school"];
        $_SESSION["skills"] = $_POST["skills"];
        $_SESSION["resume"] = $filename;
        header("Location: applicantInfo.php");
    }

    if(isset($_POST["updateCompanyInfo"])){
        $sql = "UPDATE employers SET password = '$_POST[password]', company = '$_POST[company]', contact_person = '$_POST[contact_person]', address = '$_POST[address]', contact_num = '$_POST[contact_num]', email = '$_POST[email]', company_profile = '$_POST[company_profile]' WHERE id = $_SESSION[user_id]";
        $conn->query($sql);
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["company"] = $_POST["company"];
        $_SESSION["contact_person"] = $_POST["contact_person"];
        $_SESSION["address"] = $_POST["address"];
        $_SESSION["contact_num"] = $_POST["contact_num"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["company_profile"] = $_POST["company_profile"];
        header("Location: companyInfo.php");
    }

    if(isset($_POST["registerAccount"])){
        if($_POST['password'] != $_POST['confirm_password'] && $_POST['mode'] == "applicant")
            header("Location: registerApplicant.php?incorrectPassword=1");
        else if($_POST['password'] != $_POST['confirm_password'] && $_POST['mode'] == "employer")
            header("Location: registerEmployer.php?incorrectPassword=1");
        else if($_POST['mode'] == "applicant"){
            $sql = "INSERT INTO applicants VALUES(id, '$_POST[username]', '$_POST[password]', '$_POST[firstname]', '$_POST[middlename]', '$_POST[lastname]', '$_POST[gender]', '$_POST[date_of_birth]', '$_POST[address]', '$_POST[contact_num]', '$_POST[email]', resume, education_attainment, last_school, skills)";
            $conn->query($sql);
            $user_id = $conn->insert_id;
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["firstname"] = $_POST["firstname"];
            $_SESSION["middlename"] = $_POST["middlename"];
            $_SESSION["lastname"] = $_POST["lastname"];
            $_SESSION["gender"] = $_POST["gender"];
            $_SESSION["date_of_birth"] = $_POST["date_of_birth"];
            $_SESSION["address"] = $_POST["address"];
            $_SESSION["contact_num"] = $_POST["contact_num"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["resume"] = "";
            $_SESSION["education_attainment"] = "";
            $_SESSION["last_school"] = "";
            $_SESSION["skills"] = "";
            $_SESSION["type"] = "Applicant";
            header("Location: dashboardA.php");
        }
        else{
            $sql = "INSERT INTO employers VALUES(id, '$_POST[username]', '$_POST[password]', '$_POST[company]', '$_POST[contact_person]', '$_POST[address]', '$_POST[contact_num]', '$_POST[email]', company_profile)";
            $conn->query($sql);
            $user_id = $conn->insert_id;
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["company"] = $_POST["company"];
            $_SESSION["contact_person"] = $_POST["contact_person"];
            $_SESSION["address"] = $_POST["address"];
            $_SESSION["contact_num"] = $_POST["contact_num"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["company_profile"] = "";
            $_SESSION["type"] = "Employer";
            header("Location: dashboardE.php");
        }
    }

    if(isset($_POST["newTrainingSeminar"])){
        $sql = "INSERT INTO seminars_trainings VALUES(
                id, 
                $_SESSION[user_id], 
                '$_POST[description]', 
                '$_POST[sem_location]', 
                '$_POST[sem_date]')";
        $conn->query($sql);
        header("Location: additionalInfo.php?newTraining=1");
    }

    if(isset($_POST["deleteTrainingSeminar"])){
        $sql = "DELETE FROM seminars_trainings WHERE id = $_POST[sem_id]";
        $conn->query($sql);
        header("Location: additionalInfo.php?deleteTrainingSeminar=1");
    }

    if(isset($_POST["newWorkExp"])){
        $sql = "INSERT INTO work_experiences VALUES(
                id, 
                $_SESSION[user_id], 
                '$_POST[work_exp_company]', 
                '$_POST[work_exp_title]', 
                '$_POST[year_range]')";
        $conn->query($sql);
        header("Location: additionalInfo.php?newWorkExp=1");
    }

    if(isset($_POST["deleteWorkExp"])){
        $sql = "DELETE FROM work_experiences WHERE id = $_POST[work_exp_id]";
        $conn->query($sql);
        header("Location: additionalInfo.php?deleteWorkExp=1");
    }

    if(isset($_POST["newCharRef"])){
        $sql = "INSERT INTO character_references VALUES(
                id, 
                $_SESSION[user_id], 
                '$_POST[ref_fullname]', 
                '$_POST[ref_title]', 
                '$_POST[ref_cp_num]')";
        $conn->query($sql);
        header("Location: additionalInfo.php?newCharRef=1");
    }

    if(isset($_POST["deleteCharRef"])){
        $sql = "DELETE FROM character_references WHERE id = $_POST[ref_id]";
        $conn->query($sql);
        header("Location: additionalInfo.php?deleteCharRef=1");
    }

    if(isset($_POST["newAttachment"])){
        $tmpFilePath = $_FILES["file_attachment"]['tmp_name'];
        $filePath = $_FILES["file_attachment"]['name'];
        $ext  = pathinfo($filePath, PATHINFO_EXTENSION);
        $newFilePath = "attachments/$_POST[att_description]-$_SESSION[user_id].$ext";
        $filename = "$_POST[att_description]-$_SESSION[user_id].$ext";
        move_uploaded_file($tmpFilePath, $newFilePath);
        $sql = "INSERT INTO file_attachments VALUES(
                id, 
                $_SESSION[user_id], 
                '$_POST[att_description]', 
                '$filename')";
        $conn->query($sql);
        header("Location: additionalInfo.php?newAttachment=1");
    }

    if(isset($_POST["deleteAttachment"])){
        $sql = "DELETE FROM file_attachments WHERE id = $_POST[att_id]";
        $conn->query($sql);
        header("Location: additionalInfo.php?deleteAttachment=1");
    }
?>