
<style>
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

<section class="carousel slide testimonials-slider cid-qvLXFfYV49" id="testimonials-slider1-3" data-rv-view="48">
    <div class="container text-center containe_r">
        <div class='col-md-12' style='margin:auto'>

            <div class="row">
            <div class="col-md-3 fix">
               <img src="/images/school.png" class="img-responsive" style="width:70%;max-height:auto">
                <br/><br/>
                <span style='font-size:14px'>Sogam Lolab, Pin-193223</span><br/>
                <hr/>
                <span style='font-size:15px'><strong>Classes: </strong><?php
                $qry = "SELECT NULL from `class_str`";
                $cal_ = $admin->conn->query($qry);
                echo $cal_->num_rows;
                ?></span><br/>
                <span style='font-size:15px'><strong>Students: </strong><?php
                $qry = "SELECT NULL from `student`";
                $cal_ = $admin->conn->query($qry);
                echo $cal_->num_rows;
                ?></span><br/>
                <span style='font-size:15px'><strong>Teacher: </strong><?php
                $qry = "SELECT NULL from `teacher`";
                $cal_ = $admin->conn->query($qry);
                echo $cal_->num_rows;
                ?></span><br/> 
                <span style='font-size:15px'><strong>Current Transaction: </strong>Rs <?php
                $date1 = date('Y-m-d').' 00:00:00';
                $date2 = date('Y-m-d').' 23:59:59';
                $qry = "SELECT sum(`total`) as total from `fee` where `date` between '$date1' and '$date2'";
                $cal_ = $admin->conn->query($qry);
                $totl = $cal_->fetch_assoc();
                echo $totl['total'];
                ?> INR</span><br/>
                <span style='font-size:15px'><strong>Total Transaction: </strong>Rs <?php
                $qry = "SELECT sum(`total`) as total from `fee`";
                $cal_ = $admin->conn->query($qry);
                $totl = $cal_->fetch_assoc();
                echo $totl['total'];
                ?> INR</span><br/>
                </div>
                <div class="col-md-8 margin_rght">
                    <div id="main">
                    <div class="row">
         <h6 class="headding" style="margin-bottom: 30px;">Dashboard</h6>          
           <br />
                            <div class="col-md-3">
<a href="#" onclick="getL('../student/add.php');" style="text-decoration: none;"><span class="mbri-file menu__"></span><br/><h7><b>Add Student</b></h7></a>
       </div>
                                                    <div class="col-md-3">
<a href="#" onclick="getL('../student/search.php?optn=1');" style="text-decoration: none;"><span class="mbri-photo menu__"></span><br/><h7><b>Student Profile</b></h7></a>
                            </div>
                                  <div class="col-md-3">
<a href="#" onclick="getL('../student/search.php?optn=2');" style="text-decoration: none;"><span class="mbri-setting3 menu__"></span><br/><h7><b>Update Student</b></h7></a></div>
                            
                            <div class="col-md-3">
<a href="#" onclick="getL('../student/download.php');" style="text-decoration: none;"><span class="mbri-save menu__"></span><br/><h7><b>Download Report</b></h7></a>
                        </div>
                    </div>
                      <br/><hr/><br/>
                             <div class="row">
                            <div class="col-md-3">
<a href="#" onclick="getL('../student/search.php?optn=3');" style="text-decoration: none;"><span class="mbri-credit-card menu__"></span><br/><h7><b>Add Fee</b></h7></a>
                            </div>
                                <div class="col-md-3">
<a href="#" onclick="getL('../fee/fee_rqrd.php');" style="text-decoration: none;"><span class="mbri-edit menu__"></span><br/><h7><b>Fee Record</b></h7></a></div>
                                <div class="col-md-3">
<a href="#" onclick="getL('../fee/edit.php');"  style="text-decoration: none;"><span class="mbri-setting3 menu__"></span><br/><h7><b>Update Fee</b></h7></a>
                            </div>
                            <div class="col-md-3">
