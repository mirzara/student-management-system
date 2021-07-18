<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
if (isset($_POST['pwd'])) {
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['New_password']);
    $con_password = md5($_POST['con_password']);
if   ($admin->authk($admin->user,$old_password)) {
    $user = $admin->user;
    if ($new_password == $con_password) {
    $sql = "UPDATE `login` SET `password`='$con_password'";
    $chnge = $admin->conn->query($sql);
    $txt = "<h4 class='tag'>Password Changed</h4>";
} else {
     $txt = "<h4 class='tag'>Invalid Password</h4>";
}
} else {
     $txt = "<h4 class='tag'>Failed to confirm your ideantity.</h4>";
}
} else {
    $txt = null;
}
?>
<style>
h4 {
    font-weight: 400;
}
.whte {
    color: #fff !important;
    font-weight: 400;
}
.bl {
    color: #149dcc !important;
}
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-setting menu__"></span> System Setting</h4>
<hr/>
<div id="search_div">
<div class="container col-md-12 text-center" style='margin:auto;'>
   <h4 id="classs">Change <span class="tag">Password</span></h4>
   <br /><?php echo $txt ?>
       <form method='post' action="/setting/password.php" id="save_form">
   <input class="form-control" type="password" name="old_password" placeholder="Old Password" required /><br />
   <input class="form-control" type="password" name="New_password" placeholder="New Password" required /><br />
   <input class="form-control" type="password" name="con_password" placeholder="Confirm Password" required /><br />
   <input type="hidden" name="pwd" />
   <input class="btn btn-primary  btn-sm" type="submit" value="Change Password" /></form>
   </div></div>
   <script>
setform('#save_form','#main');
</script>
