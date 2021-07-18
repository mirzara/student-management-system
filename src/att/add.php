<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-calendar menu__"></span> Add Attendance</h4>
<hr/>
<div class="container col-md-8 text-center" style='margin:auto;' id="form_div">
<form method='post' action="/att/next.php" id="save_form" enctype="multipart/form-data">
    <label>Define Month</label>
    <select class="form-control" name="month" required>
<option class="form-control" value="">Select Month</option>
<?php
$x=1;
while ($x<=12) {
 $date = date('F',strtotime("2017-$x-01"));
echo "<option class='form-control' value='$date'>$date</option>";
$x++;
}
?>
</select>
<br />
<input class="form-control" name="days" placeholder="Working Days" /><br />
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
<input type="submit" class="btn btn-primary btn-sm" value='Next' name="submit">
</form>
</div>
<script>
setform('#save_form','#form_div');
</script>
