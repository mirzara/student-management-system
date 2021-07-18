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
?>
<h5>Month Name: <?php echo $month?> | Class: <?php echo $admin->class_n($class)?></h5>
<br />
<form method='post' action="/att/save.php" id="save_form" enctype="multipart/form-data">
   <table class="table table-striped table-condensed text-left">
    <thead>
      <tr>
<th>Name</th>
<th>Attendence</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $stu_list = $admin->class_list($class);
    $student_ = explode(',',$stu_list);
    $tbl = NULL;
    $x = 1;
    foreach ($student_ as $stu)  {
        $name = $admin->stu_name($stu);
    $name = "<td><strong>$name</strong></td>";
    $input = "<td><input class='form-control' name='input$x' placeholder='Attendence'/></td>";
    $row = "<tr>$name$input</tr>";
    $tbl .= $row;
    $x++;
    }
    echo $tbl;
    ?>
    </tbody>
    </table>
        <input type="hidden" name="month" value="<?php echo $month?>" />
    <input type="hidden" name="class" value="<?php echo $class?>" />
        <input type="hidden" name="days" value="<?php echo $days?>" />
        <input class="btn btn-primary btn-sm" type="submit" value="Add Attendence" /></form>
        <script>
setform('#save_form','#form_div');
</script>
