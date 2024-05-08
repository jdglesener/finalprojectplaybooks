<?php
include "conn_config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);

error_reporting(E_ALL);

if (!isset($_COOKIE["loggedin"]) || !$_COOKIE["loggedin"]) {
  $msg = "Please sign in to view your team";
  echo "<script>alert('$msg');</script>"; 
  echo "<script>window.location.href = 'index.php' </script>";  
}

$uid = $_COOKIE["userid"];
$query = "SELECT * FROM Users WHERE username = '$uid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$teamid = $row["teamid"];
$iscoach = $row["coach"]; 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delid'])) {
  $delid = $_POST['delid'];   
  $sql=mysqli_query($conn,"DELETE FROM USERS where userid='$delid'AND teamid=$teamid");
  echo "<script>alert('User Deleted');</script>";
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
          <?php if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"]) {?>
          <li><a class="nav-link scrollto" href="playbooks.php">My Playbooks</a></li>
          <li class="dropdown"><a href="#"><span>Your Profile</span><i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="team.php">My Team</a></li>
              <li>
                <form action = "sign-out.php" method = "POST">
                  <button class = "btn btn-outline-secondary" type = "submit">Sign Out</button>
                </form>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <main id="main">    
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
    <div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">Your Team</h1>
</div>
    </div>
  </div>
      <div class="container">

        <div class="row">
          <div class="col-xl-12 col-lg-12 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>Your Team</h3>
              <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Role</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $query1 = "SELECT * FROM Users u
                WHERE u.teamid = $teamid";
                $result1 = mysqli_query($conn, $query1);
                if ($result1) {
                  $j = 1;
                  foreach($result1 as $row1) {
                    if ($uid != $row1['userid']) {
                ?>
                <tr>
                  <td><?php echo $j ?></td>
                  <td><?php echo $row1["name"] ?></td>
                  <td><?php if ($row1["coach"]) {echo "Coach";} else {echo "Player";}?> </td>
                  <?php
              if ($iscoach == 1) {}
            ?>
                  <td><form action="team.php" method = "POST">
                    <input type="hidden" name = "delid" value = "<?php echo $row1["userid"];?>">
                    <button type="submit" class="btn btn-secondary">Delete</button>
                  </form></td>
            <?php $j++; } 
          }
        }?>
                </tr>
                <?php 
                ?>
              </tbody>
            </table>
          </div>
        </div>
              
      </div>
      <div class = "col-xl-12 col-lg-12 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h4>Want to add a new Player or Coach?</h4>
            <h5>Use the link below for coaches</h5>
            
                <div class = "text-bg-secondary p-3">
                  <?php echo "http://localhost/finalproject/sign-up.php?coach=true&teamid=".$teamid?>
                </div>
            <h5>Use the link below for players</h5>
                <div class = "text-bg-secondary p-3">
                  <?php echo "http://localhost/finalproject/sign-up.php?teamid=".$teamid?>
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