<?php
include "conn_config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if (isset($_GET['delid'])){
  $delid=$_GET['delid'];
  $sql=mysqli_query($conn,"DELETE FROM articles where articleID ='$delid'");
  echo "<script>alert('Item Deleted');</script>";
  echo "<script>eindow.location.href = 'index.php'</script>";
}
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
  <link href="assets/img/football_logo.png" rel="icon">
  <link href="assets/img/football_logo.png" rel="apple-touch-icon">

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

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#about">My Playbooks</a></li>
          <li class="dropdown"><a href="#"><span>Your Profile</span><i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="team.php">My Team</a></li>
              <li><a href="profile.php">Settings</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <main id="main">    
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
    <div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">Your Playbooks</h1>
</div>
    </div>
  </div>
      <div class="container">

        <div class="row">
          <div class="col-xl-12 col-lg-12 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>List of Your Playbooks</h3>
            <!--
              * WRITE PHP MYSQL CODE THAT QUERY THE DATABASE AND DISPLAY EACH RECORD BELOW. 
              * TURN EACH OF THIS DIV TO A BLOCK THAT DISPLAY EACH RECORD FROM THE RESULT OF THE QUERY --->
              <?php 

            $query = "SELECT pl.playbookname FROM users u
            JOIN team t ON u.teamid = t.teamid
            JOIN playbook pl ON pl.teamid = t.teamid
            WHERE u.userid = 1
            GROUP BY pl.playbookname;";
            $result = mysqli_query($conn, $query);
            if ($result) {
              $i = 1;
              foreach($result as $row) {
            ?>
            <div class="icon-box">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href=""><?php echo $row["playbookname"] ?></a></h4>
            </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
              
      </div>
    </section><!-- End About Section -->
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

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