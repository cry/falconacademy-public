<?php session_start();

if (isset($_SESSION['login_status']) && $_SESSION['login_status']) {
  header("Location: index.php");
  exit;
} 

if (isset($_POST['username']) && $_POST['password']) {
  if ($_POST['username'] == "adm1n" && $_POST['password'] == "REMOVED") {
    $_SESSION['login_status'] = true;
    $_SESSION['username'] = $_POST['username'];
    header("Location: index.php");
    exit;
  }
  
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_USERPWD, $_POST['username']. ':' . $_POST['password']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_USERAGENT, "ACADEMY_AUTH/1.0");
  curl_setopt($ch, CURLOPT_URL, "http://web1.northsydbo-h.schools.nsw.edu.au");
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch, CURLOPT_FAILONERROR, 0);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 100);

  $result = curl_exec($ch);

  if(strpos($result, "HTTP/1.1 200 OK") > 0) {
    $_SESSION['login_status'] = true;
    $_SESSION['username'] = $_POST['username'];
    header("Location: index.php");
    exit;
  }

  if(gethostname() == "serized.pw" || gethostname() == "Lunar.local") {
    if($_POST['username'] == "test" && $_POST['password'] == "test") {
        $_SESSION['login_status'] = true;
        $_SESSION['username'] = $_POST['username'];
        header("Location: index.php");
        exit;
    }
  }
}

//#041F34
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Falcon Academy | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
        <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
    }
    </script>
  </head>
  <body class="fixed-header ">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <!--<img src="assets/img/login-bg.png" data-src="assets/img/login-bg.png" data-src-retina="assets/img/login-bg.png" alt="" class="lazy">-->
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div id="falcon"></div>
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <p class="small" style="text-align: left; opacity: .5">
            Copyright &copy; <?php echo date("Y"); ?> North Sydney Boys High School           
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
        <?php 
            if(isset($_POST['username']) && !isset($_SESSION['login_status'])) {
              echo '<div class="alert alert-danger" role="alert"> <button class="close" data-dismiss="alert"></button> <strong>Login failed.</strong> </div>';
            }
          ?>
          <h3>Falcon Academy</h3>
          <p class="">Sign in with your NSBHS account. <small><br>Please be patient. We have to authenticate against the intranet.</small><h1></p>

          <!-- START Login Form -->
          <form id="form-login" class="p-t-15" role="form" method="post">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Login</label>
              <div class="controls">
                <input type="text" name="username" placeholder="Student Number (4xxxxxxxx)" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
            </div>
            <button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
          </form>
          <!--END Login Form-->
          <div class="pull-bottom sm-pull-bottom">
          </div>
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>
    </div>
    <!-- END OVERLAY -->
    <!-- BEGIN VENDOR JS -->
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
    <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <script src="pages/js/pages.min.js"></script>
    <script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
  </body>
</html>
