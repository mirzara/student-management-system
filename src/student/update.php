<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
$index =  mysqli_escape_string($admin->conn,$_POST['index']);
$name =  mysqli_escape_string($admin->conn,$_POST['name']);
$pname =  mysqli_escape_string($admin->conn,$_POST['pname']);
$adm =  mysqli_escape_string($admin->conn,$_POST['adm']);
$email =  mysqli_escape_string($admin->conn,$_POST['email']);
$phone =  mysqli_escape_string($admin->conn,$_POST['phone']);
$addr =  mysqli_escape_string($admin->conn,$_POST['addr']);
$dob =  mysqli_escape_string($admin->conn,$_POST['dob']);
$class =  mysqli_escape_string($admin->conn,$_POST['class']);
$bus =  mysqli_escape_string($admin->conn,$_POST['bus']);
    $rand =  rand();
    if($_FILES["files"]["name"] != ''){
	 $fileN = $rand.$_FILES["files"]["name"];
     $fileformat = $_FILES["files"]["type"];
        $target_dir = "../upload/";
        $target_file = $target_dir . basename($fileN);
        move_uploaded_file($_FILES["files"]["tmp_name"], $target_file);
} else {
    $qry = "select `photo` from `student` where `Index`='$index'";
    $result = $admin->conn->query($qry);
    $row = $result->fetch_assoc();
	$fileN = $row['photo'];
}
$sql = "UPDATE `student` SET `name`='$name',`pname`='$pname',`adm`='$adm',`email`='$email',`phone`='$phone',`addr`='$addr',`dob`='$dob',`class`='$class',`bus`='$bus',`photo`='$fileN' WHERE `Index`='$index'";
    $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} else if ($add === TRUE) {
            echo "<h1>Record Updated!</h1><br/>";
echo   "<a href='#' onclick='view($index)' class='btn btn-primary btn-sm'>View Profile</a>  <a href='/'  class='btn btn-primary btn-sm'>Dashboard</a>";
}
?>
<script>
function view(index) {
    url = '../student/profile.php?index=' + index;
    getL(url);
}
</script>
