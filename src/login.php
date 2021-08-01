<div style="margin-top:100px;background: rgba(255, 255, 255, 0.56);"></div>
  <style>
    nav {
    border-bottom: 5px solid #5499b1;
}
      .cid-qvLYg0Asdn {
       border-top: 5px solid #5499b1;
      }
   body {
    background-image: url("/upload/rnb.jpg");
    background-attachment: fixed;
    background-repeat: no-repeat;
      -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.cid-qvLXFfYV49 {background:rgba(255, 255, 255, 0.9);}
         .headding {
             display: block;
    padding: 20px;
    color: #fff !important;
    background: #5499b1;
    width: 100%;
    font-family: 'Encode Sans', sans-serif;
    }
      input:submit {
          cursor: pointer;
      }
      .tag {
            padding: 4px;
    color: #fff;
    background-color: #5499b1;
    font-size: 24px;
    font-family: Rubik;
    font-weight: 400;
      }
          hr {border: 1px solid #ccc}
.menu__ {
    font-size: 40px;
    color: #5499b1;
    cursor: pointer;
    }
    .subtile_menu {
        font-size: 15px;
    }
    .containe_r {
        width: 100%;
        min-height: 500px !important;
    }
    .fix {
        position: fixed;
        left:  0;
    }
    .margin_rght {
        margin-left: 29%;
    }
    </style>
<div id="login" class="container-fluid col-md-12 text-center"  style="padding:60px;min-height: 541px !important;background: rgba(255, 255, 255, 0.56);">
    <form method="post" action="/checklogin.php">
    <div class="panel panel-primary" style="width:40%;margin:auto;background:rgba(255, 255, 255, 0.45);padding: 2%;">
      <div class="panel-body">
            <h7 class='headding'><strong>Web Login</strong></h7>
          <br/>
 <img src="/images/logo2.jpg" class="img-responsive" style="width:32%;max-height:auto">
                <br/>
               
                <span style='font-size:14px'><strong>Seoul High School</strong></span><br/>
                <hr/>
          <?php
    if (isset($error)) {
        if ($error == 1) {
echo '<tt class="text-danger">Invalid Username Or Password</tt>';
          } else  if ($error == 1) {
echo '<tt class="text-danger">Session Expired</tt>';      
        }
}
          ?>
          <br/>
<input class="form-control" placeholder="Username" name="username" type="username" required>
          <br/>
 <input class="form-control" placeholder="Password" name="password" type="password" required>
          <br/>
<input class="btn btn-primary btn-md" type="submit" value="Login">

</div>
    </div>
    </form>
    
</div>