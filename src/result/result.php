<?php
require_once __DIR__.'/../lib/school.php';
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
$sql = "SELECT * from `result` where `Index`='$index'";
$result_ = $admin->conn->query($sql);
        if ($result_ === FALSE) {
         echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} 
if ($result_->num_rows < 1) {
echo "Error: Broken record for index $index";
exit();
}
$result = $result_->fetch_assoc();
$adm = $result['handle'];

$sql = "Select * from `student` where `adm`='$adm'";
$student_ = $admin->conn->query($sql);
        if ($student_ === FALSE) {
         echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
if ($student_->num_rows < 1) {
echo "Error: Broken record for index $index";
exit();
}
$student = $student_->fetch_assoc();

$exam_code = $result['exam_code'];
$exam = $admin->exam($exam_code);

$status = $student['status'];
if ($status == 0) {
    $status_text = 'Active';
}
if ($status == 2) {
    $status_text = 'DC issued!';
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
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-search menu__"></span> Result</h4>
<hr/>
<div class="row">
<div class="col-md-9 text-left">
<div class="row">
<div class="col-md-6">
<span>Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $student['name']; ?></h6>
<span>Parent Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $student['pname']; ?></h6>
<span>Address:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $student['addr']; ?></h6>
<span>Exam Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $exam[0]; ?></h6>
</div><div class="col-md-6">
<span>Adm No:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $student['adm']; ?></h6>
<span>Class:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $admin->class_n($exam[1]); ?> Standard</h6>
<span>Exam Date:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo date('d F Y' , strtotime($exam[3])); ?></h6>
<span>Exam Code:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $result['exam_code']; ?></h6>
</div>
</div>
</div>
<div class="col-md-3">
  <div style="width:145px;height:auto">
                <img src="../upload/<?php echo $student['photo']; ?>" class="img-responsive img-circle" style="display:block">
  <a href="/print/result.php?index=<?php echo $index ?>" target="_blank"><button class="btn btn-primary btn-sm">Print</button></a>
                </div>
</div>
</div><br />
<h3 class="text-left" style="font-weight: 400;">Result <span class="tag">Sheet</span></h3>
<hr />
<?php
$marks_sheet = $result['result'];
$marks_sub = explode(',',$marks_sheet);
$tbl = NULL;
foreach ($marks_sub as $marks_) {
    $marks = explode(':',$marks_);
    $sub_name = $admin->sub_code($marks[0]);
    $markss_ = $marks[2];
    $max = $marks[1];
    $percent = ($markss_ / $max ) * 100;
     if ($percent <= 19.99) {
        $overall = '<strong style="color:red">E2</strong>';
    }  else if ($percent > 19.99 && $percent < 29.99) {
        $overall = '<strong style="color:red">E1</strong>';
    } else if ($percent > 29.99 && $percent < 39.99) {
          $overall = '<strong style="color:blue">D</strong>';
     } else if ($percent > 39.99 && $percent < 49.99) {
          $overall = '<strong style="color:blue">C2</strong>';
     } else if ($percent > 49.99 && $percent < 59.99) {
          $overall = '<strong style="color:blue">C1</strong>';
     } else if ($percent > 59.99 && $percent < 69.99) {
          $overall = '<strong style="color:blue">B1</strong>';
     } else if ($percent > 69.99 && $percent < 79.99) {
          $overall = '<strong style="color:blue">B2</strong>';
     } else if ($percent > 79.99 && $percent < 89.99) {
          $overall = '<strong style="color:blue">A2</strong>';
     } else if ($percent > 89.99 && $percent <= 100) {
          $overall = '<strong style="color:blue">A1</strong>';
     }
    $tbl .= "<tr><td>$sub_name</td><td>$markss_</td><td>$max</td><td>$percent%</td><td>$overall</td></tr>";
}
    $max_marks = $exam[4];
    $total = $result['total'];
    $overall_pr = ($total / $max_marks) * 100;
$p_class = $admin->class_n($result['p_class']);
if ($p_class != NULL) {
 $status = $result['status'];
    $txt = '<strong style="color:green">Promoted</strong>';
$txt_ = <<< EOD
<div class='p-3' align='center'>
<h5>The candidate was $txt  to class $p_class.</h5>
</div>
EOD;
} else {
    $txt_ = NULL;
}
echo <<< EOD
 <div class='text-left'>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Subject Name</th>
<th>Marks</th>
<th>Max Marks</th>
<th>%age</th>
<th>Overall</th>
</thead>
<tbody>
$tbl
<tr><td><strong>G.Total</strong></td><td>$total</td><td>$max_marks</td><td>$overall_pr%</td><td></td></tr>
</tbody>
</table><br/>
$txt_
</div>
EOD;
?>
