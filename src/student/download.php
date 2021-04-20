<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-save menu__"></span> Student Report</h4>
<hr/>
<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/print/students.php" id="save_form" target="_blank">
    <label>Search Database</label>
    <input class="form-control" name="sub" placeholder="Subject" /><br />
   
    <select class="form-control" name="class" required>
<option class="form-control" value="">Select Class</option>
<option class="form-control" value="NULL">All Classes</option>
<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
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
 </select>   <br />

<select class="form-control" name="bus">
<option class="form-control" value="Null">Select Bus Stop (Optional)</option>
<option class="form-control" value="No">No Bus Opted</option>
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

</select><br />
<select class="form-control" name="session" required>
<option class="form-control" value="Null">Select Session</option>
<?php
$sql = "select DISTINCT `session` from `student`";
$bus = $admin->conn->query($sql);
        if ($bus === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
    }
while ($row = $bus->fetch_assoc()) {
    $name = $row['session'];
    $old = $name -1;
    $code = $row['session'];
echo <<< EOD
<option class="form-control" value="$code">$old - $name</option>
EOD;
}
?>

</select><br />
<textarea class="form-control" rows="5" placeholder="Data To Print eg: name,admission,dob" name="data"></textarea>
<input type="submit" class="btn btn-primary btn-sm" value='Search'>
    </form>
    </div></div>
