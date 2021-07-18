<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index = mysqli_escape_string($admin->conn,$_GET['index']);
$sql = "Select * from `exam_def` where `Index`='$index'";
$res = $admin->conn->query($sql);
$exam = $res->fetch_assoc();
$exam_code = $exam['exam_code'];
$class = $exam['class_code'];
$subject_raw = $exam['sub_code'];
$student_list = $exam['stu'];
$max = $exam['max_marks'];
$subject = explode(',',$subject_raw);
$no_subject = count($subject);
/*/
foreach ($subject as $name) {
  $subject_ = explode(':',$name);  
    echo $subject_[0];
}
/*/
?>
<style>

.display-Cm {
    font-family: 'Rubik', sans-serif;
    font-size: 17px !important;
    font-weight: 400;
    letter-spacing: 1.5px;
    padding: 1px;
    color: #1456cc;
}
th {
        text-align: center !important;
}
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-edit2 menu__"></span> Published Result</h4>
<hr/>
<div class=" col-md-12 text-center" style='margin:auto;' id="form_div">
<div class="row text-left margin-auto">
<div class="col-md-6">
<span>Exam Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $exam['name']; ?></h6>
<span>Class:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $admin->class_n($exam['class_code']); ?></h6>
<span>Max Marks:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $exam['max_marks']; ?></h6>
</div><div class="col-md-6">
<span>Exam Code:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $exam['exam_code']; ?></h6>
<span>Date:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $exam['date']; ?></h6>
<span>Pass Marks:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $exam['pass_marks']; ?></h6>
</div>
</div>

<br />   
<div align='center' class="text-center">
<table class="table table-striped text-center">
    <thead>
      <tr class="text-center text-capitalize">
        <th style="width: 150px;">Name</th>
<?php
foreach ($subject as $name) {
  $subject_ = explode(':',$name);  
    echo "<th>".$admin->sub_code($subject_[0])."</th>";
}
?>
<th>Total</th>
<th>Percentage</th>
      </tr>
    </thead>
    <tbody>
    <?php
    /*
$sql = "Select * from `student` where `class`='$class' ORDER BY `Index` ASC";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}*/
$student_ = explode(',',$student_list);

 $x = 1;
foreach ($student_ as $adm) {
$name = $admin->stu_name($adm);
$sub_value = null;
$stu_result = "select * from `result` where `handle`='$adm' and `exam_code`='$exam_code'";
$stu_result_ = $admin->conn->query($stu_result);
$result_data = $stu_result_->fetch_assoc();
$result__ = $result_data['result'];
$result_explode = explode(',',$result__);
if ($result_explode[0] != ''){
foreach ($result_explode as $result_zara) {
    $zara_result = explode(':',$result_zara);
$key = $zara_result[2];
$sub_value .= <<< EOD
<td>
$key
</td>
EOD;
}
$total = $result_data['total'];
$percent = '<td>'.($total / $max) * 100 . '%</td>';


echo <<< EOD
<tr id='exam$index'><td>$name</td>$sub_value<td>$total</td>$percent</tr>

EOD;
$x++;
}

}
    ?>
    </tbody>
    </table>
</div>
</div>
<script>
setform('#save_form','#form_div');
function sheet(index) {
    url = '../result/sheet.php?index=' + index;
    getL(url);

}
</script>
