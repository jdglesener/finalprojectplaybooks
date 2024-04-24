<?php
include "conn_config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);

error_reporting(E_ALL);
if (!isset($_COOKIE["loggedin"]) || !$_COOKIE["loggedin"]) {
  $msg = "Please sign in to view a playbook";
  echo "<script>alert('$msg');</script>"; 
  echo "<script>window.location.href = 'index.php' </script>";  
}
$uid = $_COOKIE["userid"];
$query = "SELECT * FROM users WHERE username = '$uid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$teamid = $row["teamid"];
$iscoach = $row["coach"]; 
if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["playname"]) && isset($_POST["yards"])){
  $n_playname = $_POST["playname"];
  $n_playtype =$_POST["playtype"];
  $n_personnel =$_POST["personnel"];
  $n_playbookid = $_POST["playbookid"];
  $n_playbookname = $_POST["playbookname"];
  $n_yards =$_POST["yards"];
  $query = "INSERT INTO `Playlist` (`playid`, `play_type`, `personnel`, `yards_goal`, `playname`) VALUES (NULL, '$n_playtype', '$n_personnel', '$n_yards', '$n_playname');";
  $exe = mysqli_query($conn, $query);
  $query = "SELECT playid FROM Playlist WHERE playname = '$n_playname'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $val = $row['playid'];
  $query = "INSERT INTO `Playbook` (`playid`, `teamid`, `playbookid`, `playbookname`, `playname`) VALUES ('$val', '$teamid', '$n_playbookid', '$n_playbookname', '$n_playname');";
  $result = mysqli_query($conn, $query);
}

if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["newplaybookname"])){
  $n_playbookname = $_POST["newplaybookname"];
  $n_playbookid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT playbookid + 1 AS new FROM `Playbook` ORDER BY playbookid DESC LIMIT 1;"))["new"];
  $query = "INSERT INTO `Playbook` (`playid`, `teamid`, `playbookid`, `playbookname`, `playname`) VALUES (1, '$teamid', '$n_playbookid', '$n_playbookname', 'Dive Right');";
  $result = mysqli_query($conn, $query);

}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delid"])){
  $delid = $_POST['delid'];   
  $pid = $_POST['playbookid'];
  $sql=mysqli_query($conn,"DELETE FROM playbook where playname='$delid' AND playbookid = '$pid' AND teamid=$teamid");
  echo "<script>alert('Play Deleted');</script>";
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delplaybookid"])){
    $delplaybookid = $_POST['delplaybookid'];
    $delplaybook = $_POST['delplaybook'];  
    $sql=mysqli_query($conn,"DELETE FROM playbook where playbookname='$delplaybookid' AND teamid='$teamid' AND playbookid='$delplaybook'");
    echo "<script>alert('Playbook Deleted');</script>";
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
  <header id="header" class="sticky-top">
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
    <h1 class="display-5 fw-bold text-body-emphasis">Your Playbooks</h1>
</div>
    </div>
  </div>
  <div class="px-4 py-5 my-5 text-left">
  <h3>List of Your Playbooks</h3>

      
  <?php 
            $query = "SELECT pl.playbookname, pl.playbookid FROM users u
            JOIN team t ON u.teamid = t.teamid
            JOIN playbook pl ON pl.teamid = t.teamid
            WHERE u.username = '$uid'
            GROUP BY pl.playbookname, pl.playbookid;";
            $result = mysqli_query($conn, $query);
            if ($result) {
                ?>
  <div class="accordion">

        <?php
              $i = 1;
              foreach($result as $row3) {
      ?>
      <div class="accordion-item">

            <div class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target=<?php echo "#collapse-".$i ?> aria-expanded="true" aria-controls="collapseOne">
            <h4 class="title"><?php echo $row3["playbookname"]?></h4>
            </button>
              
            </div>
            <div id=<?php echo "collapse-".$i ?> class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <div class="table-responsive small">
        
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Play Name</th>
                <th scope="col">Play Type</th>
                <th scope="col">Personnel</th>
                <th scope="col">Est. Yards</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $pb = $row3["playbookname"];
              $pi = $row3["playbookid"];
              $query1 = "SELECT * FROM users u
              JOIN team t ON u.teamid = t.teamid
              JOIN playbook pl ON pl.teamid = t.teamid
              JOIN Playlist pt ON pl.playid = pt.playid
              WHERE t.teamid = $teamid AND pl.playbookname = '$pb' AND username = '$uid'";
              $result1 = mysqli_query($conn, $query1);
              if ($result1) {
                $j = 1;
                foreach($result1 as $row1) {
              ?>
              <tr>
                <td><?php echo $j ?></td>
                <td><?php echo $row1["playname"] ?></td>
                <td><?php echo $row1["play_type"] ?></td>
                <td><?php echo $row1["personnel"] ?></td>
                <td><?php echo $row1["yards_goal"] ?></td>
                <?php
            if ($iscoach == 1) {
          ?>
                <td><form action="playbooks.php" method = "POST">
                  <input type="hidden" name = "delid" value = "<?php echo $row1["playname"];?>">
                  <input type="hidden" name = "playbookid" value = "<?php echo $pi;?>">
                  <button type="submit" class="btn btn-secondary">Delete</button>
                </form></td>
          <?php } ?>
              </tr>
              <?php 
                $j++;
                }
              
              ?>
            </tbody>
          </table>
          <?php
            if ($iscoach == 1) {
          ?>
          <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add A Play
            </button>
            <form action="playbooks.php" method = "POST">
              <input type="hidden" name="delplaybookid" value="<?php echo $pb;?>">
              <input type="hidden" name="delplaybook" value="<?php echo $pi?>">
              <button type="submit" class="btn btn-primary" data-bs-toggle="modal">
                Delete This Playbook
              </button>
            </form>
          </div>
          <?php } ?>
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a Play</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method = "POST" process="playbooks.php">
                  <div class="mb-3">
                    <h2>Play Name</h2>
                    <input name = "playname" class="form-control" placeholder="...">
                  </div>
                  <div class="mb-3">
                    <h2>Play Type</h2>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="playtype" value="Run">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Run
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="playtype" value="Pass">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Pass
                      </label>
                    </div>
                  </div>
                  <div class="mb-3">
                    <h2>Personnel</h2>
                    <input name = "personnel" class="form-control" placeholder="...">
                  </div>
                  <div class="mb-3">
                    <h2>Est. Yards</h2>
                    <input name = "yards" class="form-control" placeholder="...">
                    <input type="hidden" name = "playbookid" value = "<?php echo $pi;?>">
                    <input type="hidden" name = "playbookname" value = "<?php echo $pb;?>">
                  </div>
                </div>
                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add To Playbook</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <?php
              }
            ?>
      </div>
            </div>
            </div>
            <?php
             $i++;
              }
            }
            ?>
          </div>
        </div>
      </div>
      </div>
      <br>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#playbookStatic">
              Add A Playbook
      </button>
      <div class="modal fade" id="playbookStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add a Playbook</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method = "POST" process="playbooks.php">
                  <div class="mb-3">
                    <h2>Playbook Name</h2>
                    <input name = "newplaybookname" class="form-control" placeholder="">
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Playbook</button>
                </form>
                </div>
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
  <script src="js/jquery-3.5.1.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>