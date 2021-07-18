
<h4 class="mbr-fonts-style display-2" style="font-size: 1.5rem;"><span class="mbri-search menu__"></span> Find Result</h4>
<hr/>
<div id="search_div">
<div class="container col-md-8 text-center" style='margin:auto;'>
    <form method='post' action="/result/search_result.php" id="save_form">
    <label>Search Database</label>
<input class='form-control input-sm' name="std" placeholder="Student's Name" required=""><br/>
<input type="submit" class="btn btn-primary btn-sm" value='Search'>
    </form>
    </div></div>
<script>
setform('#save_form','#search_div');
</script>