<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index = mysqli_escape_string($admin->conn,$_POST['index']);
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
th {text-align: center}
</style>
  </head>
  <body onload="printContent('print')">
  <div id="print">

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
      <br />
<h6 class="text-center">Subject: <?php echo $_POST['sub'];?></h6><br/>
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
        <th>Name</th>
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
</div>
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
</body>
</html>