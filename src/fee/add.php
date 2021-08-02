<?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
if (!isset($_GET['index']) or $_GET['index'] == '') {
echo "<h4>Invalid Index!<h4>";
    exit();    
}
$index = mysqli_escape_string($admin->conn,$_GET['index']);
$sql = "Select * from `student` where `Index`='$index'";
$result = $admin->conn->query($sql);
        if ($result === FALSE) {
         echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} 
if ($result->num_rows < 1) {
echo "Error: Broken record for index $index";
exit();
}
$row = $result->fetch_assoc();
$bus = $row['bus'];
$class = $row['class'];
$bus_fee = $admin->fee($bus,'bus');
$acd_fee = $admin->fee($class,'class');
$total = $bus_fee + $acd_fee;
$adm_id = $row['adm'];
?>
<style>
.img-responsive {
    width: 100%;
    height: auto;
    margin: auto;
}
.display-Cm {
    font-family: 'Rubik', sans-serif;
    font-size: 17px !important;
    font-weight: 400;
    letter-spacing: 1.5px;
    padding: 1px;
    color: #1456cc;
}
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-credit-card menu__"></span> Add Fee</h4>
<hr/>

<div class="col-md-12">
<div class="row text-left">
<div class="col-md-4">
<span>Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['name']; ?></h6></div>
<div class="col-md-4">
<span>Parent Name:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['pname']; ?></h6></div>
<div class="col-md-4">
<span>Address:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['addr']; ?></h6></div></div>
<div class="row text-left">
<div class="col-md-4">
<span>Adm No:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['adm']; ?></h6></div>
<div class="col-md-4">
<span>Class:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $admin->class_n($row['class']); ?> Standard</h6></div>
<div class="col-md-4">
<span>Bus:</span>
<h6 class="mbr-section-subtitle mbr-light  mbr-fonts-style display-Cm"><?php echo $row['bus']; ?></h6></div></div>
<br />
<label>Fee Terminal</label>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Monthly Acadmic Fee</th>
<th>Monthly Bus Fee</th>
<th>Total Fee/Month</th>
<th>Last Paid Month</th>
</thead>
<tbody>
<tr><td>Rs <?php echo $acd_fee; ?> INR</td><td>Rs <?php echo $bus_fee; ?> INR</td><th><?php echo $total; ?></th><th><?php
$sql = "Select `fee_date` from `fee` where `handle`='$adm_id' ORDER BY `fee_date` DESC";
$last_fee = $admin->conn->query($sql);
if ($last_fee === TRUE) {
    echo 'Okay';
    exit();
}
$row_fee = $last_fee->fetch_assoc();
$last_fee_date = strtotime($row_fee['fee_date']);
echo date("j F Y", $last_fee_date);
?></th></tr>
</tbody>
</table>
<br />
<div id="form_div">
<form method='post' action="/fee/update.php" id="save_form">
<div class="row" style="margin: auto;">
<div class="col-md-4" style="margin: auto;">
<input class='form-control' type="text" placeholder="No of Month (Fee)" name="n_month" id="no_mnt" onchange='var total = <?php echo $total ?>;var month = $("#no_mnt").val();
var Gtotal = (total * month); $("#total").val(Gtotal);$("#total_2").val("Rs "+Gtotal+" INR");'/>
</div>
<div class="col-md-6" style="margin: auto;">
<input class='form-control' type="text" placeholder="Total Amount" id="total_2" readonly=""/></div>
<input type="hidden" name="total" value="" id="total" />
<input type="hidden" name="bus_fee" value="<?php echo $bus_fee ?>"/>
<input type="hidden" name="class_fee" value="<?php echo $acd_fee ?>" />
<input type="hidden" name="index" value="<?php echo $index; ?>" />
</div><br />
<div class="row" style="margin: auto;">
<div class="col-md-4" style="margin: auto;">
<input type="number" class="form-control" name="latefee_no" placeholder="n Month for late fee" value="0" id="lte_mnth" onchange="late_fee()" />
</div>
<div class="col-md-4" style="margin: auto;">
<input type="number" class="form-control" name="amount_latefee" placeholder="Amount of Late Fee per month" onchange="late_fee()" id="lte_amt" value="0" />
</div>
</div>
<br />
<div class="col-md-10" style="margin: auto;">
<textarea class="form-control" rows="4" name="remarks" placeholder="Remarks"></textarea>
<br />
<input class="btn btn-primary btn-sm" type="submit" value="Add Fee"/>
</div>
</form></div>
<script>
setform('#save_form','#form_div');
function late_fee() {
    var total = <?php echo $total ?>;
    var month = $("#no_mnt").val();
    var Gtotal = (total * month); 
$("#total").val(Gtotal);$("#total_2").val("Rs "+Gtotal+" INR");
    var month = $('#lte_mnth').val();
    var amt = $('#lte_amt').val();
    var sub_total = (month * amt);
    var sub_total_fee = $('#total').val();
    var Gtotal = parseInt(sub_total) + parseInt(sub_total_fee);
    $("#total").val(Gtotal);
    $("#total_2").val("Rs "+Gtotal+" INR");
}
</script>