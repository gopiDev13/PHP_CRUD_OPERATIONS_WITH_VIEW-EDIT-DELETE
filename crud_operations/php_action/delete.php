<?php

require_once('db_connection.php');
// print_r($_GET); 
if($_POST) {
	$id = $_POST['id'];
    // echo print_r('id');exit();
    $sql = "delete from emp_details where id={$id}";
    if ($connect->query($sql) === TRUE) {
        // 
        echo "successfully deleted"."</br>".
        "<a href='main.php'><button type='button'>Back</button></a>";
    } else {
        echo "Error deleting record : " . $connect->error;
    }

    $connect->close();

    

}
?>