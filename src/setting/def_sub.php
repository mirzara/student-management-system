 <?php
 if (isset($_POST['sub'])) {
    require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
    $name = mysqli_escape_string($admin->conn,$_POST['name']);
  $sql = "INSERT INTO `sub_def`(`Index`, `name`, `code`) VALUES (NULL,'$name','NULL')"; 
      $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
 $id = $admin->conn->insert_id;
 $code = 'SUB-'.$id;
 $sql = "UPDATE `sub_def` SET `code`='$code' WHERE `Index`='$id'";
       $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
    if ($add === true) {
echo <<< EOD
 <h4>Add <span class="tag">Subject</span></h4><br />
 <div class="pb-3 text-left">
 <h4>New Subject defined in the database.</h4><br/>
 <a href='#' class='btn btn-primary btn-sm whte' onclick='sub_def()'>Add New Subject</a>
 </div>
EOD;
exit();
}
 }
 ?>
 <div id="form_div">
 <h4>Add <span class="tag">Subject</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/def_sub.php">
 <input class="form-control" name="name" placeholder="Subject Name" />
 <br />
 <input type="hidden" name="sub"/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
