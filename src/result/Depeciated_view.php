
______________________
<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index = $_GET['index'];
$sql = "Select * from `exam_def` where `Index`='$index'";
$res = $admin->conn->query($sql);
$exam = $res->fetch_assoc();
$exam_code = $exam['exam_code'];
$class = $exam['class_code'];
$subject_raw = $exam['sub_code'];
$max_marks = $exam['max_marks'];
/*/
foreach ($subject as $name) {
  $subject_ = explode(':',$name);  
    echo $subject_[0];
}
/*/
?>

<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-edit2 menu__"></span> Published Result</h4>
<hr/>
<div class=" col-md-12 text-center" style='margin:auto;' id="form_div">
<form method='post' action="/result/save.php" id="save_form" enctype="multipart/form-data">
<h5 >Select <span class="tag">Exam</span></h5><br />
   <table class="table table-striped table-condensed text-center">
    <thead>
      <tr class="text-center text-captilized">
        <th style="width: 150px;">Name</th>
        <th>Subjects</th>
        <th>T.Marks</th>
        <th>Percentage</th>
      </tr>
    </thead>
    <tbody>
    <?php
$sql = "Select * from `student` where `class`='$class' ORDER BY `Index` ASC";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}

 $x = 1;

while ($row = $get->fetch_assoc()) {
$name = $row['name'];
$adm = $row['adm'];
$sub_value = null;
$stu_result = "select * from `result` where `handle`='$adm'";
$stu_result_ = $admin->conn->query($stu_result);
$result_data = $stu_result_->fetch_assoc();
$result__ = $result_data['result'];
$result_explode = explode(',',$result__);
if ($result_explode[0] != ''){
foreach ($result_explode as $result_zara) {
    $zara_result = explode(':',$result_zara);
$subname = $admin->sub_code($zara_result[0]);
$key = $zara_result[2];
$sub_value .= <<< EOD
$subname => <strong>$key</strong> <br/>
EOD;
}
$total_marks = $result_data['total'];

$percent = ($total_marks / $max_marks) * 100 .'%';
} else {
$sub_value = "<strong>Data Not found</strong>";
$total_marks =  NULL;    
$percent = NULL;
}
echo <<< EOD
<tr id='exam$index'><td>$name</td><td>$sub_value</td><td>$total_marks</td><td>$percent</td></tr>

EOD;
$x++;
}

    ?>
    </tbody>
    </table>
<input type="hidden" name="index" value="<?php echo $index; ?>" />
<input type="hidden" name="class" value="<?php echo $class ?>" />
</div>
<script>
setform('#save_form','#form_div');
function sheet(index) {
    url = '../result/sheet.php?index=' + index;
    getL(url);

}
</script>
