<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
  exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
  $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();
  $profile_image = $user['image']; // Assuming this is the URL to the profile image

} catch (PDOException $error) {
  echo $error->getMessage() . '';
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Hunter</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/categories.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="css/swiper-bundle.min.css" />

</head>

<body>
  <?php require_once 'nav.php' ?>
  <section class="overlay"></section>

  <Section class="main">
    <div class="container">
      <div class="search-box">
        <i class="bx bx-search"></i>
        <input type="text" placeholder="search">
      </div>
      <div class="images">
        <div class="image-box" data-name="beaches">
          <img src="../Places/boracay/Bat Cave.png" alt="">
          <h6>Bat Cave</h6>
        </div>
        <div class="image-box" data-name="beaches">
          <img src="../Places/boracay/Crocodile Island .png" alt="">
          <h6>Crocodile Island</h6>
        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/boracay/Mount luho.png" alt="">
          <h6>Mount Luho</h6>
        </div>
        <div class="image-box" data-name="beaches">
          <img src="../Places/boracay/Puka shell.png" alt="">
          <h6><a href="categories.php" class="nav-link">Puka Shell</h6>

        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/region3/Baguio.png" alt="">
          <h6><a href="categories.php" class="nav-link">Baguio</h6>

        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/region3/Banaue.png" alt="">
          <h6><a href="categories.php" class="nav-link">Banaue</h6>

        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/region3/Kalinga.png" alt="">
          <h6><a href="categories.php" class="nav-link">Kalinga</h6>

        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/region3/Mount Pulag.png" alt="">
          <h6><a href="categories.php" class="nav-link">Mount Pulag</h6>

        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/region3/Sagada.png" alt="">
          <h6><a href="categories.php" class="nav-link">Sagada</h6>

        </div>
        <div class="image-box" data-name="rivers">
          <img src="../Places/Region1/Blue Lagoon.png" alt="">
          <h6><a href="categories.php" class="nav-link">Blue Lagoon</h6>

        </div>
        <div class="image-box" data-name="mountain">
          <img src="../Places/Region1/Calle Crisologo.png" alt="">
          <h6><a href="categories.php" class="nav-link">Calle Crisologo</h6>

        </div>
        <div class="image-box" data-name="beaches">
          <img src="../Places/Region1/Hundred Islands.png" alt="">
          <h6><a href="categories.php" class="nav-link">Hundred Islands</h6>

        </div>
        <div class="image-box" data-name="beaches">
          <img src="../Places/Region1/Kapurpurawan.png" alt="">
          <h6><a href="categories.php" class="nav-link">Kapurpurawan</h6>

        </div>
        <div class="image-box" data-name="beaches">
          <img src="../Places/Region1/Patapat.png" alt="">
          <h6><a href="categories.php" class="nav-link">Patapat</h6>

        </div>
        <div class="image-box" data-name="adventure">
          <img src="../Places/Region1/Sand dunes.png" alt="">
          <h6><a href="categories.php" class="nav-link">Sand Dunes</h6>

        </div>
        <div class="image-box" data-name="falls">
          <img src="../Places/Region1/Tangadan falls.png" alt="">
          <h6><a href="categories.php" class="nav-link">Tangadan Falls</h6>

        </div>
        <div class="image-box" data-name="beaches">
          <img src="../Places/region2/Callao.png" alt="">
          <h6><a href="categories.php" class="nav-link">Callao</h6>

        </div>
        <div class="image-box" data-name="caves">
          <img src="../Places/region2/Capisaan.png" alt="">
          <h6><a href="categories.php" class="nav-link">Capisaan</h6>

        </div>


      </div>
    </div>
  </Section>

  <script src="../js/home.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/categories.js" defer></script>
</body>

</html>