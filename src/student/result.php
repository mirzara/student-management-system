<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
$name = mysqli_real_escape_string($admin->conn, $_POST['std']);
$keyword = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$optn =  mysqli_escape_string($admin->conn,$_POST['optn']);
$sql = "SELECT * from `student` where `name` LIKE '%$name%'";
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
    getL('../student/search.php?optn=$optn')
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
        <th>Parentage</th>
        <th>Address</th>
        <th>Class</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
EOD;
while ($row = $result->fetch_assoc()) {
    $index = $row['Index'];
    $s_name = $row['name'];
    $pname = $row['pname'];
    $addr = $row['addr'];
    $class = $admin->class_n($row['class']);
    if ($optn == 1) {
    $action = "<a href='#' onclick='view($index)'>View Profile</a>";
    }
    if ($optn == 2) {
    $action = "<a href='#' onclick='edit($index)'>Update Profile</a>";
    }
    if ($optn == 3) {
    $action = "<a href='#' onclick='fee($index)'>Add Fee</a>";
    }
echo <<< EOD
<tr><td>$s_name</td><td>$pname</td><td>$addr</td><td>$class Std.</td><td>$action<td></tr>

EOD;
}
echo "</tbody></table><a href='#' onclick='try_again()' class='btn btn-primary btn-sm'>Try Again</a>";

?>
<script>
function try_again() {
    getL('../student/search.php?optn=<?php echo $optn ?>')
}
function view(index) {
    url = '../student/profile.php?index=' + index;
    getL(url);
}
function edit(index) {
    url = '../student/edit.php?index=' + index;
    getL(url);
}
function fee(index) {
    url = '../fee/add.php?index=' + index;
    getL(url);
}
</script>