<a href="#" onclick="getL('../fee/download.php');" style="text-decoration: none;"><span class="mbri-save menu__"></span><br/><h7><b>Download Report</b></h7></a>
                        </div>
                    </div>
                    <br/><hr/><br/>
                             <div class="row">
                            <div class="col-md-3">
<a href="#" onclick="getL('../result/add.php');" style="text-decoration: none;"><span class="mbri-edit2 menu__"></span><br/><h7><b>Add Result</b></h7></a>
                            </div>
                                <div class="col-md-3">
<a href="#" onclick="getL('../result/pub.php');" style="text-decoration: none;"><span class="mbri-edit menu__"></span><br/><h7><b>Published Result</b></h7></a></div>
                                <div class="col-md-3">
<a href="#" onclick="getL('../result/search.php');"  style="text-decoration: none;"><span class="mbri-search menu__"></span><br/><h7><b>Find Result</b></h7></a>
                            </div>
                              <div class="col-md-3">
<a href="#" onclick="getL('../result/download.php');"style="text-decoration: none;"><span class="mbri-save menu__"></span><br/><h7><b>Download Report</b></h7></a>
                        </div>
                    </div>

                    <br/><hr/><br/>
                             <div class="row">
<div class="col-md-3">
<a href="#" onclick="getL('../teachers/add.php');" style="text-decoration: none;"><span class="mbri-file menu__"></span><br/><h7><b>Add Teacher</b></h7></a>
                        </div>
                      
                                <div class="col-md-3">
<a href="#" onclick="getL('../teachers/search.php?optn=1');" style="text-decoration: none;"><span class="mbri-photo menu__"></span><br/><h7><b>Teacher Profile</b></h7></a>
                            </div>
                            <div class="col-md-3">
<a href="#" onclick="getL('../teachers/search.php?optn=2');" style="text-decoration: none;"><span class="mbri-setting3 menu__"></span><br/><h7><b>Update Teacher</b></h7></a>
                        </div>
   <div class="col-md-3">
<a href="#" onclick="getL('../setting/users.php');" style="text-decoration: none;"><span class="mbri-user menu__"></span><br/><h7><b>Manage Users</b></h7></a>
                        </div>
                    </div>
                     <br/><hr/><br/>
                             <div class="row">
<div class="col-md-3">
<a href="#" onclick="getL('../att/add.php');" style="text-decoration: none;"><span class="mbri-calendar menu__"></span><br/><h7><b>Add Attendence</b></h7></a>
                        </div>
                      
                                <div class="col-md-3">
<a href="#" onclick="getL('../att/view.php');" style="text-decoration: none;"><span class="mbri-growing-chart menu__"></span><br/><h7><b>View Attendnce</b></h7></a>
                            </div>
                            <div class="col-md-3">
<a href="#" onclick="getL('../att/edit.php');" style="text-decoration: none;"><span class="mbri-setting3 menu__"></span><br/><h7><b>Manage Attendence</b></h7></a>
                        </div>
   <div class="col-md-3">
<a href="#" onclick="getL('../att/download.php');" style="text-decoration: none;"><span class="mbri-save menu__"></span><br/><h7><b>Download Report</b></h7></a>
                        </div>
                    </div>
<br/><hr/><br/>
                             <div class="row">
                            <div class="col-md-3">
<a href="#" onclick="getL('../about.php');"  style="text-decoration: none;"><span class="mbri-home menu__"></span><br/><h7><b>About School.Net</b></h7></a>
                            </div>
                                <div class="col-md-3">
<a href="#" onclick="getL('../setting/system.php');" style="text-decoration: none;"><span class="mbri-setting menu__"></span><br/><h7><b>School Setting</b></h7></a></div>
                                <div class="col-md-3">
<a href="#" onclick="getL('../setting/password.php');"  style="text-decoration: none;"><span class="mbri-key menu__"></span><br/><h7><b>Change Password</b></h7></a>
                            </div>
                              <div class="col-md-3">
<a href="/logout.php" style="text-decoration: none;"><span class="mbri-lock menu__"></span><br/><h7><b>Logout</b></h7></a>
                        </div>
                    </div>

                  </div>
                    </div>
            </div>
        </div>
    </div>
</section>
