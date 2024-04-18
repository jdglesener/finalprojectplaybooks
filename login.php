<?php
include "conn_config.php";

if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"]) {
  echo "<script>window.location.href = 'playbooks.php' </script>";  
}
if($_SERVER["REQUEST_METHOD"]== "POST"){
  $n_username = $_POST["username"];
  $n_password = $_POST["password"];
  $query = "SELECT * FROM users WHERE username = '$n_username' AND password = '$n_password'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 1) {
    $msg= "Welcome '$n_accountname'"; 
    setcookie("loggedin", true, time() + (86400), "/");
    setcookie("userid", $n_username, time() + (86400), "/");
    echo "<script>alert('$msg');</script>"; 
    echo "<script>window.location.href = 'playbooks.php' </script>";  
  } else {
    $msg = "The entered username or password is incorrect";
  }
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
  * Student Name: Jordan Glesener
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
  <div class="container col-x`l-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Welcome Back</h1>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $msg; ?>
        </div>
      <?php } ?>
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method = "POST" process="login.php">
          <div class="form-floating mb-3">
            <input name = "username" class="form-control" id="floatingInput" placeholder="...">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input name = "password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Log In</button>
          <hr class="my-4">
          <small class="text-body-secondary">Don't have an account? <a href="sign-up.php">Make An Team Here</a></small>
        </form>
      </div>
    </div>
  </div>
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