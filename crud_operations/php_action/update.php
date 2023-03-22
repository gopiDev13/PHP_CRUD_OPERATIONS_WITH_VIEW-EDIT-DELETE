<?php
require_once('db_connection.php');


 
if($_POST) {
   
    $fname = $_POST["fname"];
  
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $address = $_POST["address"];
    $number = $_POST["number"];
    $exp = $_POST["exp"];
    $mail=$_POST["email"];
    $gender=$_POST['gender'];

$fnameErr = $lnameErr = $genderErr = $mailErr = $roleErr = $addressErr = $numberErr = $ferr = $expErr = "";


    if (empty(test_input($_POST["fname"]))) {
        $fnameErr = "please enter the name";
    } else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z' ']*$/", $fname)) {
            $fnameErr = "only letters allowed";
        }
    }

    if (empty(test_input($_POST["lname"]))) {
        $lnameErr = "please enter the name";
    } else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z' ']*$/", $lname)) {
            $lnameErr = "only letters allowed";
        }
    }

    $mail=test_input($_POST["email"]);
    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        $mailErr="please enter valid email";
         $mailErr;
    }else{
         $mail;
    }

    $number = test_input($_POST["number"]);
    if (!preg_match("/^[0-9' ']*$/", $number)) {
        $numberErr = "please enter numbers";

    }
    if (strlen($number) != 10) {
        $numberErr = "please enter within limits";
   
    } else {
        $number;
    }
    //   $mail=test_input($_POST["mail"]);
    //   if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
    //       $mailErr="please enter valid email";
    //        $mailErr;
    //   }else{
    //        $mail;
    //   }
    $address = $_POST["address"];
    if (empty($address)) {
        $addressErr = "please enter the address";
  
    } else {
        $address;
    }
    $role = $_POST['role'];
    if (empty($role)) {
        $roleErr = "please enter role";

    } else {
        $role;
    }
    $gender = $_POST["gender"];
   
    if (empty($gender)) {
        $genderErr = "please enter the address";
    } else {
        $gender;
    }
    $exp = $_POST['exp'];
    if (empty($exp)) {
        $expErr = "please enter exprience";
      
    } else {
        $exp;
    } 
    $ifile = $_FILES['image']['name'];
    $imageFileType = strtolower(pathinfo($ifile, PATHINFO_EXTENSION));
    if (empty($_FILES["image"]['name'])) {
        $ferr = "Please select file.";
    } else {

        if (move_uploaded_file($_FILES['image']['tmp_name'], $ifile)) {
            $f = $_FILES['image']['name'];
        }
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $ferr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }
}
    if ($fnameErr == "" &&  $genderErr == "" && $mailErr == "" && $lnameErr == "" && $roleErr == "" && $expErr == "" &&  $numberErr == "" && $addressErr == "")
         {
            $f="";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mail=$_POST["email"];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $gender=$_POST['gender'];
    $exp = $_POST['exp'];
    $id = $_POST['id'];
    $f = $_FILES['image']['name'];
    $filepath = realpath($f);
    $file = mysqli_real_escape_string($connect, $filepath);


    $sql="update emp_details set fname='$fname',lname='$lname',mail='$mail',role='$role',address='$address',number='$number',
    gender='$gender',exp='$exp',filename='$f',filepath='$file' where id= {$id}";
    if($connect->query($sql) === TRUE) {
		echo "<p>Succcessfully Updated</p>";
		echo "<a href='main.php'><button type='button'>Back</button></a>";
		echo "<a href='../index.php'><button type='button'>Home</button></a>";
	} else {
		echo "Erorr while updating record : ". $connect->error;
	}

	$connect->close();

}
else{
  echo "Enter valid details"."</br>";
  echo "<a href='main.php'><button type='button'>Back</button></a>";
	echo "<a href='../index.php'><button type='button'>Home</button></a>";
}

function test_input($data)
{

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;
}

?>