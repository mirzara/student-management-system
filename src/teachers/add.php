<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
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
<form method='post' action="/teachers/save.php" id="save_form" enctype="multipart/form-data">
    <label>Basic Info</label>
<input class='form-control input-sm' name="name" placeholder="Teacher's Name" value=""><br/>
<input class='form-control input-sm' name="pname" placeholder="Parent's Name" value=""><br/>

<label>Contact Info</label>
  <input class='form-control input-sm' name="email" placeholder="E-mail ID" value=""/><br/>
  <input class='form-control input-sm' name="phone" type="tel" placeholder="Phone No" value=""><br/>
  <textarea name="addr" class='form-control' placeholder="Address"></textarea><br/>  
<label>Acadmic Info</label>
<input class='form-control input-sm' name="dob" placeholder="DOB (DD-MM-YYYY)"/><br/>
<input class='form-control input-sm' name="qual" placeholder="Qualification" /><br/>
<input class='form-control input-sm' name="alma" placeholder="Alma Matter" /><br/>
<input class='form-control input-sm' name="spzl" placeholder="Specialisation/Department" /><br/>
<input class='form-control input-sm' name="salry" placeholder="Monthly Salarly" ><br/>

    <label>Photo</label>
<input class="form-control" type="file" value="files" name="files" >
<br/>

<input type="submit" class="btn btn-primary btn-sm" value='Add Teacher' name="submit" style="width: 80%;"><br />
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
