<?php
require_once('db_connection.php');
?>
<html>

<head>
    <title>Main Page</title>

    <style type="text/css">
        .manageMember {
            width: 50%;
            margin: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="manageMember">
        <a href="../index.php"><button type="button">Add Employees</button></a>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>Name</th>

                    <th>Role</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Experience</th>
                    <th>Edit/Delete</th>
            </thead>
            <tbody>
                <?php
                $sql = "select * from emp_details where status=1";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $row['fname'] . " " . $row['lname'] . "</td>
                    <td>" . $row['role'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['number'] . "</td>
                    <td>" . $row['exp'] . "</td>
                    <td>
                            <a href='view.php?id=" . $row['id'] . "'><button type='button'>View</button></a>
							<a href='edit.php?id=" . $row['id'] . "'><button type='button'>Edit</button></a>
							<a href='deletecon.php?id=" . $row['id'] . "'><button type='button'>Remove</button></a>
						</td>
					</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>