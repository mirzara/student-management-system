<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
if (isset($_GET['index']) and isset($_GET['index'])) {
$index = mysqli_real_escape_string($admin->conn, $_GET['index']);
$type = mysqli_real_escape_string($admin->conn, $_GET['type']);
if ($type == 'class') {
    $sql = "select * from `class_str` where `Index`='$index'";
    $add = $admin->conn->query($sql);
    if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
$row = $add->fetch_assoc();
$name = mysqli_escape_string($admin->conn,$row['class']);
$fee = mysqli_escape_string($admin->conn,$row['fee']);
echo <<< EOD
<div id="form_div">
 <h4>Add <span class="tag">Class</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/edit.php">
 <input class="form-control" name="name" placeholder="Class Name" value='$name' />
 <br />
 <input class="form-control" name="fee" placeholder="Fee per month" value='$fee'/>
 <br />
 <input type="hidden" name="sub" value='class'/>
  <input type="hidden" name="index" value='$index'/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
EOD;
} else if ($type == 'bus') {
    $sql = "select * from `bus_str` where `Index`='$index'";
    $add = $admin->conn->query($sql);
    if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
$row = $add->fetch_assoc();
$name = mysqli_escape_string($admin->conn,$row['stop']);
$fee = mysqli_escape_string($admin->conn,$row['fee']);
echo <<< EOD
<div id="form_div">
 <h4>Add <span class="tag">Class</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/edit.php">
 <input class="form-control" name="name" placeholder="Stop Name" value='$name' />
 <br />
 <input class="form-control" name="fee" placeholder="Fee per month" value='$fee'/>
 <br />
 <input type="hidden" name="sub" value='bus'/>
  <input type="hidden" name="index" value='$index'/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
EOD;
} else if ($type == 'sub') {
    $sql = "select * from `sub_def` where `Index`='$index'";
    $add = $admin->conn->query($sql);
    if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
$row = $add->fetch_assoc();
$name = mysqli_escape_string($admin->conn,$row['name']);
echo <<< EOD
<div id="form_div">
 <h4>Add <span class="tag">Class</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/edit.php">
 <input class="form-control" name="name" placeholder="Subject Name" value='$name' />
 <br />
 <input type="hidden" name="sub" value='sub'/>
  <input type="hidden" name="index" value='$index'/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
EOD;
} else if ($type == 'exam') {
    $sql = "select * from `exam_def` where `Index`='$index'";
    $add = $admin->conn->query($sql);
    if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
$row = $add->fetch_assoc();
    $sub_code = $row['sub_code'];
    $max_marks = $row['max_marks'];
    $name = $row['name'];
    $date = $row['date'];
    $pass = $row['pass_marks'];
        $class_arry = NULL;
        $sql = "Select * from `class_str`";
$class = $admin->conn->query($sql);
    while ($row = $class->fetch_assoc()) {
    $name_ = $row['class'];
    $code = $row['code'];
$class_arry .= <<< EOD
<option class="form-control" value="$code">$name_ ($code)</option>
EOD;
}
echo <<< EOD
<div id="form_div">
 <h4>Add <span class="tag">Class</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/edit.php">
 <input class="form-control" name="name" placeholder="Exam Name" value="$name" required />
<br />
<input class="form-control" type="date" name="date" placeholder="Exam Date (YYYY-MM-DD)" value="$date" required />
<br />
<input class="form-control" name="sub_code" placeholder="Subjects (Sub_code:Marks)" value="$sub_code" required />
<br />
<select class="form-control" name="class" required>
<option class="form-control" value="">Select Class</option>$class_arry</select>
<br/>
<input  class="form-control" name="max_marks" placeholder="Max Marks (G.Total)" value="$max_marks" />
<br/>
<input  class="form-control" name="pass" placeholder="Pass Marks" value="$pass" />
<br />
 <input type="hidden" name="sub" value='exam'/>
  <input type="hidden" name="index" value='$index'/>
 <input class="btn btn-primary btn-sm" type="submit" value="Update" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
EOD;
}
} else if (isset($_POST['sub'])) {
    $sub =   mysqli_real_escape_string($admin->conn, $_POST['sub']);

switch ($sub) {
    case 'class':
     $name =   mysqli_real_escape_string($admin->conn, $_POST['name']);
     $fee =   mysqli_real_escape_string($admin->conn, $_POST['fee']);
     $index =   mysqli_real_escape_string($admin->conn, $_POST['index']);
     $sql = "UPDATE `class_str` SET `class`='$name',`fee`='$fee' where `Index`='$index'";
     $update = $admin->conn->query($sql);
     if ($update === FALSE) {
     echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
     }
     else if ($update === TRUE) {
echo <<< EOD
<h3>Record Update!</h3>
EOD;
     }
    break;
    case 'sub':
     $name =   mysqli_real_escape_string($admin->conn, $_POST['name']);
     $index =   mysqli_real_escape_string($admin->conn, $_POST['index']);
     $sql = "UPDATE `sub_def` SET `name`='$name' where `Index`='$index'";
     $update = $admin->conn->query($sql);
     if ($update === FALSE) {
     echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
     }
     else if ($update === TRUE) {
echo <<< EOD
<h3>Record Update!</h3>
EOD;
     }
    break;
    
        case 'exam':
     $index =   mysqli_real_escape_string($admin->conn, $_POST['index']);
       $name = mysqli_escape_string($admin->conn,$_POST['name']);
    $sub = mysqli_escape_string($admin->conn,$_POST['sub_code']);
    $class = mysqli_escape_string($admin->conn,$_POST['class']);
    $max_marks = mysqli_escape_string($admin->conn,$_POST['max_marks']);
    $pass = mysqli_escape_string($admin->conn,$_POST['pass']);
    $date = date('Y-m-d',strtotime($_POST['date']));
     $sql = "UPDATE `exam_def` SET `class_code`='$class',`sub_code`='$sub',`name`='$name',`max_marks`='$max_marks',`pass_marks`='$pass',`date`='$date' WHERE `Index`='$index';";
     $update = $admin->conn->query($sql);
     if ($update === FALSE) {
     echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
     }
     else if ($update === TRUE) {
echo <<< EOD
<h3>Record Update!</h3>
EOD;
     }
    break;
}
}
    
?>
