<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-save menu__"></span> Result Report</h4>
<hr/>
<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/print/result2.php" id="save_form" target="_blank">
    <label>Search Database</label>
    <input class="form-control" name="sub" placeholder="Subject" /><br />
    <select class="form-control" name="index" required>
<option class="form-control" value="">Select Result</option>
<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
$sql = "Select * from `exam_def` where `status`='1'";
$class = $admin->conn->query($sql);
        if ($class === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
    }
while ($row = $class->fetch_assoc()) {
   $name = $row['name'];
   $date  = $row['date'];
   $index = $row['Index'];
echo <<< EOD
<option class="form-control" value="$index">$name $date</option>
EOD;
}
?>
 </select>   <br />
<input type="submit" class="btn btn-primary btn-sm" value='Print/Download'>
    </form>
    </div></div>
