  <html>
  <head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i"/>
  <link rel="stylesheet" href="/assets/web/assets/mobirise-icons/mobirise-icons.css"/>
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../lib/print.css"/>
  <script src="/assets/web/assets/jquery/jquery.min.js"></script>
  </head>
  <body onload="printContent('print')">
  <div id="print">
    <?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
if (isset($_GET['id'])) {
$id =  mysqli_escape_string($admin->conn,$_GET['id']);
} else {
    exit();
}
$sql = "select `handle`,`date` from `fee` where `Index`='$id' LIMIT 1";
$get = $admin->conn->query($sql);
if ($get->num_rows < 1) {
    exit();
}
$adm_ = $get->fetch_assoc();
$adm = $adm_['handle'];
$date = $adm_['date'];

$sql = "Select * from `student` where `adm`='$adm'";
$result = $admin->conn->query($sql);
$row = $result->fetch_assoc();
$bus = $row['bus'];
$class = $row['class'];
$bus_fee = $admin->fee($bus,'bus');
$acd_fee = $admin->fee($class,'class');
$total = $bus_fee + $acd_fee;
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
.pb-3 {
    padding: 25px;
    padding-left: 0px;
}
</style>
<div class="row">
<div class="col-md-3"><br/>
<img src="/images/school.png" class="img-responsive" style="width:170px;max-height:auto;display:block;">
</div>
<div class="col-md-9 text-center pb-3">
<h3 style="font-weight: 400;">Isalamia College of Science and Commerce</h3>
<h4 style="font-weight: 400;">Hawal Srinagar - 190002</h4>
<h5 style="font-weight: 400;">Phone: +91-1234567890</h5>
</div>
</div>

<h3 class="tag text-center" style="padding: 10px;">FEE RECIEPT</h3><br />
<h4>Student <span class="tag">Details</span></h4><br/><div class="row text-left">
<div class="col-md-4">
<span>Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['name']; ?></h6></div>
<div class="col-md-4">
<span>Parent Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['pname']; ?></h6></div>
<div class="col-md-4">
<span>Address:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['addr']; ?></h6></div></div>
<div class="row text-left">
<div class="col-md-4">
<span>Adm No:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['adm']; ?></h6></div>
<div class="col-md-4">
<span>Class:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $admin->class_n($row['class']); ?> Standard</h6></div>
<div class="col-md-4">
<span>Bus:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $admin->bus_n($row['bus']); ?></h6></div></div>
<br />
<table class="table table-condensed table-striped text-left">
<thead>
<th>Monthly Acadmic Fee</th>
<th>Monthly Bus Fee</th>
<th>Total Fee/Month</th>
<th>Last Paid Month</th>
</thead>
<tbody>
<tr><td>Rs <?php echo $acd_fee; ?> INR</td><td>Rs <?php echo $bus_fee; ?> INR</td><th><?php echo $total; ?></th><th><?php
$sql = "Select `fee_date` from `fee` where `handle`='$adm' ORDER BY `fee_date` DESC";
$last_fee = $admin->conn->query($sql);
if ($last_fee === TRUE) {
    echo 'Okay';
    exit();
}
$row_fee = $last_fee->fetch_assoc();
$last_fee_date = strtotime($row_fee['fee_date']);
echo date("j F Y", $last_fee_date);
?></th></tr>
</tbody>
</table>
<br />
<h4>Transaction <span class="tag">Details</span></h4><br />
<?php

$datenxt =strtotime($date);
$date1 = date('Y-m-d',$datenxt).' 00:00:00';
$datenxt = strtotime($date1) + (86400 * 1);
$date2 = date('Y-m-d',$datenxt).' 00:00:00';

$sql = "SELECT * from `fee` where `handle`='$adm' and `date` between '$date1' and '$date2' order by `Index` ASC";
$trn = $admin->conn->query($sql);
$grnd_total = NULL;
$tble_data = NULL;
while ($trn_ = $trn->fetch_assoc()) {
    $paid_total = $trn_['total'];
    $index = $trn_['Index'];
    $remarks = $trn_['remarks'];
    if ($remarks != 'LATE_FEE')
    {
    $month = date('d F y', strtotime($trn_['fee_date']));
    $tble_data .= "<tr><td>TRnS-$index</td><td>$month</td><td>$paid_total<td></tr>";
    $grnd_total = $grnd_total + $paid_total;
    } 
    else if ($remarks == 'LATE_FEE')
    {
    $month = date('d F y', strtotime($trn_['fee_date']));
    $tble_data .= "<tr><td>LATE-FEE</td><td>NULL</td><td>$paid_total<td></tr>";
    $grnd_total = $grnd_total + $paid_total;  
    }
}

echo <<< EOD
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Month</th>
<th>Paid</th>
</thead>
<tbody>
$tble_data
<tr><td><strong>Grand Total</strong></td><td></td><td><strong>$grnd_total</strong><td></tr>
</tbody></table>
EOD;
?>
<tt><b>Generated Using School.Net</b></tt>
</div>
  </body>
  <script>
  function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
    document.close();
	document.body.innerHTML = restorepage;
}
  </script>
  </html>