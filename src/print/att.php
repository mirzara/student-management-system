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
<h3 style="font-weight: 400;">Isalamia College of Science and Commerce</h3>
<h4 style="font-weight: 400;">Hawal Srinagar- 190002</h4>
<h5 style="font-weight: 400;">Phone: +91-1234567890</h5>
</div>
</div>

<h3 class="tag text-center" style="padding: 10px;">ATTENDANCE</h3><br />
<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index =  mysqli_escape_string($admin->conn,$_POST['index']);
$sql = "SELECT * from `att` where `Index`='$index'";
$data_ = $admin->conn->query($sql);
$data = $data_->fetch_assoc();
$attn_list = $data['attendence'];
$max_days = $data['days'];
$att = explode(',',$attn_list);
$tbl = NULL;
foreach ($att as $stu_) {
$att_data = explode(':',$stu_);
$name = $admin->stu_name($att_data[0]);
$day = $att_data[1];
$percent = ($day / $max_days) * 100;
$tbl .= "<tr><td>$name</td><td>$day</td><td>$max_days</td><td>$percent%</td></tr>";
}
?>
<style>th{text-align: center;}</style>
<div class="container col-md-12 text-center" style='margin:auto;' id="form_div">
<h6>Class: <?php echo $admin->class_n($data['class']); ?> | Month: <?php echo $data['month']; ?></h6><br />
<div align='center' class="text-center">
<table class="table table-striped text-center">
    <thead>
      <tr class="text-center text-capitalize">
        <th>Name</th>
        <th>Days</th>
        <th>Max Days</th>
        <th>Percentage</th>
      </thead>
      <tbody>
      <?php echo $tbl ?>
      </tbody>
      </table></div></div>
</div>
</div><br />
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