<?php

require_once __dir__ . '\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1)
{
				echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
				exit();
}
$index = mysqli_real_escape_string($admin->conn, $_POST['index']);
$bus_fee = mysqli_real_escape_string($admin->conn, $_POST['bus_fee']);
$class_fee = mysqli_real_escape_string($admin->conn, $_POST['class_fee']);
$total = ($bus_fee==null? 0:$bus_fee) + $class_fee;
$n_month = mysqli_real_escape_string($admin->conn, $_POST['n_month']);
$remarks = mysqli_real_escape_string($admin->conn, $_POST['remarks']);
$n_late_fee = mysqli_real_escape_string($admin->conn,$_POST['latefee_no']);
$amount_late_fee = mysqli_real_escape_string($admin->conn,$_POST['amount_latefee']);
$total_late_fee = $n_late_fee * $amount_late_fee;
$total_ = ($total * $n_month) + $total_late_fee;
$adm_id = $admin->adm_id($index);
$sql = "Select * from `fee` where `handle`='$adm_id' ORDER BY `fee_date` DESC";
$db = $admin->conn->query($sql);
if (!$db)
{
				echo "Error: " . $sql . "<br>" . $admin->conn->error;
				exit();
}

$num = $db->num_rows;
if ($db->num_rows < 1)
{
				$date_u = date('Y-m-d') . ' 00:00:00';
				$date_unix = strtotime($date_u);
} else
{
				$date_ = $db->fetch_assoc();
				$date_u = $date_['fee_date'];
				$date_unix = strtotime($date_u);
}
$x = 1;
$tble_data = null;
$n_month = $n_month + 1;
while ($x < $n_month)
{
                if ($num >= 1) {
				$date__ = $date_unix + 2592000 * $x;
                } else if ($num < 1) {
               	$date__ = $date_unix;   
                }
				$date_fee = date('Y-m-d', $date__) . ' 00:00:00';
				$date_usr = date('j F Y', $date__);
				$sql = "INSERT INTO `fee`(`Index`, `handle`, `date`, `fee_date`, `class_fee`, `bus_fee`, `total`, `remarks`, `status`) VALUES (NULL,'$adm_id',NOW(),'$date_fee','$class_fee','$bus_fee','$total','$remarks','0')";
				$update_ = $admin->conn->query($sql);
				if ($update_ === false)
				{
								echo "Error: " . $sql . "<br>" . $admin->conn->error;
								exit();

				}
				$ID = mysqli_insert_id($admin->conn);
				$tble_data .= "<tr><td>TRnS-$ID</td><td>$date_usr</td><td>$total<td></tr>";

				$x++;
}

if ($amount_late_fee != 0 and $n_late_fee != 0)
{
				$date_fee = date('Y-m-d') . ' 00:00:00';
				$date_usr = date('j F Y', strtotime($date_fee));
				$sql = "INSERT INTO `fee`(`Index`, `handle`, `date`, `fee_date`, `class_fee`, `bus_fee`, `total`, `remarks`, `status`) VALUES (NULL,'$adm_id',NOW(),'$date_fee','$amount_late_fee','0','$total_late_fee','LATE_FEE','0')";
				$update_ = $admin->conn->query($sql);
				if ($update_ === false)
				{
								echo "Error: " . $sql . "<br>" . $admin->conn->error;
								exit();

				}
				$ID = mysqli_insert_id($admin->conn);
				$tble_data .= "<tr><td>LATE-FEE</td><td>$date_usr</td><td>$total_late_fee<td></tr>";
   
}

echo <<< EOD
<style>.whte {color: #fff}</style>
<h4>Fee Updated</h4>
<br/>
<table class="table table-condensed table-striped text-left">
<thead>
<th>Transaction ID</th>
<th>Month</th>
<th>Paid</th>
</thead>
<tbody>
$tble_data
<tr><td><strong>Grand Total</strong></td><td></td><td><strong>$total_</strong><td></tr>
</tbody></table>
<br/>
<div class='text-center'>
<a href='#' onclick="getL('../student/search.php?optn=3');" class='btn btn-primary btn-sm whte'>New Entry</a>
<a  href='/print/fee.php?id=$ID' class='btn btn-primary btn-sm whte' target='_blank'>Recept</a>
<a href='/'  class='btn btn-primary btn-sm whte'>Exit</a>
</div>
EOD;

?>
<script>
function print_div() {
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById('main').innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
   }
</script>