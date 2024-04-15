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

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="playbooks.php">My Playbooks</a></li>
          <li class="dropdown"><a href="#"><!--<img src="#""> --><span>Your Profile</span><i class="bi bi-chevron-down"></i></a>
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
    <h1 class="display-5 fw-bold text-body-emphasis">Playbook designer</h1>
    <div class="col-lg-6 mx-auto">
      <?php # IF SIGNED IN, SHOW THESE BUTTONS?>
      <p class="lead mb-4">Create and share simplified playbooks that can help your team get on the same page. Invite your players so that you can set your gameplan. Create multiple playbooks for different scouts and share different plays with different team groups.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a class="btn btn-primary btn-lg px-4 gap-3" href="sign-up.php" role="button">Sign up</a>
        <a class="btn btn-outline-secondary btn-lg px-4" href="login.php" role="button">Log in</a>
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