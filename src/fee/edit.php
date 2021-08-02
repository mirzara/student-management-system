<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
if (isset($_POST['trn'])) {
    $trn =  mysqli_escape_string($admin->conn,$_POST['trn']);
    $index = substr($trn,5);
$sql = "SELECT `date`,`handle` from `fee` where `Index`='$index'";
$date_exe = $admin->conn->query($sql);
$date_exe_ = $date_exe->fetch_assoc();
$date_sql = date('Y-m-d',strtotime($date_exe_['date']));
$adm = $date_exe_['handle'];
$date1 = $date_sql . ' 00:00:00';
$date2 = $date_sql . ' 23:59:59';
$sql = "SELECT * from `fee` where `handle`='$adm' and `date` between '$date1' and '$date2' order by `Index` ASC";
$res = $admin->conn->query($sql);
if ($res->num_rows > 0) {
    $tble_data = NULL;
while ($data = $res->fetch_assoc()) {
$index = $data['Index'];
$date = date("F Y",strtotime($data['fee_date']));
$paid = date("d F Y",strtotime($data['date']));
$bus_fee = $data['bus_fee'];
$class_fee = $data['class_fee'];
$totl = $data['total'];
$tble_data .= "<tr id='del_$index'><td>TRnS-$index</td><td>$date</td><td>$paid</td><td>Rs $class_fee</td><td>$bus_fee</td><td>$totl</td><td><a href='#' onclick='del($index)'>Delete</a></td></tr>";
}
$sql = "Select * from `student` where `adm`='$adm'";
$result = $admin->conn->query($sql);
$data = $result->fetch_assoc();
$name_ = $data['name'];
$pname = $data['pname'];
$phone = $data['phone'];
$class = $data['class'];
echo <<< EOD
<style>.whte {color: #fff}
.display-Cm {
    font-family: 'Rubik', sans-serif;
    font-size: 17px !important;
    font-weight: 400;
    letter-spacing: 1.5px;
    padding: 1px;
    color: #1456cc;
}</style>
<div class="row text-left">
<div class="col-md-6">
<span>Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm">$name_</h6>
<span>Parent Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm">$pname</h6>
<span>Phone:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm">$phone</h6>
</div><div class="col-md-6">
<span>Adm No:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm">$adm</h6>
<span>Class:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm">$class</h6>
</div>
</div>
<br />
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Month</th>
<th>Paid On</th>
<th>Class Fee</th>
<th>Bus Fee</th>
<th>Total</th>
<th>Action</th>
</thead>
<tbody>
$tble_data
</tbody></table>
<br/>
<div class='text-center'>
<a href='/'  class='btn btn-primary btn-sm whte'>Exit</a>
</div>
<script>
function del(index) {
var r = confirm("Do you want to delete?");
if (r == true){
    var url = "../fee/edit.php?del=1&index=" + index;
    $('#del_' + index).load(url);
}
}
</script>
EOD;
exit();
} else {
    echo "<strong>Record not found</strong><br/>";
}
} else if (isset($_GET['del'])) {
   $index =  mysqli_escape_string($admin->conn,$_GET['index']);
   $sql = "DELETE FROM `fee` WHERE `Index`='$index'";
   $result = $admin->conn->query($sql);
            if ($result === FALSE) {
         echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
}
echo "<strong>Record Deleted</strong>";
exit();
} else {
echo <<< EOD
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-setting3 menu__"></span> Update Fee</h4>
<hr/>
EOD;
}
?>

<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/fee/edit.php" id="save_form">
    <label>Search Database</label>
<input class='form-control input-sm' name="trn" placeholder="TRnS ID"><br/>
<input type="submit" class="btn btn-primary btn-sm" value='Search'>
    </form>
    </div>
<script>
setform('#save_form','#search_div');
</script></div>