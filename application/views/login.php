<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login | e-Inventory | Bayt Al-Hikmah</title>
    <base href="<?php echo base_url() ?>">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="assets/media/logo.png"/>
    <link rel="bookmark" href="assets/media/logo.png"/>
    <link rel="icon" href="assets/media/logo.png"/>
    <!-- site css -->
    <link rel="stylesheet" href="assets/dist/css/site.css">
    <link rel="stylesheet" href="assets/dist/css/site.min.css">
    <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
     <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="assets/dist/js/site.min.js"></script>
    
  </head>
  <body style="background: #d2d6de;">
    <div class="login-logo">
      <center>
        <img src="assets/media/logo.png" class="img-logo">
        <br/>
        <b>e-Inventory</b>
        <br/>
        BAYT AL-HIKMAH
      </center>
    </div>
    <div class="container">
      <form class="form-signin" style="background-color: #fff;" role="form" action="app/login" method="post">
        <center><h6>Silahkan Login untuk Masuk</h6></center>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="glyphicon glyphicon-user"></i>
            </div>
            <input type="text" style="background-color: #fff; color: #333" class="form-control" name="niy" id="niy" placeholder="NIY" autocomplete="off" autofocus />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-lock "></i>
            </div>
            <input type="password" style="background-color: #fff; color: #333" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
          </div>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
        <br>
      </form>

    </div>
    <div class="clearfix">
    </br>
     <center><p>BAYT AL-HIKMAH © 2021 </p></center>
    </div>
    <br><br>
    <!--footer-->
    <!-- <div class="site-footer login-footer">
      <div class="container">
        <div class="copyright clearfix text-center">
          <p><b>Bootflat</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="getting-started.html">Getting Started</a>&nbsp;&bull;&nbsp;<a href="index.html">Documentation</a>&nbsp;&bull;&nbsp;<a href="https://github.com/Bootflat/Bootflat.UI.Kit.PSD/archive/master.zip">Free PSD</a>&nbsp;&bull;&nbsp;<a href="colors.html">Color Picker</a></p>
          <p>Code licensed under <a href="http://opensource.org/licenses/mit-license.html" target="_blank" rel="external nofollow">MIT License</a>, documentation under <a href="http://creativecommons.org/licenses/by/3.0/" rel="external nofollow">CC BY 3.0</a>.</p>
        </div>
      </div>
    </div> -->
  </body>
</html>
