<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index =  mysqli_escape_string($admin->conn,$_GET['index']);
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
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-growing-chart menu__"></span> View Attendence</h4>
<hr/>
<div class="container col-md-8 text-center" style='margin:auto;' id="form_div">
<h6>Class: <?php echo $admin->class_n($data['class']); ?> | Month: <?php echo $data['month']; ?></h6>
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
