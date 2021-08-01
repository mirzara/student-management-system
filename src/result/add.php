<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-edit2 menu__"></span> Add Result</h4>
<hr/>
<div class=" col-md-12 text-center" style='margin:auto;' id="form_div">
<form method='post' action="/student/save.php" id="save_form" enctype="multipart/form-data">
<h5 >Select <span class="tag">Exam</span></h5><br />
   <table class="table table-striped table-condensed text-left">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Subject & Marks</th>
        <th>Class</th>
        <th>Max Marks</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `exam_def` where `status`='0'";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}

while ($row = $get->fetch_assoc()) {
     $sub_value = NULL;
    $index = $row['Index'];
    $exam_code = $row['exam_code'];
    $class_code = $row['class_code'];
    $sub_code = $row['sub_code'];
    $max_marks = $row['max_marks'];
    $name = $row['name'];
    $date = $row['date'];
    $subject__ = explode(",", $sub_code);
    $x = 0;
    foreach ($subject__ as $key => $sub_code) {
     $sub_code_real = explode(":",$sub_code);
     $sub_value .= $admin->sub_code($sub_code_real[0]). " = ".$sub_code_real[1]."<br/> ";
     unset($subject__[$key]);
     $x++;
    }
echo <<< EOD
<tr id='exam$index'><td><a href='#' onclick='sheet($index)'><strong>$name</strong></a></td><td>$date</td><td>$sub_value</td><td>$class_code</td><td>$max_marks</td></tr>
EOD;

}

    ?>
    </tbody>
    </table>

</div>
<script>
setform('#save_form','#form_div'); /* form-div , sheet*/
function sheet(index) {
    url = '../result/sheet.php?index=' + index;
    getL(url);

}
</script>
