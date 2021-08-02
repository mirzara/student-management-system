<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
if (isset($_POST['sub'])) {
 $min_date =  mysqli_escape_string($admin->conn,$_POST['date_min']); 
 $max_date =  mysqli_escape_string($admin->conn,$_POST['date_max']);
 $class =  mysqli_escape_string($admin->conn,$_POST['class']);
 $type = mysqli_escape_string($admin->conn,$_POST['rep_type']);
 $total = NULL;
 $tbl = NULL;
 $total_fee = NULL;
 if ($type == 1)
 {
 if ($class == 'all') {
    $sql = "SELECT * from `fee` where `date` BETWEEN '$min_date' and '$max_date' ORDER by `fee_date` DESC";
    } else {
   $sql = "SELECT * from `fee` where `handle` IN (select `adm` from `student` where `class`='$class') and`date` BETWEEN '$min_date' and '$max_date' ORDER by `fee_date` DESC";      
    }
    $fee = $admin->conn->query($sql);
    while ($fee_ = $fee->fetch_assoc()) {
        $adm = $fee_['handle'];
        $name = $admin->stu_name($adm);
        $bus = $fee_['bus_fee'];
        $class_fee = $fee_['class_fee'];
        $total = $fee_['total'];
        $index = $fee_['Index'];
        $date_str = strtotime($fee_['fee_date']);
        $date = date("F Y", $date_str); 
        $total_fee = $total_fee + $total ;
        $remarks = $fee_['remarks'];
   if ($remarks != 'LATE_FEE')
   {
 $tbl .= "<tr><td>TRnS-$index</td><td>$date</td><td>$name</td><td>Rs $class_fee INR</td><td>Rs $class_fee INR</td><td>RS $total INR</td></tr>";
    }
 else if ($remarks == 'LATE_FEE')
 {
    $tbl .= "<tr><td>LATE FEE</td><td>$date</td><td>$name</td><td>NULL</td><td>NULL</td><td>Rs $total INR</td></tr>";
 }
 }
 echo <<< EOD
 <div class='text-left'>
<label>Min Date: $min_date</label> | <label>Max Date: $max_date</label>
<br/>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Paid Month</th>
<th>Name</th>
<th>Clas Fee</th>
<th>Bus Fee</th>
<th>Total</th>
<total>
</thead>
<tbody>
$tbl
<tr><td><strong>Grand Total</strong></td><td></td><td></td><td></td><td></td><td>Rs $total_fee INR</td></tr>
</tbody>
</div>
EOD;
exit();
}
if ($type == 2) 
{
    if ($class == 'all') {
    $sql = "select `handle`, max(`fee_date`) as `fee_date`,max(`date`) as `date`,max(`Index`) as `Index` from `fee` GROUP By `handle`";  
    } else {
   $sql = "select `handle`, max(`fee_date`) as `fee_date`,max(`date`) as `date`,max(`Index`) as `Index` from `fee` where `handle` IN (select `adm` from `student` where `class`='$class')  GROUP By `handle`";      
    }
    $fee = $admin->conn->query($sql);
    while ($fee_ = $fee->fetch_assoc()) {
        $adm = $fee_['handle'];
        $name = $admin->stu_name($adm);
        $index = $fee_['Index'];
        $date_str = strtotime($fee_['fee_date']);
        $date_paid = date("F Y", $date_str);
          $date_str = strtotime($fee_['date']);
        $date = date("d F Y", $date_str);
$tbl .= "<tr><td>TRnS-$index</td><td>$name</td><td>$date_paid</td><td>$date</td></tr>";      
}
echo <<< EOD
 <div class='text-left'>
<label><strong>Last Transitions</strong></label>
<br/>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Name</th>
<th>Last Paid Month</th>
<th>Paid On</th>
</thead>
<tbody>
$tbl
</tbody></table>
</div>
EOD;

    exit();
}
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-edit menu__"></span> Fee Record</h4><hr />
<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/fee/fee_rqrd.php" id="save_form">
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
$sql = "Select * from `class_str`";
$class = $admin->conn->query($sql);
        if ($class === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
    }
while ($row = $class->fetch_assoc()) {
    $name = $row['class'];
    $code = $row['code'];
echo <<< EOD
<option value="$code">$name ($code)</option>
EOD;
}
?>
</select>
<br />
<input type="hidden" name="sub" />
<input type="submit" class="btn btn-primary btn-sm" value='View Record'>
    </form>
    </div></div>
<script>
setform('#save_form','#search_div');
</script>