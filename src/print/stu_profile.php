  <html>
  <head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i"/>
  <link rel="stylesheet" href="/assets/web/assets/mobirise-icons/mobirise-icons.css"/>
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../lib/print.css"/>
  <script src="/assets/web/assets/jquery/jquery.min.js"></script>
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
  </head>
  <body onload="printContent('print')">
  <div id="print">

<div class="row">
<div class="col-md-3"><br/>
<img src="/images/school.png" class="img-responsive" style="width:170px;max-height:auto;display:block;">
</div>
<div class="col-md-9 text-center pb-3">
<h3 style="font-weight: 400;">Islamia College of Science and Commerce</h3>
<h4 style="font-weight: 400;">Hawal Srinagar  - 190002</h4>
<h5 style="font-weight: 400;">Phone: +91-1234567890</h5>
</div>
</div>
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
?><br />
<h3 class="text-left" style="font-weight: 400;">Student <span class="tag">Profile</span></h3>
<hr/>
<div class="row">
<div class="col-md-9 text-left">
<div class="row">
<div class="col-md-6">
<span>Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['name']; ?></h6>
<span>Parent Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['pname']; ?></h6>
<span>Phone:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['phone']; ?></h6>
<span>E-mail:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['email']; ?></h6>
<span>Address:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['addr']; ?></h6>
</div><div class="col-md-6">
<span>Adm No:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['adm']; ?></h6>
<span>Class:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['class']; ?> Standard</h6>
<span>Session:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['session']; ?></h6>
<span>Status:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $status_text; ?></h6>
<span>Bus:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $admin->bus_n($row['bus']); ?></h6>

</div>
</div>
</div>
<div class="col-md-3">
  <div style="width:145px;height:auto">
                <img src="../upload/<?php echo $row['photo']; ?>" class="img-responsive img-circle" style="display:block">
                </div><br />

</div>
</div>
<br />
<h3 class="text-left" style="font-weight: 400;">Exam <span class="tag">Record</span></h3>
<hr />
<?php
$id = $row['adm'];
$tbl = NULL;
$total_fee = NULL;
$sql = "Select * from `result` where `handle`='$id' ORDER BY `Index` DESC";
$exam = $admin->conn->query($sql);
while ($exam_ = $exam->fetch_assoc()) {
  $exam_code = $exam_['exam_code'];
  $exam_d = $admin->exam($exam_code);
  $name = $exam_d[0];
  $date = $exam_d[3];
  $marks_at = $exam_['total'];
  $max = $exam_d[4];
  $pass = $exam_d[5];
  $percnet = ($marks_at/$max) * 100 ;
 $tbl .= "<tr><td><strong>$name</strong></td><td>$date</td><td><strong>$marks_at</strong</td><td>$max</td><td>$pass</td></td><td>$percnet%</td></tr>";
}
echo <<< EOD
 <div class='text-center'>
<table class="table table-condensed table-striped text-center">
<thead>
<th>Exam</th>
<th>Date</th>
<th>Marks</th>
<th>Max Marks</th>
<th>Pass Marks</th>
<th>Percentage</th>
<total>
</thead>
<tbody>
$tbl
</tbody>
</table>
EOD;
$tbl = NULL;
?>
<br />
<h3 class="text-left" style="font-weight: 400;">Fee <span class="tag">Record</span></h3>
<hr />
<?php
$id = $row['adm'];
$tbl = NULL;
$total_fee = NULL;
$sql = "Select * from `fee` where `handle`='$id' ORDER BY `Index` DESC";
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
        $total_fee = $total + $total_fee;
 $tbl .= "<tr><td><strong>TRnS-$index</strong></td><td>$date</td><td><strong>$name</strong</td><td>Rs $class_fee INR</td><td>Rs $class_fee INR</td><td><strong>Rs $total INR</strong></td></tr>";
}
echo <<< EOD
 <div class='text-left'>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Paid Month</th>
<th>Name</th>
<th>Class Fee</th>
<th>Bus Fee</th>
<th>Total</th>
<total>
</thead>
<tbody>
$tbl
<tr><td><strong>G.Total</strong></td><td></td><td></td><td></td><td></td><td><strong>Rs $total_fee INR</strong></td></tr>
</tbody>
</table>
</div>
EOD;
?>
<br />
<h3 class="text-left" style="font-weight: 400;">Attendence <span class="tag">Record</span></h3>
<hr />
<?php
$id = $row['adm'];
$class = $row['class'];
$tbl = NULL;
$sql = "Select * from `att` where `class`='$class' and `attendence` LIKE '%$id%' ORDER BY `Index` DESC";
$att = $admin->conn->query($sql);
while ($att_ = $att->fetch_assoc()) {
    $attn_list = $att_['attendence'];
    $month = $att_['month'];
    $max_days = $att_['days'];
    $exp_att = explode(',',$attn_list);
    $key = array_search($id,$exp_att);
    $details = explode(':',$exp_att[$key]);
    $days = $details[1];
    $percent = ($days / $max_days) * 100;
    $tbl .= "<tr><td>$month</td><td>$days</td><td>$max_days</td><td>$percent</td></tr>";
    }
    
echo <<< EOD
 <div class='text-left'>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Month</th>
<th>Days</th>
<th>Max Days</th>
<th>Percentage</th>
</thead>
<tbody>
$tbl
</tbody>
</table>
</div>
EOD;
?>
</div>
</div>
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