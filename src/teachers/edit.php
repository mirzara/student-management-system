<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
if (!isset($_GET['index']) or $_GET['index'] == '') {
echo "<h4>Invalid Index!<h4>";
    exit();    
}
$index = mysqli_escape_string($admin->conn,$_GET['index']);
$sql = "Select * from `teacher` where `Index`='$index'";
$result = $admin->conn->query($sql);
        if ($result === FALSE) {
         echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} 
if ($result->num_rows < 1) {
echo "Error: Broken record for index $index";
exit();
}
$row = $result->fetch_assoc();
$status = $row['status'];
if ($status == 0) {
    $status_text = 'Active';
}
if ($status == 2) {
    $status_text = 'DC issued!';
}
?>
<style>
.img-responsive {
    width: 100%;
    height: auto;
    margin: auto;
}
.display-Cm {
    font-family: 'Rubik', sans-serif;
    font-size: 17px !important;
    font-weight: 400;
    letter-spacing: 1.5px;
    padding: 1px;
    color: #1456cc;
}
.white {
    color: #fff !important;
}
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-setting3 menu__"></span> Update Student</h4>
<hr/>
<div class="container col-md-8 text-center" style='margin:auto;' id="form_div">

  <div style="width:145px;height:auto;margin:auto">
                <img src="../upload/student.png" class="img-responsive img-circle" style="display:block">
                </div>
<br />
<form method='post' action="/teachers/update.php" id="save_form" enctype="multipart/form-data">
    <label>Basic Info</label>
<input class='form-control input-sm' name="name" placeholder="Teacher's Name" value="<?php echo $row['name'];?>"><br/>
<input class='form-control input-sm' name="pname" placeholder="Parent's Name" value="<?php echo $row['pname'];?>"><br/>

<label>Contact Info</label>
  <input class='form-control input-sm' name="email" placeholder="E-mail ID" value="<?php echo $row['email'];?>"><br/>
  <input class='form-control input-sm' name="phone" type="tel" placeholder="Phone No" value="<?php echo $row['phone'];?>"><br/>
  <textarea name="addr" class='form-control' placeholder="Address"><?php echo $row['addr'];?></textarea><br/>  
<label>Acadmic Info</label>
<input class='form-control input-sm' name="dob" placeholder="DOB (DD-MM-YYYY)" value="<?php echo $row['dob'];?>"><br/>
<input class='form-control input-sm' name="qual" placeholder="Qualification" value="<?php echo $row['qual'];?>"><br/>
<input class='form-control input-sm' name="alma" placeholder="Alma Matter" value="<?php echo $row['alma'];?>"><br/>
<input class='form-control input-sm' name="spzl" placeholder="Specialisation/Department" value="<?php echo $row['spzl'];?>"><br/>
<input class='form-control input-sm' name="salry" placeholder="Monthly Salarly" value="<?php echo $row['salary'];?>"><br/>

    <label>Photo</label>
<input class="form-control" type="file" value="files" name="files" value="<?php echo $row['photo'];?>">
<br/>
<input type='hidden' name="index" value="<?php echo $row['Index'];?>"/>
<input type="submit" class="btn btn-primary btn-sm" value='Update Teacher' name="submit" style="width: 80%;"><br />
</form>
<a class="btn btn-primary white btn-sm" onclick="del(<?php echo $index ?>)">Delete</a>
</div>
<script>
setform('#save_form','#form_div');
function del(index) {
var r = confirm("Do you want to delete?");
if (r == true) {
var url = "../teachers/del.php?index=" + index;
$('#form_div').load(url);
}
}

</script>
