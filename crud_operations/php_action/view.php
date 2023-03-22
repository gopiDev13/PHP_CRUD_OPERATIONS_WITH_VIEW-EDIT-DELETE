<html>
<title>Edit</title>
<style type="text/css">
    .table {

border: 12px double black;


cursor: pointer;


}

table.center {

border-radius: 12px;
margin-left: auto;
margin-right: auto;
border: 2px solid black;
height: 50%;
width: 35%;
cursor: pointer;


}

</style>
<body>
<?php
require_once('db_connection.php');
if ($_GET['id']) {
    $id = $_GET['id'];
  
$sql = "SELECT * FROM emp_details WHERE id = {$id}";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
}
}

     ?>
  
        
            <h3>view Employee Details</h3>
           <table class="center">
            <tr>
             <th>Name</th>
                   <td><p><?php echo $row['fname']." ".$row['lname']; ?></p></td>
            </tr>
            <tr>
                <th>Mail</th>
                <td><p><?php echo $row['mail']; ?></p></td>
            </tr>

                <tr>
                    <th>Role</th>
                    <td><p><?php echo $row['role'];?></p>
                        
                    </td>
                </tr>
                <tr>
                    <th>Address</th>

                    <td><p><?php echo $row['address']; ?></p>
                        
                    </td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><p><?php echo $row['number']; ?></p>
                        
                    </td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><p><?php echo $row['gender']; ?></p></td>
                </tr>
                <tr>
                    <th>Experience</th>
                    <td><p><?php echo $row['exp']; ?></p>
                        
                    </td>
                </tr>
                <tr>
                    <th>File Name</th>
                    <td><p><?php echo $row['filename']; ?></p></td>
                </tr>
                <tr>
                    <th>File</th>
                    <td><img src="<?php echo $row['filename']; ?>" alt="<?php echo $row['filename']; ?>"></img></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><a href="main.php"><button type="button">Back</button></a></td>
                </tr>
            </table> 
        

</body>
</html>







 
