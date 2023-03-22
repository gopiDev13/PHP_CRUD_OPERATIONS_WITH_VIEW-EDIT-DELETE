<?php
    require_once('db_connection.php');
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $address = $_POST["address"];
    $number = $_POST["number"];
    $exp = $_POST["exp"];
    // $fnameErr = $lnameErr = $roleErr = $addressErr = $numberErr = $expErr = "";
    if($_POST) {
        





    //     if (empty(test_input($_POST["fname"]))) {
    //         $fnameErr = "please enter the name";
    //     } else {
    //         $fname = test_input($_POST["fname"]);
    //         if (!preg_match("/^[a-zA-Z' ']*$/", $fname)) {
    //             $fnameErr = "only letters allowed";
    //         }
    //     }

    //     if (empty(test_input($_POST["lname"]))) {
    //         $lnameErr = "please enter the name";
    //     } else {
    //         $lname = test_input($_POST["lname"]);
    //         if (!preg_match("/^[a-zA-Z' ']*$/", $lname)) {
    //             $lnameErr = "only letters allowed";
    //         }
    //     }

    //     $number = test_input($_POST["number"]);
    //     if (!preg_match("/^[0-9' ']*$/", $number)) {
    //         $numberErr = "please enter numbers";
    //         $numberErr;
    //     }
    //     if (strlen($number) != 10) {
    //         $numberErr = "please enter within limits";
    //         $numberErr;
    //     } else {
    //         $number;
    //     }
    //     //   $mail=test_input($_POST["mail"]);
    //     //   if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
    //     //       $mailErr="please enter valid email";
    //     //        $mailErr;
    //     //   }else{
    //     //        $mail;
    //     //   }
    //     $address = $_POST["address"];
    //     if (empty($address)) {
    //         $addressErr = "please enter the city details";
    //         $addressErr;
    //     } else {
    //         $address;
    //     }
    //     $role = $_POST['role'];
    //     if (empty($role)) {
    //         $roleErr = "please enter the city details";
    //         $roleErr;
    //     } else {
    //         $role;
    //     }
    //     $exp = $_POST['exp'];
    //     if (empty($exp)) {
    //         $expErr = "please enter the city details";
    //         $expErr;
    //     } else {
    //         $exp;
    //     }
    // if ($fnameErr == "" && $lnameErr == "" && $roleErr == "" && $expErr == "" &&  $numberErr == "" && $addressErr == "") {
            $sql = "INSERT INTO emp_details (fname, lname, role, address, number,exp,status) VALUES ('$fname', '$lname', '$role', '$address','$number','$exp', 1)";
            if ($connect->query($sql) === TRUE) {
                echo "<p>New Record Successfully Created</p>";
                echo "<a href='../index.php'><button type='button'>Back</button></a>";
                echo "<a href='../php_action/main.php'><button type='button'>Home</button></a>";
            } else {
                echo "Error " . $sql . ' ' . $connect->connect_error;
            }

            $connect->close();
        // } else {
        //     echo "please enter valid details";
        // }
    //}
    // function test_input($data)
    // {

    //     $data = trim($data);

    //     $data = stripslashes($data);

    //     $data = htmlspecialchars($data);

    //     return $data;
    }

    ?>


