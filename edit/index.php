<?php session_start();

  if ($_SESSION['username'] !== "adm1n") {
    exit;
  }

  if(!isset($_SESSION['login_status']) || !$_SESSION['login_status']) {
    header("Location: ../login.php");
    exit;
  }

  # Gather subject & video data

  if (file_exists("../403/data.json")) $data = json_decode(file_get_contents("../403/data.json"), true);

?>
<!--Alson sucks.-->
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Falcon Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="../assets/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="../assets/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="../assets/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="../assets/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="../assets/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="Falcon Academy"/>
    <meta name="msapplication-TileColor" content="#00192a" />
    <meta name="msapplication-TileImage" content="../assets/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="../assets/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="../assets/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="../assets/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="../assets/favicon/mstile-310x310.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="../pages/css/pages.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/plugins/fancybox/source/jquery.fancybox.css">
    <!--[if lte IE 9]>
  <link href="../assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
  <![endif]-->
  </head>
  <body class="fixed-header ">
    <!-- BEGIN SIDEBPANEL-->
        <nav class="page-sidebar" data-pages="sidebar">
      <!-- START SIDEBAR MENU -->
      <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </nav>

    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
      <!-- START HEADER -->
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <div id="watermark"></div>
        <!-- START PAGE CONTENT -->
        <div class="content " style="padding-top: 0px;">
          <!-- START JUMBOTRON -->
          <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
              <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                  <li>
                    <a href=".">Falcon Academy</a>
                  </li>
                  <li><small>Admin                  </small>
                  </li>
                  <li style="float: right;text-align: right;"><a href="../logout.php">Logout</a></li>
                </ul>
                <!-- END BREADCRUMB -->
              </div>
            </div>
          </div>
          <!-- END JUMBOTRON -->
          <!-- START CONTAINER FLUID -->
          <div class="container-fluid container-fixed-lg">

            <script src="codemirror/lib/codemirror.js"></script>
            <!--<script src="codemirror/mode/"></script>-->
            <link rel="stylesheet" href="codemirror/lib/codemirror.css">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
              <h3>Subject Config Edit</h3> <p>current epoch time: <?php echo time() ?></p> <br>
              <div id="editor" style="width: 100%; height: auto; border: 1px solid"></div> <br><br>

              <button onclick="save()" class="btn btn-default">Save and pray</button>

              <script>
                var editor = CodeMirror(document.getElementById("editor"), {
                  value: atob("<?php echo base64_encode(file_get_contents("data.conf")) ?>")
                });

                editor.setSize(document.getElementById("editor").clientWidth, 1000);

                var save = function() {
                  try {
                    var data = editor.getValue();

                    $.post( "save.php", {'json': data}, function( data ) {
                      alert(data);
                    });
                  } catch (err) {
                    alert("JSON Invalid: \n" + err);
                  }

                }

              </script>
            <!-- END PLACE PAGE CONTENT HERE -->
          </div>
          <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright &copy; 2016 </span>
              <span class="font-montserrat">North Sydney Boys High School</span>.
              <span class="hint-text">All rights reserved. </span>
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    </div>
    <!-- BEGIN VENDOR JS -->
    <script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-bez/jquery.bez.min.js"></script>
    <script src="../assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap-select2/select2.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/classie/classie.js"></script>
    <script src="../assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/fancybox/source/jquery.fancybox.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../pages/js/pages.min.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>
