<?php
require_once __DIR__.'\..\lib\school.php';
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
$sql = "Select * from `student` where `Index`='$index'";
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
<form method='post' action="/student/update.php" id="save_form" enctype="multipart/form-data">
    <label>Basic Info</label>
<input type="hidden" name='index' value="<?php echo $row['Index']; ?>" />
<input class='form-control input-sm' name="name" placeholder="Student's Name" value="<?php echo $row['name']; ?>"><br/>
<input class='form-control input-sm' name="pname" placeholder="Parent's Name" value="<?php echo $row['pname']; ?>"><br/>
<input class='form-control input-sm' name="adm" placeholder="Admission No" value="<?php echo $row['adm']; ?>"><br/>

<label>Contact Info</label>
  <input class='form-control input-sm' name="email" placeholder="E-mail ID" value="<?php echo $row['email']; ?>"><br/>
  <input class='form-control input-sm' name="phone" type="tel" placeholder="Phone No" value="<?php echo $row['phone']; ?>"><br/>
  <textarea name="addr" class='form-control' placeholder="Address"><?php echo $row['addr']; ?></textarea><br/>  
<label>Acadmic Info</label>
<input class='form-control input-sm' name="dob" placeholder="DOB (DD-MM-YYYY)" value="<?php echo $row['dob']; ?>"><br/>
<select class="form-control" name="class" required>
<option class="form-control" value="">Select Class</option>
<?php
$sql = "Select * from `class_str`";
$class = $admin->conn->query($sql);
        if ($class === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
    }
while ($row = $class->fetch_assoc()) {
    $name = $row['class'];
    $code = $row['code'];
echo <<< EOD
<option class="form-control" value="$code">$name ($code)</option>
EOD;
}
?>
</select><br/>
<select class="form-control" name="bus" required>
<option class="form-control" value="">Select Bus Stop</option>
<?php
$sql = "Select * from `bus_str`";
$bus = $admin->conn->query($sql);
        if ($bus === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
    }
while ($row = $bus->fetch_assoc()) {
    $name = $row['stop'];
    $code = $row['code'];
echo <<< EOD
<option class="form-control" value="$code">$name ($code)</option>
EOD;
}
?>
<option class="form-control" value="NULL">No Bus Opted</option>
</select><br/>
<label>Photo</label>
<input class="form-control" type="file" name="files" value="<?php echo $row['photo']; ?>">
<br/>
<input type="submit" class="btn btn-primary btn-sm" value='Update Student' name="submit" style="width: 80%;"><br />
</form>
<a class="btn btn-primary white btn-sm" onclick="del(<?php echo $index ?>)">Delete</a>
</div>
<script>
setform('#save_form','#form_div');
function del(index) {
var r = confirm("Do you want to delete?");
if (r == true) {
var url = "../student/del.php?index=" + index;
$('#form_div').load(url);
}
}

</script>