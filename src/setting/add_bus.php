 <?php
 if (isset($_POST['sub'])) {
    require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
    $name = mysqli_escape_string($admin->conn,$_POST['name']);
    $fee = mysqli_escape_string($admin->conn,$_POST['fee']);
  $sql = "INSERT INTO `bus_str`(`Index`, `code`, `stop`, `fee`) VALUES (NULL,'0','$name','$fee')"; 
      $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
 $id = $admin->conn->insert_id;
 $code = 'BUS-'.$id;
 $sql = "UPDATE `bus_str` SET `code`='$code' WHERE `Index`='$id'";
       $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
    if ($add === true) {
echo <<< EOD
 <h4>Add <span class="tag">Class</span></h4><br />
 <div class="pb-3 text-left">
 <h4>New Bus-Stop added in the data.</h4><br/>
 <a href='#' class='btn btn-primary btn-sm whte' onclick='add_bus()'>Add New Bus-Stop</a>
 </div>
EOD;
exit();
}
 }
 ?>
 <div id="form_div">
 <h4>Add <span class="tag">Bus-Stop</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/add_bus.php">
 <input class="form-control" name="name" placeholder="Bus Stop" />
 <br />
 <input class="form-control" name="fee" placeholder="Fee per month"/>
 <br />
 <input type="hidden" name="sub"/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
