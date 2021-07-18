<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index = mysqli_escape_string($admin->conn,$_POST['index']);
$class = mysqli_escape_string($admin->conn,$_POST['class']);
$sql = "Select * from `exam_def` where `Index`='$index'";
$res = $admin->conn->query($sql);
$exam = $res->fetch_assoc();
$class = $exam['class_code'];
$subject_raw = $exam['sub_code'];   
$exam_code = $exam['exam_code'];
$max_marks = $exam['max_marks'];
$student_list = $exam['stu'];
$subject = explode(',',$subject_raw);
$no_subject = count($subject);
$sub_value = NULL;
$x = 1;
/*
    $sql = "Select * from `student` where `class`='$class' ORDER BY `Index` ASC";
           $res_ = $admin->conn->query($sql);
        if ($res === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}/*/
$student_ = explode(',',$student_list);
$y = 1;
$marks = NULL;
foreach ($student_ as $adm) {
    $x = 1;
    $total = NULL;
foreach ($subject as $sub) {
    $key = $y.'mz'.$x; 
    $mark_ = mysqli_escape_string($admin->conn,$_POST[$key]);
    $marks .= $sub.":$mark_"; 
    if ($x <> $no_subject) {
        $marks .= ',';
    }
    $total = $total + $mark_;
$x++;    
}
if (isset($_POST['promote'])) {
   
$class = $_POST['promote'];
  if ($class != '') {
$percent = ($total / $max_marks) *  100;
    
    $update = "UPDATE `student` SET `class`='$class' where `adm`='$adm'";
    $promote = $admin->conn->query($update);
    if ($promote === FALSE) {
        echo "Error: " . $update . "<br>" . $admin->conn->error;
            exit();
    }
    $status = '1';
    $p_class = $class;
    $year = date('Y') + 1;
    $update = "UPDATE `student` SET `session`='$year' where `adm`='$adm'";
    $promote = $admin->conn->query($update);
} else {
    $status = '0';
    $p_class = NULL;
}
} 
$sql = "INSERT INTO `result`(`Index`, `handle`, `exam_code`, `result`, `total`, `p_class`,`status`) VALUES (NULL,'$adm','$exam_code','$marks','$total','$p_class','$status')";
$update = $admin->conn->query($sql);

$marks = NULL;
$y++;
}
$sql = "UPDATE `exam_def` SET `status`='1'";
$promote = $admin->conn->query($sql);
echo <<< EOD
<br/>
<h1>Result Updated!</h1>
EOD;
?>
