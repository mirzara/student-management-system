<?php
require_once __DIR__.'/../lib/school.php';
$admin = new Admin();
if ($admin->user == -1) {
echo "<h4>Sesson Expired/Login invalid. Please reload page<h4>";
    exit();
}
?><style>
h4 {
    font-weight: 400;
}
.whte {
    color: #fff !important;
    font-weight: 400;
}
.bl {
    color: #149dcc !important;
}
</style>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-setting menu__"></span> System Setting</h4>
<hr/>
<div id="search_div">
<div class="container col-md-12 text-center" style='margin:auto;'>
   <h4 id="classs">Class <span class="tag">Structure</span></h4>
    <div class="text-right"><a class="btn btn-primary btn-sm whte" data-toggle="modal" data-target="#myModal" onclick="add_class()" >Add</a></div>
   <table class="table table-striped text-left">
    <thead>
      <tr>
        <th>Class</th>
        <th>Code</th>
        <th>Fee</th>
        <th>Students</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `class_str`";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}
while ($row = $get->fetch_assoc()) {
    $name = $row['class'];
    $code = $row['code'];
    $fee = $row['fee'];
    $index = $row['Index'];
    $n_stu = $admin->class_stu($code);
    $onclick = "onclick='del($index,'class')'";
echo <<< EOD
<tr id='class$index'><td>$name</td><td>$code</td><td>Rs $fee INR</td><td>$n_stu</td><td><a class='bl' data-toggle="modal" data-target="#myModal" onclick="edit($index,'class')">Edit</a> | <a class='bl' onclick="del($index,'class')">Delete</a></td></tr>

EOD;
}
    ?>
   
    </tbody>
    </table>
<br />
<h4 id="classs">Bus <span class="tag">Structure</span></h4>
    <div class="text-right"><a class="btn btn-primary btn-sm whte" data-toggle="modal" data-target="#myModal" onclick="add_bus()" >Add</a></div>
   <table class="table table-striped text-left">
    <thead>
      <tr>
        <th>Stop</th>
        <th>Code</th>
        <th>Fee</th>
        <th>Students</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `bus_str`";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}
while ($row = $get->fetch_assoc()) {
    $name = $row['stop'];
    $code = $row['code'];
    $fee = $row['fee'];
    $index = $row['Index'];
    $n_stu = $admin->bus_stu($code);
echo <<< EOD
<tr id='bus$index'><td>$name</td><td>$code</td><td>Rs $fee INR</td><td>$n_stu</td><td><a class='bl' data-toggle="modal" data-target="#myModal" onclick="edit($index,'bus')">Edit</a> | <a class='bl' onclick="del($index,'bus')">Delete</a></td></tr>

EOD;
}
    ?>
   
    </tbody>
    </table>
<br />

   <h4>Subject <span class="tag">Structure</span></h4>
   <div class="text-right"><a class="btn btn-primary btn-sm whte" data-toggle="modal" data-target="#myModal" onclick="sub_def()">Add</a></div>
   <table class="table table-striped text-left">
    <thead>
      <tr>
        <th>Subject</th>
        <th>Subject Code</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `sub_def`";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}
while ($row = $get->fetch_assoc()) {
    $name = $row['name'];
    $code = $row['code'];
    $index = $row['Index'];
echo <<< EOD
<tr id='sub$index'><td>$name</td><td>$code</td><td><a class='bl' data-toggle="modal" data-target="#myModal" onclick="edit($index,'sub')">Edit</a> | <a class='bl' onclick="del($index,'sub')">Delete</a></td></tr>

EOD;
}
    ?>
    </tbody>
    </table>
    <br /><br />
    
     <h4>Exam <span class="tag">Structure</span></h4>
   <div class="text-right"><a class="btn btn-primary btn-sm whte" data-toggle="modal" data-target="#myModal" onclick="exam()">Add</a></div>
   <table class="table table-striped text-left">
    <thead>
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Subject Code</th>
        <th>Class</th>
        <th>Max Marks</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "Select * from `exam_def`";
           $get = $admin->conn->query($sql);
        if ($get === FALSE) {
            echo "Error: " . $sql . "<br>" . $admin->conn->error;
            exit();
}
while ($row = $get->fetch_assoc()) {
    $index = $row['Index'];
    $exam_code = $row['exam_code'];
    $class_code = $row['class_code'];
    $sub_code = $row['sub_code'];
    $max_marks = $row['max_marks'];
    $name = $row['name'];
    $date = $row['date'];
echo <<< EOD
<tr id='exam$index'><td><strong>$name</strong></td><td>$date</td><td>$sub_code</td><td>$class_code</td><td>$max_marks</td><td><a class='bl' data-toggle="modal" data-target="#myModal" onclick="edit($index,'exam')">Edit</a> | <a class='bl' onclick="del($index,'exam')">Delete</a></td></tr>

EOD;
}
    ?>
    </tbody>
    </table>
    
    </div></div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">System</h4>
      </div>
      <div class="modal-body" id="model_body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm m" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 
<script>
function add_class() {
    $('#model_body').load('../setting/add_class.php');
}
function add_bus() {
    $('#model_body').load('../setting/add_bus.php');
}
function sub_def() {
     $('#model_body').load('../setting/def_sub.php'); 
}
function exam() {
     $('#model_body').load('../setting/exam.php'); 
}
function del(index,type) {
    var r = confirm("Do you want to delete?");
if (r == true) {
    var url = '../setting/del.php?type='+ type + '&index=' + index;
    $('#'+ type  + index).load(url);
}
}
function edit(index,type) {
  var url = '../setting/edit.php?type='+ type + '&index=' + index;
    $('#model_body').load(url);   
}
$('.m').onclick(function() {
    $('.modal-backdrop', '.fade show').toggleClass('modal-backdrop');
    getL('../setting/add_class.php');
})
setform('#save_form','#search_div');
</script>
