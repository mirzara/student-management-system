<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$name = mysqli_escape_string($admin->conn,$_POST['name']);
$pname = mysqli_escape_string($admin->conn,$_POST['pname']);
$email = mysqli_escape_string($admin->conn,$_POST['email']);
$phone = mysqli_escape_string($admin->conn,$_POST['phone']);
$addr = mysqli_escape_string($admin->conn,$_POST['addr']);
$dob = mysqli_escape_string($admin->conn,$_POST['dob']);
$qual = mysqli_escape_string($admin->conn,$_POST['qual']);
$spzl = mysqli_escape_string($admin->conn,$_POST['spzl']);
$alma = mysqli_escape_string($admin->conn,$_POST['alma']);
$salry = mysqli_escape_string($admin->conn,$_POST['salry']);
    $rand =  rand();
    if($_FILES["files"]["name"] != ''){
	 $fileN = $rand.$_FILES["files"]["name"];
     $fileformat = $_FILES["files"]["type"];
        $target_dir = "../upload/";
        $target_file = $target_dir . basename($fileN);
        move_uploaded_file($_FILES["files"]["tmp_name"], $target_file);
} else {
	$fileN = 'student.png';
}
$sql = "INSERT INTO `teacher`(`Index`, `name`, `pname`, `addr`, `phone`, `email`, `dob`, `qual`, `alma`, `spzl`, `salary`, `photo`, `join`, `status`) VALUES (NULL,'$name','$pname','$addr','$phone','$email','$dob','$qual','$alma','$spzl','$salry','$fileN',NOW(),'0')";
    $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} else if ($add === TRUE) {
            echo "<h1>Record added!</h1><br/>";
echo   "<a href='#' onclick='add()' class='btn btn-primary btn-sm'>Add New Record</a>  <a href='/'  class='btn btn-primary btn-sm'>Dashboard</a>";
}
?>
<script>
function add() {
    getL('../teachers/add.php');
}
</script>
