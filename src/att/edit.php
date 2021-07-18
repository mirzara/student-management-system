<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?>
<style>
.bl {
    color: #149dcc !important;
}
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-setting3 menu__"></span> Update Attendence</h4>
<hr/>
<div class="container col-md-8 text-center" style='margin:auto;' id="form_div">
   <table class="table table-striped table-condensed text-left">
    <thead>
      <tr>
        <th>Name</th>
        <th>Month</th>
        <th>Updated</th>
        <th>Action</th>
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
<tr id='att$index'><td><strong>$name</strong></td><td>$date</td><td>$class</td><td><a class='bl' onclick="del($index,'att')">Delete</a></td></tr>

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
function del(index,type) {
    var r = confirm("Do you want to delete?");
if (r == true) {
    var url = '../setting/del.php?type='+ type + '&index=' + index;
    $('#'+ type  + index).load(url);
}
}
</script>
