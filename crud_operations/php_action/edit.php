<?php
require_once('db_connection.php');

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM emp_details WHERE id = {$id}";
    $result = $connect->query($sql);

    $data = $result->fetch_assoc();

    $connect->close();
}

?>
<html>
<title>Edit</title>
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
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<body>




    <form action="update.php" method="POST" id="form" enctype="multipart/form-data">
        <fieldset>
            <legend>Edit Employee Details</legend>
            <table>
                <tr>
                    <th>First Name</th>
                    <td><input type="text" name="fname" value="<?php echo $data['fname']; ?>">
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input type="text" name="lname" value="<?php echo $data['lname']; ?>">
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <th>Mail</th>
                    <td><input type="text" name="email" value="<?php echo $data['mail']; ?>">
                        <span class="error">
                    </td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><input type="text" name="role" value="<?php echo $data['role']; ?>">
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <th>Address</th>

                    <td><input type="text" name="address" value="<?php echo $data['address']; ?>">
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><input type="text" name="number" value="<?php echo $data['number']; ?>">
                        <span class="error"></span>
                    </td>
                </tr>
                <th>Gender</th>
                <td><input type="radio" name="gender" value="female" <?php echo ($data['gender'] == "female") ? "checked" : ""; ?> <?php if (isset($gender) && $gender == "female") echo "checked='checked'"; ?>>Female
                    <input type="radio" name="gender" value="male" <?php echo ($data['gender'] == "male") ? "checked" : ""; ?> <?php if (isset($gender) && $gender == "male") echo "checked='checked'"; ?>>Male
                    <input type="radio" name="gender" value="other" <?php echo ($data['gender'] == "others") ? "checked" : ""; ?> <?php if (isset($gender) && $gender == "other") echo "checked='checked'"; ?>>Other
                    <span class="error"></span>

                </td>
                </tr>
                <tr>
                    <th>Experience</th>
                    <td><input type="number" name="exp" max="10" min="1" value="<?php echo $data['exp']; ?>">
                        <span class="error"></span>
                    </td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><img src="<?php echo $data['filename']; ?>" alt="<?php echo $data['filename']; ?>" id="blah"> 
                    <td><input type="file" name="image" id="img"></td>
                    <!-- <td><img id="blah" src="#"/></td> -->
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $data['id']; ?>"></td>
                <tr>
                    <td><button type="submit">Save Changes</button></td>
                    <td><a href="../index.php"><button type="button">Back</button></a></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <script>
        $(document).ready(function() {
            $("#img").change(function() {
                readURL(this);
            });

            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "Letters only please");

            $("#form").validate({
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
                    gender: {
                        required: true,
                    },
                    exp: {
                        required: true,
                        min: 1,
                        max: 10

                    }


                },
                errorPlacement: function(error, element) {
                    if (element.attr('type') == 'radio') {
                        error.appendTo(element.closest('td'));
                    } else {
                        error.insertAfter(element);
                    }
                },
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

</html>