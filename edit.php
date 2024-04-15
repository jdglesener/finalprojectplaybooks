<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
include 'conn_config.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $n_publication =$_POST["pub_year"];
    $n_authors =$_POST["authors"];
    $n_id =$_POST["id"];
    $query ="UPDATE articles a SET a.publication_year='$n_publication', a.authors='$n_authors' WHERE a.articleID='$n_id'";
    $exe = mysqli_query($conn, $query);
}
else{
    $msg= "You need to change the value to make an update"; 
}
if(isset($exe)){
    $msg= "The update was successfull"; 
    echo "<script>alert('$msg');</script>"; 
    echo "<script>window.location.href = 'index.php'</script>";  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Full Stack Project</title>
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
  * Student Name: Jordan Glesener
  * Date: March 6 2024 
  * Bootstrap Version: v5.3.2
  * Bootstrap Author: BootstrapMade.com
  ======================================================== -->
</head>

<body>
    <header>
    <?php 
/* if(isset($msg)){
    echo "<span style='font_color: green;'> $msg </span>"; 
    echo "<a href='index.php'> Home page </a>";
} */
if(isset($_REQUEST['eid'])){
    $id = $_GET['eid'];
    $query = "SELECT * FROM articles WHERE articleID LIKE '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        foreach($result as $row) {    
    

?>
    <form action="edit.php" method="POST" >
          <div class="form-inline">
            <p><span> Year:</span>
                <input type="text" name="pub_year" value="<?php  echo $row["publication_year"];?>"> 
                <input type="hidden" name="hidden_pub_year" value="<?php  echo $row["publication_year"];?>">
                <span>Authors:</span>              
               <input type="text"  value="<?php  echo $row["authors"];?>" name='authors'>
               <input type="hidden"  value="<?php  echo $row["authors"];?>" name='hidden_authors'>
               <input type="hidden"  value="<?php  echo $id;?>" name='id'>
                <button type="submit" class="btn-primary">Update</button>
                </div>
                </form>
              <?php    
                  }
                }
}
            ?>
            <p>
    </header>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>

</html>