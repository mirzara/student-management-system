<?php
require_once __DIR__.'/lib/school.php';
$admin = new Admin();
if (isset($_POST['username']) and isset($_POST['password'])) {
$username = mysqli_escape_string($admin->conn,$_POST['username']);
$password = md5($_POST['password']);
} else {
    $password = NULL;
    $username = NULL;
}
 if ($admin->authk($username,$password)) {
      header ('Location: /index.php');
 } else {
     $error = 1;
     require_once __DIR__.'\parts\head.php';
     include ('login.php');
     require_once __DIR__.'\parts\foot.php';
}
?>
