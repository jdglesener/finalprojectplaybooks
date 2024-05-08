<?php
include "conn_config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);

error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Full Stack Final</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/course_logo.png" rel="icon">
  <link href="assets/img/course_logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/external_css.css" rel="stylesheet">

  <!-- =======================================================
  * Student Name: 
  * Date: March 6 2024 
  * Bootstrap Version: v5.3.2
  * Bootstrap Author: BootstrapMade.com
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- Uncomment below if you prefer to use text as a logo -->
      <h1 class="logo"><a href="index.php">Football Playbook</a></h1>


    </div>
  </header><!-- End Header -->


  <main id="main">    
    <!-- ======= About Section ======= -->
    <br>

    <section id="about" class="about">
    <div class="px-4 py-3 mt-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">Play Calculator</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Given the following situation, we can tell you what play would be best to run in the scenario.</p>
    </div>
    </div>
      <div class="d-flex justify-content-sm-center"> 
        <form action="model.php" method="POST">
            <div class = "d-flex gap-3 mb-3">
            <div class="form-floating mb-3">
                <input name = "yardline" type="text" class="form-control" id="floatingTimeYL" placeholder="Password" required>
                <label for="floatingTimeR">Yardline</label>
            </div>
            <div class="form-floating mb-3">
                <input name = "down" type="text" class="form-control" id="floatingTimedown" placeholder="Password" required>
                <label for="floatingTimedown">Down</label>
            </div>
            <div class="form-floating mb-3">
                <input name = "halftime" type="text" class="form-control" id="floatingTimeR" placeholder="Password" required>
                <label for="floatingTimeR">Half Seconds Remaining</label>
            </div>
            
            <div class="form-floating mb-3">
                <input name = "quarter" type="text" class="form-control" id="floatingTimeQtr" placeholder="Password" required>
                <label for="floatingTimeQtr">Quarter</label>
            </div>
            </div>
            <div class = "d-flex gap-3 mb-3">
            <div class="form-floating mb-3">
                <input name = "ytg" type="text" class="form-control" id="floatingTimeytg" placeholder="Password" required>
                <label for="floatingTimeytg">Yards to Gain</label>
            </div>
            <div class="form-floating mb-3">
                <input name = "score" type="text" class="form-control" id="floatingTimescore" placeholder="Password" required>
                <label for="floatingTimescore">Score Differential</label>
            </div>
            <div class="form-floating mb-3">
                <input name = "otr" type="text" class="form-control" id="floatingTimeotr" placeholder="Password" required>
                <label for="floatingTimeotr">Pos Timeouts Remaining</label>
            </div>
            <div class="form-floating mb-3">
                <input name = "dtr" type="text" class="form-control" id="floatingTimedtr" placeholder="Password" required>
                <label for="floatingTimedtr">Def Timeouts Remaining</label>
            </div>
            </div>
            <div class="justify-content-sm-center text-center">
                <button class="btn-primary" type="submit"><span>Submit for Calculation</span></button>
            </div>
        </form>
  </div>
      
    </section><!-- End About Section -->
    <div class="justify-content-sm-center text-center">
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $yardline = $_POST["yardline"];
            $down = $_POST["down"];
            $halftime = $_POST["halftime"];
            $quarter = $_POST["quarter"];
            $ytg = $_POST["ytg"];
            $score = $_POST["score"];
            $otr = $_POST["otr"];
            $dtr = $_POST["dtr"];
            $command = '/usr/local/bin/python3 test.py '.$yardline." ".$down." ".$halftime." ".$quarter." ".$ytg." ".$score." ".$otr." ".$dtr;
            $output = shell_exec($command);
            echo $output;
    ?>
    </div>
    <?php 
        }
    ?>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="fixed-bottom">

    <div class="container py-4">
      <div class="copyright">
        &copy;  <strong><span>CS299 Final</span></strong>. 
      </div>
      <div class="credits">
       
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>