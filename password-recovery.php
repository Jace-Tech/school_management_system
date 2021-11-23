<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Password Recevery | Kiaalap - Kiaalap Admin Template</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">
  <link rel="stylesheet" href="css/owl.transitions.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="css/normalize.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="css/main.css">
  <!-- morrisjs CSS
		============================================ -->
  <link rel="stylesheet" href="css/morrisjs/morris.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- metisMenu CSS
		============================================ -->
  <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
  <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
  <!-- calendar CSS
		============================================ -->
  <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
  <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
  <!-- forms CSS
		============================================ -->
  <link rel="stylesheet" href="css/form/all-type-forms.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="css/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  <script src="js/sweetalert.min.js"></script>
</head>

<body>
  <?php include("./components/alert2.php"); ?>
  <div class="error-pagewrap">
    <div class="error-page-int">
      <div class="text-center ps-recovered">
        <h3>PASSWORD RECOVER</h3>
      </div>
      <div class="content-error">
        <div class="hpanel">
          <div class="panel-body poss-recover">

            <?php if (isset($_GET["pin_verify"])) : ?>
              <form action="./handlers/password.php" method="post" id="loginForm">
                <div class="form-group">
                  <input type="text" placeholder="pin" title="Please enter pin" required="" name="pin" class="form-control">
                  <!-- <input type="hidden" name="id" value="<?php //echo $_SESSION["pass_id"]; 
                                                              ?>"> -->
                </div>

                <button type="submit" name="verify" class="btn btn-success btn-block">Verify</button>
                <p style="text-align:center;">
                  <a style="background-color:transparent; color: #555;" href="./handlers/password.php?cancel"><i class="fa fa-arrow-left"></i> Back</a>
                </p>
              </form>

            <?php elseif (isset($_GET["recovery"])) : ?>
              <?php
              session_start();
              if (!isset($_SESSION["pass_id"])) header("location: password-recovery.php");
              ?>
              <form action="./handlers/password.php" method="post" id="loginForm">
                <div class="form-group">
                  <input type="password" id="p1" placeholder="New password" required="" name="password1" class="form-control">
                  <input type="password" id="p2" placeholder="Confirm password" required="" name="password2" class="form-control">
                  <span class="help-block small"></span>
                </div>

                <button type="submit" name="change" class="btn btn-success btn-block">Reset password</button>
                <p style="text-align:center;">
                  <a style="background-color:transparent; color: #555;" href="./handlers/password.php?cancel"><i class="fa fa-arrow-left"></i> Back</a>
                </p>
              </form>
              <script>
                const check = document.querySelector("#p2");
                check.addEventListener("blur", () => {
                  const value = document.querySelector("#p1").value;
                  if (check.value != value) {
                    document.querySelector(".help-block").innerText = "passwords do not match";
                    document.querySelector("button").disabled = true;
                    document.querySelector(".help-block").style.color = "red";
                  } else {
                    document.querySelector(".help-block").innerText = "";
                    document.querySelector("button").disabled = false;
                  }
                })
              </script>

            <?php else : ?>
              <?php
              session_start();
              if (isset($_SESSION["pass_id"])) {
                header("location: password-recovery.php?pin_verify");
              }
              ?>
              <form action="./handlers/password.php" method="post" id="loginForm">
                <div class="form-group">
                  <label class="control-label" for="username">Email</label>
                  <input type="text" placeholder="example@gmail.com" title="Please enter you email adress" required="" name="email" class="form-control">
                  <span class="help-block small">Your registered email address</span>
                </div>

                <button type="submit" name="submit" class="btn btn-success btn-block">Reset password</button>
                <p style="text-align:center;">
                  <a style="background-color:transparent; color: #555;" href="index.php"><i class="fa fa-arrow-left"></i> Back</a>
                </p>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="text-center login-footer">
        <p>Copyright © <?php echo date("Y"); ?>. All rights reserved.</p>
      </div>
    </div>
  </div>
  <!-- jquery
		============================================ -->
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="js/bootstrap.min.js"></script>
  <!-- wow JS
		============================================ -->
  <script src="js/wow.min.js"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="js/jquery-price-slider.js"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="js/jquery.meanmenu.js"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- sticky JS
		============================================ -->
  <script src="js/jquery.sticky.js"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="js/jquery.scrollUp.min.js"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
  <!-- metisMenu JS
		============================================ -->
  <script src="js/metisMenu/metisMenu.min.js"></script>
  <script src="js/metisMenu/metisMenu-active.js"></script>
  <!-- tab JS
		============================================ -->
  <script src="js/tab.js"></script>
  <!-- icheck JS
		============================================ -->
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/icheck/icheck-active.js"></script>
  <!-- plugins JS
		============================================ -->
  <script src="js/plugins.js"></script>
  <!-- main JS
		============================================ -->
  <script src="js/main.js"></script>
  <!-- tawk chat JS
		============================================ -->
  <script src="js/tawk-chat.js"></script>
</body>

</html>