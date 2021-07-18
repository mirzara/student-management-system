 <?php
 if (isset($_POST['sub'])) {
    require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
    $name = mysqli_escape_string($admin->conn,$_POST['username']);
    $pwd = md5($_POST['pwd']);
    $rnd = md5(rand(10,10));
  $sql = "INSERT INTO `login`(`Index`, `username`, `password`, `type`, `date`, `auth`) VALUES (NULL,'$name','$pwd','user',NOW(),'$rnd')"; 
      $add = $admin->conn->query($sql);
        if ($add === FALSE) {
    echo "Error: " . $sql . "<br>" . $admin->conn->error;
        exit();
} 
    if ($add === true) {
echo <<< EOD
 <h4>Add <span class="tag">Class</span></h4><br />
 <div class="pb-3 text-left">
 <h4>New User added in School.Net.</h4><br/>
 <a href='#' class='btn btn-primary btn-sm whte' onclick='add()'>Add New User</a>
 </div>
EOD;
exit();
}
 }
 ?>
 <div id="form_div">
 <h4>Add <span class="tag">User</span></h4><br />
 <div class="pb-3">
 <form id="form" method="post" action="../setting/add_user.php">
 <input class="form-control" name="username" placeholder="Userame" />
 <br />
 <input class="form-control" name="pwd" type="password" placeholder="Password"/>
 <br />
 <input type="hidden" name="sub"/>
 <input class="btn btn-primary btn-sm" type="submit" value="Add" name="add" />
 </form>
 </div>
 </div>
 <script>
 setform('#form', '#form_div')
 </script>
