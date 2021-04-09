<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
$index =  mysqli_escape_string($admin->conn,$_GET['index']);
$sql = "DELETE FROM `student` WHERE `Index`='$index'";
 $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} else if ($add === TRUE) {
            echo "<br/><h1>Record Deleted!</h1><br/>";
echo   "<a href='/'  class='btn btn-primary btn-sm'>Dashboard</a>";
}
?>