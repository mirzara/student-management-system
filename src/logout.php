<?php
require_once __DIR__."/lib/school.php";
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$value=$_COOKIE[$cookie_name];
$ran = md5(mt_rand());
$ID = $admin->user;
$qry = "UPDATE `login` SET `status`='1' WHERE `username`='$ID' and `auth`='$value'";
$result = $admin->conn->query($qry);
setcookie ("zara","0",time()-3600*24,'/');
header("Location: index.php");
	  mysqli_close($conn);
                   exit;
?>
