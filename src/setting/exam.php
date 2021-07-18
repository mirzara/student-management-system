 <?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
 if (isset($_POST['sub'])) {

    $name = mysqli_escape_string($admin->conn,$_POST['name']);
    $sub = mysqli_escape_string($admin->conn,$_POST['sub_code']);
    $class = mysqli_escape_string($admin->conn,$_POST['class']);
    $student = $admin->class_list($class);
    $max_marks = mysqli_escape_string($admin->conn,$_POST['max_marks']);
    $pass = mysqli_escape_string($admin->conn,$_POST['pass']);
    $date = date('Y-m-d',strtotime($_POST['date']));
  $sql = "INSERT INTO `exam_def`(`Index`, `exam_code`, `class_code`, `sub_code`, `stu`,`name`, `max_marks`, `pass_marks`, `date`, `status`) VALUES (NULL,'NULL','$class','$sub','$student','$name','$max_marks','$pass','$date','0')"; 
      $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
 $id = $admin->conn->insert_id;
 $code = 'EXAM-'.$id;
 $sql = "UPDATE `exam_def` SET `exam_code`='$code' WHERE `Index`='$id'";
       $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
    if ($add === true) {
echo <<< EOD
 <h4>Add <span class="tag">Exam</span></h4><br />
 <div class="pb-3 text-left">
 <h4>New exam defined in the database.</h4><br/>
 <a href='#' class='btn btn-primary btn-sm whte' onclick='exam()'>Add New Exam</a>
 </div>
EOD;
exit();
}
 }
 ?>
 <div id="form_div">
 <h4>Add <span class="tag">Exam</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/exam.php">
<input class="form-control" name="name" placeholder="Exam Name" required />
<br />
<input class="form-control" type="date" name="date" placeholder="Exam Date (YYYY-MM-DD)" required />
<br />
<input class="form-control" name="sub_code" placeholder="Subjects (Sub_code:Marks)" required />
<br />
<select class="form-control" name="class" required>
<option class="form-control" value="">Select Class</option>
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
</select><br/>
<input  class="form-control" name="max_marks" placeholder="Max Marks (G.Total)" />
<br />
<input  class="form-control" name="pass" placeholder="Pass Marks (Subject-Wise)" />
 <input type="hidden" name="sub"/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
