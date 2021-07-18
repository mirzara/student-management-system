<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index = mysqli_escape_string($admin->conn,$_GET['index']);
$sql = "Select * from `exam_def` where `Index`='$index'";
$res = $admin->conn->query($sql);
$exam = $res->fetch_assoc();
$class = $exam['class_code'];
$subject_raw = $exam['sub_code'];
$student_list = $exam['stu'];
$subject = explode(',',$subject_raw);
$no_subject = count($subject);
/*/
foreach ($subject as $name) {
  $subject_ = explode(':',$name);  
    echo $subject_[0];
}
/*/
?>

<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-edit2 menu__"></span> Add Result</h4>
<hr/>
<div class=" col-md-12 text-center" style='margin:auto;' id="form_div">
<form method='post' action="/result/save.php" id="save_form" enctype="multipart/form-data">
<h4>Enter <span class="tag">Data</span></h4><br />
   <table class="table table-striped table-condensed text-left">
    <thead>
      <tr>
        <th style="width: 150px;">Name</th>
<?php
foreach ($subject as $name) {
  $subject_ = explode(':',$name);  
    echo "<th>".$admin->sub_code($subject_[0])."</th>";
}
?>
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
foreach ($student_ as $student_name) {
$name = $admin->stu_name($student_name);
 $sub_value = NULL;
 $y = 1;
foreach ($subject as $name_)  {
$subject__ = explode(':',$name_); 
$key = $x.'mz'.$y; 
$max_value = $subject__[1];
$sub_value .= <<< EOD
<td>
<input class='form-control m_w' name='$key' type='number' max='$max_value' placeholder='marks' />
</td>
EOD;
$y++;
}
echo <<< EOD
<tr id='exam$index'><td><strong>$name</strong></td>$sub_value</tr>
EOD;
$x++;
}

    ?>
    </tbody>
    </table>
<input type="hidden" name="index" value="<?php echo $index; ?>" />
<input type="hidden" name="class" value="<?php echo $class ?>" />
<div class="col-md-6" style="margin:auto">
<select class="form-control" name="promote">
<option class="form-control" value="">Promote To Class?</option>
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
<option class="form-control" value="$code">$name ($code)</option>
EOD;
}
?>
</select></div><br />
<input type="submit" class="btn btn-primary btn-sm" value="Submit Result" />
</div>
<script>
setform('#save_form','#form_div');
function sheet(index) {
    url = '../result/sheet.php?index=' + index;
    getL(url);

}
</script>