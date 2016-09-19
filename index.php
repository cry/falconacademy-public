<?php session_start();

  if(!isset($_SESSION['login_status']) || !$_SESSION['login_status']) {
    header("Location: login.php");
    exit;
  }

  # Gather subject & video data

  if (file_exists("403/data.json")) $data = json_decode(file_get_contents("403/data.json"), true);

  echo "<!-- Served by ". gethostname() . "-->\n";
  echo "<!-- Developed by Carey Li. -->\n";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Falcon Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
  	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/favicon/apple-touch-icon-57x57.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/favicon/apple-touch-icon-114x114.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/favicon/apple-touch-icon-72x72.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/favicon/apple-touch-icon-144x144.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/favicon/apple-touch-icon-60x60.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/favicon/apple-touch-icon-120x120.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/favicon/apple-touch-icon-76x76.png" />
  	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/favicon/apple-touch-icon-152x152.png" />
  	<link rel="icon" type="image/png" href="assets/favicon/favicon-196x196.png" sizes="196x196" />
  	<link rel="icon" type="image/png" href="assets/favicon/favicon-96x96.png" sizes="96x96" />
  	<link rel="icon" type="image/png" href="assets/favicon/favicon-32x32.png" sizes="32x32" />
  	<link rel="icon" type="image/png" href="assets/favicon/favicon-16x16.png" sizes="16x16" />
  	<link rel="icon" type="image/png" href="assets/favicon/favicon-128.png" sizes="128x128" />
  	<meta name="application-name" content="Falcon Academy"/>
  	<meta name="msapplication-TileColor" content="#00192a" />
  	<meta name="msapplication-TileImage" content="assets/favicon/mstile-144x144.png" />
  	<meta name="msapplication-square70x70logo" content="assets/favicon/mstile-70x70.png" />
  	<meta name="msapplication-square150x150logo" content="assets/favicon/mstile-150x150.png" />
  	<meta name="msapplication-wide310x150logo" content="assets/favicon/mstile-310x150.png" />
  	<meta name="msapplication-square310x310logo" content="assets/favicon/mstile-310x310.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
      <!--[if lte IE 9]>
	       <link href="assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
	     <![endif]-->
  </head>
  <body class="fixed-header ">
    <nav class="page-sidebar" data-pages="sidebar">
      <div class="sidebar-menu">
          <ul class="menu-items">
            <?php require 'fragments/sidebar.fragment' ?>
          </ul>
        <div class="clearfix"></div>
      </div>
    </nav>
    <div class="page-container ">
      <div class="page-content-wrapper ">
        <div id="watermark"></div>
        <div class="content " style="padding-top: 0px;">
          <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
              <div class="inner">
                <ul class="breadcrumb">
                  <li>
                    <a href=".">Falcon Academy</a>
                  </li>
                  <li><small><?php if (!isset($_GET['page']) || $_GET['page'] == "")  { 
                                echo "<a href=\".\">Home</a>"; 
                              } else {
                                  if (!array_key_exists(ucfirst($_GET['subject']), $data)) {exit;}

                                  echo "<a href=\"?page=listing&subject=". $_GET['subject'] ."\">". $_GET['subject'] ."</a>";
                              } ?>
                  </small>
                  </li>
                  <li style="float: right;text-align: right;"><?php if ($_SESSION['username'] == "adm1n") {echo '<a href="edit/">Edit</a>'; } ?><a href="logout.php">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="container-fluid container-fixed-lg">
              <?php
                if (!isset($_GET['page']) || $_GET['page'] == "") {
                  require 'fragments/index.fragment';
                } else {
                  require 'fragments/' . $_GET['page'] . '.fragment';
                }
              ?>
          </div>
        </div>
        <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright &copy; 2016 </span>
              <span class="font-montserrat">North Sydney Boys High</span>.
              <span class="hint-text">All rights reserved. </span>
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    </div>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-78531044-1', 'auto');
      ga('send', 'pageview');

    </script>

    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-bez/jquery.bez.min.js"></script>
    <script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap-select2/select2.min.js"></script>
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
    <script src="assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/fancybox/source/jquery.fancybox.js"></script>
    <script src="pages/js/pages.min.js"></script>
    <script src="assets/js/scripts.js" type="text/javascript"></script>
  </body>
</html>
