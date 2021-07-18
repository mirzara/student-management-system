<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$month =  mysqli_escape_string($admin->conn,$_POST['month']);
$days =  mysqli_escape_string($admin->conn,$_POST['days']);
$class =  mysqli_escape_string($admin->conn,$_POST['class']);
$stu_list = $admin->class_list($class);
    $student_ = explode(',',$stu_list);
    $tbl = NULL;
    $x = 1;
    $no_stu = count($student_);
    foreach ($student_ as $stu)  {
        $key = "input$x";
        $value = $_POST[$key];
        $tbl .= "$stu:$value";
        if ($x != $no_stu) {
            $tbl .= ',';
        }
    $x++;
    }
    $name = $admin->class_n($class) ." ($month)";
    $sql = "INSERT INTO `att`(`Index`, `name`, `month`,`days` ,`class`, `attendence`, `date`) VALUES (NULL,'$name','$month','$days','$class','$tbl',NOW())";
    $att = $admin->conn->query($sql);
          if ($att === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
    }
            if ($att === TRUE) {
echo "<br/><br/><h2>Data Updated!</h2><br/> ";
    }

?>
