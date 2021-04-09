<?php
if (isset($_GET['optn'])) {
$optn = $_GET['optn'];
if ($optn == 1) {
$txt  = '<span class="mbri-photo menu__"></span> Search Student';
} else if ($optn == 2) {
 $txt  = '<span class="mbri-setting3 menu__"></span> Update Student';   
} else if ($optn == 3) {
 $txt  = '<span class="mbri-credit-card menu__"></span> Add Fee';   
}  
    } else {
    $txt = NULL;
}
?>
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><?php  echo $txt?></h4>
<hr/>
<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/student/result.php" id="save_form">
    <label>Search Database</label>
<input class='form-control input-sm' name="std" placeholder="Student's Name" required=""><br/>
<input type="hidden" name="optn" value="<?php echo $optn ?>">
<input type="submit" class="btn btn-primary btn-sm" value='Search'>
    </form>
    </div></div>
<script>
setform('#save_form','#search_div');
</script>