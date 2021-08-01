  <?php
require_once __DIR__.'\..\lib\school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reeload page<h4>";
    exit();
}
$data = mysqli_escape_string($admin->conn,$_POST['data']);
?>
  <html>
  <head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i"/>
  <link rel="stylesheet" href="/assets/web/assets/mobirise-icons/mobirise-icons.css"/>
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../lib/print.css"/>
  <script src="/assets/web/assets/jquery/jquery.min.js"></script>
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
.pb-3 {
    padding: 25px;
    padding-left: 0px;
}
</style>
  </head>
  <body onload="printContent('print')">
  <div id="print">

<div class="row">
<div class="col-md-3"><br/>
<img src="/images/school.png" class="img-responsive" style="width:170px;max-height:auto;display:block;">
</div>
<div class="col-md-9 text-center pb-3">
<h3 style="font-weight: 400;">Isalamia College of Science and Commerce</h3>
<h4 style="font-weight: 400;">Hawal Srinagar- 190002</h4>
<h5 style="font-weight: 400;">Phone: +91-123456789</h5>
</div>
</div>
      
      <br />
<h6 class="text-center"><span class="tag">Subject:</span> <?php echo $_POST['sub'];?></h6><br/>
<?php 
$data_exp = explode(',',$data);
$row = NULL;
foreach ($data_exp as $field) {
switch ($field) {
    case "name":
    $row .= '<th>Name</th>';
    break;
    case "addr":
    $row .= "<th>Address</th>";
    break;
    case "parent":
    $row .= "<th>Parentage</th>";
    break;
    case "phone":
    $row .= "<th>Phone No</th>";
    break;
    case "bus" :
    $row .= "<th>Bus Stop</th>";
    break;
    case "class":
    $row .= "<th>Class</th>";
    break;
    case "email":
    $row .= "<th>E-mail</th>";
    break;
    case "adhaar":
    $row .= "<th>Adhaar No</th>";
    break;
    case "status":
    $row .= "<th>Status</th>";
    break;
}
}
$class = $_POST['class'];
if ($class != "NULL") {
    $class = $_POST['class'];
    $wh_class = "and `class`='$class'";
} else {
    $wh_class = NULL;
}
$bus = $_POST['bus'];
if ($class != "NULL") {

    $wh_bus = "and `bus`='$bus'";
} else if ($bus == 'No') {
    $wh_bus =  "and `bus`='NULL'";;
} else {
    $wh_bus = NULL;
}
$session = $_POST['session'];
$wh_session = "and `session`='$session'";

$sql = "Select * from `student` where 1  $wh_class $wh_bus $wh_session";
$result = $admin->conn->query($sql);
        if ($result === FALSE) {
         echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();

} 
$tbl_body   = NULL;
$row_ = NULL;
while ($result_ = $result->fetch_assoc()) {
 foreach ($data_exp as $field) {
switch ($field) {
    case "name":
    $key = "name";
    $row_ .= "<td>".$result_[$key]."</td>";
    break;
    case "addr":
    $key = "addr";
    $row_ .= "<td>".$result_[$key]."</td>";
    break;
    case "parent":
    $key = "pname";
    $row_ .= "<td>".$result_[$key]."</td>";
    break;
    case "phone":
    $key = "phone";
    $row_ .= "<td>".$result_[$key]."</td>";
    break;
    case "bus" :
    $key = "bus";
    $row_ .= "<td>".$admin->bus_n($result_[$key])."</td>";
    break;
    case "class":
    $key = "class";
    $row_ .= "<td>".$admin->class_n($result_[$key])."</td>";
    break;
    case "email":
    $key = "email";
    $row_ .= "<td>".$result_[$key]."</td>";
    break;
    case "adhaar":
    $row_ .= "<th>Adhaar No</th>";
    break;
    case "status":
    $key = "status";
    $row_ .= "<td>".$result_[$key]."</td>";
    break;
}   
}
$tbl_body .= "<tr>$row_</tr>";
$row_ = NULL;
}
echo <<< EOD
<table class="table table-condensed table-striped text-left">
    <thead>
      <tr>
  $row
      </tr>
    </thead>
    $tbl_body
    <tbody>
    </tbody>
    </table>
EOD;
?>

</div>
</body>
  <script>
  function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
    document.close();
	document.body.innerHTML = restorepage;
}
  </script>
</html>