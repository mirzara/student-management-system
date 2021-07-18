<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-edit  menu__"></span>Published Result</h4>
<hr/>
<div class=" col-md-12 text-center" style='margin:auto;' id="form_div">
<br />
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
    $sql = "Select * from `exam_def` where `status`='1'";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}

while ($row = $get->fetch_assoc()) {
     $sub_value = NULL;
    $index = $row['Index'];
    $exam_code = $row['exam_code'];
    $class_code = $admin->class_n($row['class_code']);
    $sub_code = $row['sub_code'];
    $max_marks = $row['max_marks'];
    $name = $row['name'];
    $date = $row['date'];
    $subject__ = explode(",", $sub_code);
    foreach ($subject__ as $sub_code) {
     $sub_code_real = explode(":",$sub_code);
     $sub_value .= $admin->sub_code($sub_code_real[0]). " = ".$sub_code_real[1]."<br/> ";
    }
echo <<< EOD
<tr id='exam$index'><td><a href='#' onclick='view($index)'><strong>$name</strong></a></td><td>$date</td><td>$sub_value</td><td>$class_code</td><td>$max_marks</td></tr>

EOD;
}
    ?>
    </tbody>
    </table>

</div>
<script>
setform('#save_form','#form_div');
function view(index) {
    url = '../result/view.php?index=' + index;
    getL(url);

}
</script>
