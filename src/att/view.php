<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-growing-chart menu__"></span> View Attendence</h4>
<hr/>
<div class="container col-md-8 text-center" style='margin:auto;' id="form_div">
   <table class="table table-striped table-condensed text-left">
    <thead>
      <tr>
        <th>Name</th>
        <th>Month</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `att`";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}

while ($row = $get->fetch_assoc()) {
     $sub_value = NULL;
    $index = $row['Index'];
    $name = $row['name'];
    $date = $row['month'];
    $class = date('d F Y', strtotime($row['date']));
echo <<< EOD
<tr><td><a href='#' onclick='view($index)'><strong>$name</strong></a></td><td>$date</td><td>$class</td></tr>

EOD;
}
    ?>
    </tbody>
    </table>
</div>
<script>
function view(index) {
    url = '../att/view2.php?index=' + index;
    getL(url);

}
</script>
