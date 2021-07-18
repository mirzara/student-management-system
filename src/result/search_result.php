<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$name = mysqli_real_escape_string($admin->conn, $_POST['std']);
$keyword = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$sql = "SELECT * from `result` where `handle` IN (Select `adm` from `student` where `name` LIKE '%$name%') order by `Index` DESC";
    $result = $admin->conn->query($sql);
        if ($result === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} 
if ($result->num_rows < 1) {
      echo "<br/><h4 class='mbr-font'>No record found for keyword '$keyword'</h4>";
      echo "<br/><a href='#' onclick='try_again()' class='btn btn-primary btn-sm'>Try Again</a>";
echo <<< EOD
    <script>
function try_again() {
    getL('../result/search.php')
}
</script>
EOD;
exit();  
}
$no_of_rows = $result->num_rows;
echo <<< EOD
<h6 style='padding:10px'>$no_of_rows Results found for Keyword: $keyword</h6>
<table class="table table-condensed table-striped text-left">
    <thead>
      <tr>
        <th>Name</th>
        <th>Class</th>
        <th>Exam</th>
        <th>Date</th>
        <th>Marks</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
EOD;
while ($row = $result->fetch_assoc()) {
    $index = $row['Index'];
    $name = $admin->stu_name($row['handle']);
    $exam_code = $row['exam_code'];
    $marks_at = $row['total'];
    $exam_p = $admin->exam($exam_code);
    $exam_name = $exam_p[0];
    $exam_date = $exam_p[3];
    $max = $exam_p[4];
    $class = $exam_p[1];

    $action = "<a href='#' onclick='view($index)'>View Result</a>";
echo <<< EOD
<tr><td>$name</td><td>$class</td><td>$exam_name</td><td>$exam_date</td><td>$marks_at / $max</td><td>$action</td></tr>

EOD;
}
echo "</tbody></table><a href='#' onclick='try_again()' class='btn btn-primary btn-sm'>Try Again</a>";

?>
<script>
function try_again() {
    getL('../result/search.php')
}
function view(index) {
    url = '../result/result.php?index=' + index;
    getL(url);
}
</script>
