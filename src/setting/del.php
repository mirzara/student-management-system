<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$index = mysqli_real_escape_string($admin->conn, $_GET['index']);
$type = mysqli_real_escape_string($admin->conn, $_GET['type']);
if ($type == 'class') {
    $sql = "DELETE FROM `class_str` WHERE `Index`='$index'";
} else if ($type == 'bus') {
     $sql = "DELETE FROM `bus_str` WHERE `Index`='$index'";
} else if ($type == 'sub') {
     $sql = "DELETE FROM `sub_def` WHERE `Index`='$index'";
} else if ($type == 'exam') {
$info = "SELECT `exam_code` from `exam_def` where `Index`='$index'";
$info_ = $admin->conn->query($info);
$code_ = $info_->fetch_assoc();
$code = $code_['exam_code'];
$del = "DELETE FROM `result` WHERE `exam_code`='$code'";
$del_ = $admin->conn->query($del);
     $sql = "DELETE FROM `exam_def` WHERE `Index`='$index'";
} else if ($type == 'user') {
     $sql = "DELETE FROM `login` WHERE `Index`='$index'";
} else if ($type == 'att') {
     $sql = "DELETE FROM `att` WHERE `Index`='$index'";
}
    $add = $admin->conn->query($sql);
    if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
 
    if ($add === true) {
echo "<strong>Deleted!</strong>";
exit();
}
}
?>
