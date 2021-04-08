<section class="cid-qvLYg0Asdn" id="footer5-5" data-rv-view="56">
    <div class="container" style="margin-top:10px">
        <div class="media-container-row">
            <div class="col-md-3">
                <div class="media-wrap">
                    <a href="#">
                       <img src="assets/images/networking-inc-979x591.png" alt="Mobirise" title="" media-simple="true">
                    </a>
                </div>
            </div>
            <div class="col-md-9">
              <div class="media-wrap">
                <p class="mbr-text align-right links mbr-fonts-style display-7" style="padding-top: 1%;">
                  Developed By: <strong>Abrar Ajaz Wani</strong><br />Phone: +91-8493081876 <br /> E-mail: abhaywani114@gmail.com
                </p>
                </div>
            </div>
        </div>
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="media-container-row mbr-white">
                <div class="col-md-6 copyright">
                    <p class="mbr-text mbr-fonts-style display-7">
                        © Copyright 2017 Networking Inc - All Rights Reserved
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="social-list align-right">
                        <div class="soc-item">
                            <a href="#">
                                <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social" media-simple="true"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://www.facebook.com/pages/Mobirise/1616226671953247" >
                                <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social" media-simple="true"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#">
                                <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social" media-simple="true"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#">
                                <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social" media-simple="true"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#">
                                <span class="socicon-googleplus socicon mbr-iconfont mbr-iconfont-social" media-simple="true"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="https://www.behance.net/Mobirise" target="_blank">
                                <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social" media-simple="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>
  <script src="assets/theme/js/script.js"></script>
    <script src="lib/jquery.imgareaselect.js"></script>

  <script>
function getL(url) {
    $('#main').load(url)
}
              function setform(form,datas) {
$(document).ready(function(){
      $(form).on('submit', function(e){
        e.preventDefault();
        var form = e.target;
        var data = new FormData(form);
        $.ajax({
          url: form.action,
          method: form.method,
          processData: false,
          contentType: false,
          data: data,
          processData: false,
          success: function(data){
         $( datas ).html( data );
             }
        })
      })
    })
}

</script>
  
</body>
</html>