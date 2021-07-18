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
   <h4>School.Net <span class="tag">Users</span></h4>
   <div class="text-right"><a class="btn btn-primary btn-sm whte" data-toggle="modal" data-target="#myModal" onclick="add()">Add</a></div>
   <table class="table table-striped text-left">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Last Seen</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `login`";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}
while ($row = $get->fetch_assoc()) {
    $index = $row['Index'];
    $name = $row['username'];
    $date = $row['date'];
    $type = $row['type'];
echo <<< EOD
<tr id='user$index'><td><strong>$name</strong></td><td>$date</td><td>$type</td><td><a class='bl' onclick="del($index,'user')">Delete</a></td></tr>

EOD;
}
    ?>
    </tbody>
    </table>
    
    </div></div>
   </div></div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">System</h4>
      </div>
      <div class="modal-body" id="model_body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm m" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
<script>
function add() {
     $('#model_body').load('../setting/add_user.php'); 
}
function del(index,type) {
    var r = confirm("Do you want to delete?");
if (r == true) {
    var url = '../setting/del.php?type='+ type + '&index=' + index;
    $('#'+ type  + index).load(url);
}
}
$('.m').onclick(function() {
    $('.modal-backdrop', '.fade show').toggleClass('modal-backdrop');
    getL('../setting/add_class.php');
})
setform('#save_form','#search_div');
</script>
