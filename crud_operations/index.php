<html>

<head>
    <title>Add Employess</title>

<body>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 50%;
        }

        table tr th {
            padding-top: 20px;
        }
    </style>
    <?php
    require_once('php_action/db_connection.php');

    // $fname = $_POST["fname"];
    // $lname = $_POST["lname"];
    // $role = $_POST["role"];
    // $address = $_POST["address"];
    // $number = $_POST["number"];
    // $exp = $_POST["exp"];
    $fnameErr = $ferr = $lnameErr =  $mailErr = $roleErr = $addressErr = $genderErr = $numberErr = $expErr = "";
    if ($_POST) {

        $fname = $_POST["fname"];

        $lname = $_POST["lname"];
        $role = $_POST["role"];
        $address = $_POST["address"];
        $number = $_POST["number"];
        $exp = $_POST["exp"];
        $mail = $_POST["email"];
        $f = "";

        $fnameErr = $lnameErr =  $mailErr = $roleErr = $addressErr = $genderErr = $numberErr = $expErr = $ferr = "";


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

        $number = test_input($_POST["number"]);
        if (!preg_match("/^[0-9' ']*$/", $number)) {
            $numberErr = "please enter numbers";
        }
        if (strlen($number) != 10) {
            $numberErr = "please enter within limits";
        } else {
            $number;
        }
        $mail = test_input($_POST["email"]);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "please enter valid email";
            $mailErr;
        } else {
            $mail;
        }
        $address = $_POST["address"];
        if (empty($address)) {
            $addressErr = "please enter the address";
        } else {
            $address;
        }
        $gender = $_POST["gender"];
        if (empty($gender)) {
            $genderErr = "please enter the address";
        } else {
            $gender;
        }
        $role = $_POST['role'];
        if (empty($role)) {
            $roleErr = "please enter role";
        } else {
            $role;
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
        $sql_u = "SELECT * FROM emp_details WHERE number='$number'";
        $sql_e = "SELECT * FROM emp_details WHERE mail='$mail'";
        $res_u = mysqli_query($connect, $sql_u);
        $res_e = mysqli_query($connect, $sql_e);


        if (mysqli_num_rows($res_u) > 0) {

            $numberErr = "Sorry number already taken";
        }
        if (mysqli_num_rows($res_e) > 0) {
            $mailErr = "Sorry... email already taken";
        }

        if ($fnameErr == "" && $ferr == "" && $mailErr == "" && $genderErr == "" && $lnameErr == "" && $roleErr == "" && $expErr == "" &&  $numberErr == "" && $addressErr == "") {

            // $fname = $_POST["fname"];
            // $lname = $_POST["lname"];
            // $role = $_POST["role"];
            // $address = $_POST["address"];
            // $number = $_POST["number"];
            // $exp = $_POST["exp"];

            $f = $_FILES['image']['name'];
            $filepath = realpath($f);
            $file = mysqli_real_escape_string($connect, $filepath);




            $sql = "INSERT INTO emp_details (fname, lname,mail,role, address, number,gender,exp,filename,filepath,status) VALUES ('$fname', '$lname','$mail','$role', '$address','$number','$gender','$exp','$f','$file', 1)";
            if ($connect->query($sql) === TRUE) {
                echo "<p>New Record Successfully Created</p>";
                echo "<a href='index.php'><button type='button'>Back</button></a>";
                echo "<a href='php_action/main.php'><button type='button'>Home</button></a>";
            } else {
                echo "Error " . $sql . ' ' . $connect->connect_error;
            }

            $connect->close();
        } else {
            echo "please enter valid details";
        }
    }
    function test_input($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;
    }


    ?>
    <fieldset>
        <legend>Add Employess</legend>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>First Name</th>
                    <td><input type="text" name="fname">
                        <span class="error"><?php echo $fnameErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input type="text" name="lname">
                        <span class="error"><?php echo $lnameErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <th>Mail</th>
                    <td><input type="text" name="email">
                        <span class="error"><?php echo $mailErr; ?>
                    </td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><input type="text" name="role">
                        <span class="error"><?php echo $roleErr; ?></span>
                    </td>
                <tr>
                    <th>Address</th>

                    <td><input type="text" name="address">
                        <span class="error"><?php echo $addressErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><input type="text" name="number">
                        <span class="error"><?php echo $numberErr; ?></span>
                    </td>
                </tr>
                <th>Gender</th>
                <td><input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked='checked'"; ?>>Female
                    <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender == "male")  echo "checked='checked'"; ?>>Male
                    <input type="radio" name="gender" value="other" <?php if (isset($gender) && $gender == "other")  echo "checked='checked'"; ?>>Other
                    <span class="error"> <?php echo $genderErr; ?></span>

                </td>
                </tr>
                <tr>
                    <th>Experience</th>
                    <td><input type="number" name="exp">
                        <span class="error"><?php echo $expErr; ?></span>
                    </td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><input type="file" name="image" id="img">
                        <img id="blah" src="#"/>
                        <span class="error"><?php echo $ferr; ?></span>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="submit"></td>
                    <td><a href="php_action/main.php"><button type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <script>
        $(document).ready(function() {
            $("#img").change(function() {
                readURL(this);
            });

            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "Letters only please");
            $(".form").validate({
                rules: {
                    fname: {
                        required: true,
                        lettersonly: true,
                        minlength: 3
                    },
                    lname: {
                        required: true,
                        lettersonly: true,
                        minlength: 1
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    gender: {
                        required: true,
                    },

                    role: {
                        required: true,
                        lettersonly: true
                    },
                    number: {
                        required: true,
                        minlength: 3,
                        maxlength: 10
                    },
                    address: {
                        required: true,
                    },
                    exp: {
                        required: true,
                        min: 1,
                        max: 10

                    },
                    image: {
                        required: true,
                        extension: "pdf|jpg|jpeg"
                    }


                },
                errorPlacement: function(error, element) {
                    if (element.attr('type') == 'radio') {
                        error.appendTo(element.closest('td'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });



        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</head>

</html>