<?php
include "conn_config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if($_SERVER["REQUEST_METHOD"]== "POST"){
  $n_id = $_POST["userid"];
  $n_pw = $_POST["pw"];
  $n_accountname = $_POST["acctnm"];
  $n_teamname = $_POST["tmnm"];
  $query = "SELECT * FROM users WHERE username = '$n_id'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0) {
    $query = "SELECT * FROM team WHERE teamname = '$n_teamname'";
    $result = mysqli_query($conn, $query);
    if(isset($_REQUEST['teamid']) && (!isset($_REQUEST['coach']) || !$_REQUEST['coach'])) {
      echo "eval1";
      $val = $_REQUEST['teamid'];
      $coach = 0;
      $query = "INSERT INTO `Users` (`userid`, `username`, `password`, `name`, `coach`, `teamid`) VALUES (NULL, '$n_id', '$n_pw', '$n_accountname', '$coach', '$val');";
      $exe = mysqli_query($conn, $query);
    } else if (isset($_GET['coach']) && $_GET['coach'] == 'true') {
      echo "eval2";
      $val = $_REQUEST['teamid'];
      $coach = 1;
      $query = "INSERT INTO `Users` (`userid`, `username`, `password`, `name`, `coach`, `teamid`) VALUES (NULL, '$n_id', '$n_pw', '$n_accountname', '$coach', '$val');";
      $exe = mysqli_query($conn, $query);
    } else if(mysqli_num_rows($result) == 0) {
      echo "eval3";
      $query = "INSERT INTO `Team` (`teamid`, `teamname`) VALUES (NULL, '$n_teamname');";
      $exe = mysqli_query($conn, $query);
      $query = "SELECT teamid FROM team WHERE teamname = '$n_teamname'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $val = $row['teamid'];
      $coach = 1;
      $query = "INSERT INTO `Users` (`userid`, `username`, `password`, `name`, `coach`, `teamid`) VALUES (NULL, '$n_id', '$n_pw', '$n_accountname', '$coach', '$val');";
      $exe = mysqli_query($conn, $query);
    } else {
      $msg = "This team already exists";
    }
  } else {
    $msg = "This username already exists";
  }
  if(isset($exe)){
    setcookie("loggedin", true, time() + (86400 * 30), "/");
    setcookie("userid", $n_id, time() + (86400 * 30), "/");
    $msg= "Thanks for creating a team, '$n_accountname'"; 
    echo "<script>alert('$msg');</script>"; 
    #echo "<script>window.location.href = 'playbooks.php?userid=".$n_id."' </script>";  
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
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Sign Up Now</h1>
        <p class="col-lg-10 fs-4">Create and share simplified playbooks that can help your team get on the same page. Invite your players so that you can set your gameplan. Create multiple playbooks for different scouts and share different plays with different team groups. Create each team only once.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-warning" role="alert">
          <?php echo $msg; ?>
        </div>
      <?php } 
      ?>

          <?php if (isset($_REQUEST["teamid"]) && $_REQUEST["teamid"]) {
            $teamid = $_REQUEST['teamid'];
            if (isset($_REQUEST["coach"]) && $_REQUEST["coach"] == "true") {
              $coach = $_REQUEST["coach"];
              $action = "sign-up.php?coach=$coach&teamid=$teamid";
            } else {
              $action = "sign-up.php?teamid=$teamid";
            }
            ?>
            <h4><?php 
              $teamname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT teamname FROM `Team` WHERE teamid = $teamid;"))['teamname'];
              echo "Welcome to ".$teamname." Football";
              ?></h4>
              <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action = "<?php echo $action;?>" method = "POST">
              <input name = "tmnm" type='hidden' value="<?php echo $teamname?>">
          <?php } else {?>
          <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action = "sign-up.php" method = "POST">
          <div class="form-floating mb-3">
            <input name = "tmnm" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Team Name</label>
          </div>
          <?php }?>
          <div class="form-floating mb-3">
            <input name="userid" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input name = "pw" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-3">
            <input name = "acctnm" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Account Name</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
          <hr class="my-4">
          <small class="text-body-secondary">Already have an account? <a href="login.php">Log in Here</a></small>
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