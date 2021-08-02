<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-save menu__"></span> Fee Report</h4>
<hr/>
<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/print/fee2.php" id="save_form" target="_blank">
    <label>Search Database</label>
    <input class="form-control" name="sub" placeholder="Subject" /><br />
     <select class="form-control" name="rep_type">
    <option value="">Select Report Type</option>
    <option class="form-control" value="1">All Transitions (Based Date)</option>
     <option class="form-control" value="2">Last Transitions(Fee List)</option>
    </select><br />
    <label class="form-label">Min Date</label>
<input type='date' name="date_min" class="form-control"/><br />
    <label class="form-label">Max Date</label>
<input type='date' name="date_max" class="form-control"/><br />
 <label class="form-label">Class</label>
<select class="form-control" name="class">
<option value="">Select Class</option>
<option  value="all">All Classes</option>
<?php

require_once __dir__ . '\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1)
{
				echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
				exit();
}
$sql = "Select * from `class_str`";
$class = $admin->conn->query($sql);
if ($class === false)
{
				echo "Error: " . $sql . "<br>" . $admin->conn->error;
}
while ($row = $class->fetch_assoc())
{
				$name = $row['class'];
				$code = $row['code'];
				echo <<< EOD
<option value="$code">$name ($code)</option>
EOD;
}

?>
</select>
<br />
      <br />
<input type="submit" class="btn btn-primary btn-sm" value='Print/Download'>
    </form>
    </div></div>
