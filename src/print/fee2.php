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

 $min_date = mysqli_escape_string($admin->conn,$_POST['date_min']); 
 $max_date = mysqli_escape_string($admin->conn,$_POST['date_max']);
 $class = mysqli_escape_string($admin->conn,$_POST['class']);
 $type = mysqli_escape_string($admin->conn,$_POST['rep_type']);
 $total = NULL;
 $tbl = NULL;
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
        $index = $fee_['Index'];
        $total = $fee_['total'];
        $remarks = $fee_['remarks'];
    if ($remarks != 'LATE_FEE')
    {
        $bus = $fee_['bus_fee'];
        $class_fee = $fee_['class_fee'];
   
    
        $date_str = strtotime($fee_['fee_date']);
        $date = date("F Y", $date_str); 
        $total_fee =+ $total ;
 $tbl .= "<tr><td>TRnS-$index</td><td>$name</td><td>$date</td><td>$class_fee</td><td>$class_fee</td><td>$total</td></tr>";
    }
   else if ($remarks == 'LATE_FEE')
   {
  $tbl .= "<tr><td>LATE-FEE</td><td>$name</td><td>$date</td><td>NULL</td><td>NULL</td><td>$total</td></tr>";
   } 
    
    }
}
else if ($type == 2) 
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
<h3 style="font-weight: 400;">APEX HIGHER SECONDARY SCHOOL</h3>
<h4 style="font-weight: 400;">Sogam Lolab - 193223</h4>
<h5 style="font-weight: 400;">Phone: +91-9797085377</h5>
</div>
</div>
<br/>
<h5 class="text-center">Subject: <?php echo $_POST['sub'];?></h5>
<?php
if ($type == 1)
{
 echo <<< EOD
 <div class='text-left'>
<label>Min Date: $min_date</label> | <label>Max Date: $max_date</label>
<br/>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Name</th>
<th>Paid Month</th>
<th>Clas Fee</th>
<th>Bus Fee</th>
<th>Total</th>
</thead>
<tbody>
$tbl
</tbody></table>
</div>
EOD;
}
else if ($type == 2)
{
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
    
}
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