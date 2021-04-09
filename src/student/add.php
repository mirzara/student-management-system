<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-file menu__"></span> Add Student</h4>
<hr/>
<div class="container col-md-8 text-center" style='margin:auto;' id="form_div">
<form method='post' action="/student/save.php" id="save_form" enctype="multipart/form-data">
    <label>Basic Info</label>
<input class='form-control input-sm' name="name" placeholder="Student's Name"><br/>
<input class='form-control input-sm' name="pname" placeholder="Parent's Name"><br/>
<input class='form-control input-sm' name="adm" placeholder="Admission No"><br/>

<label>Contact Info</label>
  <input class='form-control input-sm' name="email" placeholder="E-mail ID"><br/>
  <input class='form-control input-sm' name="phone" type="tel" placeholder="Phone No"><br/>
  <textarea name="addr" class='form-control' placeholder="Address"></textarea><br/>  
<label>Acadmic Info</label>
<input class='form-control input-sm' name="dob" placeholder="DOB (DD-MM-YYYY)"><br/>
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
<input class="form-control" type="file" name="files">
<br/>
<input type="submit" class="btn btn-primary btn-sm" value='Add Student' name="submit">
    
  <input type="hidden" id="x" name="x" />
  <input type="hidden" id="y" name="y" />
  <input type="hidden" id="w" name="w" />
  <input type="hidden" id="h" name="h" />
</form>
</div>
<script>
setform('#save_form','#form_div');
</script>