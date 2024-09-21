<?php

session_start(); // Start the session
require_once '../connect/dbcon.php'; // Database connection

// Check if the user is already logged in
if (isset($_SESSION["UserName"])) {
  // Redirect to the home page if the user is already logged in
  header("Location: home.php");
  exit();
}

// Registration
if (isset($_POST["register"])) {
  $UserName = $_POST['regUserName'];
  $PassWord = $_POST['regPassWord'];
  $FullName = $_POST['regFullName'];

  // Check if password is at least 8 characters
  if (strlen($PassWord) < 8) {
    $_SESSION['error'] = "Password must be at least 8 characters long.";
    header("Location: register.php"); // Redirect back to the registration page
    exit();
  }

  // Proceed with password hashing and user registration
  $hashedPassWord = password_hash($PassWord, PASSWORD_DEFAULT);
  $defaultImage = '../uploads/default.jpg'; // Default profile image

  try {
    $pdoQuery = "INSERT INTO user (UserName, PassWord, FullName, image) VALUES (:UserName, :PassWord, :FullName, :image)";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoResult->execute([
      ":UserName" => $UserName,
      ":PassWord" => $hashedPassWord,
      ":FullName" => $FullName,
      ":image" => $defaultImage,
    ]);

    $_SESSION['success'] = "Successfully registered!";
    header("Location: index.php"); // Redirect to login after registration
    exit();
  } catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header("Location: register.php");
    exit();
  }
}


// Login
if (isset($_POST["login"])) {
  $username = trim($_POST["UserName"]);
  $password = trim($_POST["PassWord"]);

  if (empty($username) || empty($password)) {
    $_SESSION['error'] = "All fields are required!";
    header("Location: index.php"); // Redirect back to login if empty
    exit();
  } else {
    try {
      $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
      $pdoResult = $pdoConnect->prepare($pdoQuery);
      $pdoResult->execute(['UserName' => $username]);
      $user = $pdoResult->fetch();

      if ($user && password_verify($password, $user["PassWord"])) {
        $_SESSION["UserName"] = $user["UserName"];
        $_SESSION["UserRole"] = $user["UserRole"];
        $_SESSION["id"] = $user["id"];
        $_SESSION['success'] = "Login successful!";

        // Redirect based on role
        if ($_SESSION["UserRole"] == "admin") {
          header("Location: ../crud/index.php?id=" . $user["id"]);
        } elseif ($_SESSION["UserRole"] == "boracay") {
          header("Location: ../crud/boracayadmin.php?id=" . $user["id"]);
        } else {
          header("Location: home.php");
        }
        exit();
      } else {
        $_SESSION['error'] = "Invalid username or password";
        header("Location: index.php"); // Redirect back to login if wrong credentials
        exit();
      }
    } catch (PDOException $error) {
      $_SESSION['error'] = "Error: " . $error->getMessage();
      header("Location: index.php");
      exit();
    }
  }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Hunter</title>
  <link rel="stylesheet" href="../style/style1.css" />
  <!-- Unicons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
  <!-- Notifications -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="notification success">
      <p><?php echo $_SESSION['success'];
      unset($_SESSION['success']); ?></p>
    </div>
  <?php elseif (isset($_SESSION['error'])): ?>
    <div class="notification error">
      <p><?php echo $_SESSION['error'];
      unset($_SESSION['error']); ?></p>
    </div>
  <?php endif; ?>

  <!-- Header -->
  <header class="header">
    <nav class="nav">
      <a href="#" class="nav_logo">Travel Hunter</a>

      <button class="button" id="form-open">Login</button>
    </nav>
  </header>

  <!-- Home -->
  <section class="home">
    <div class="form_container">
      <i class="uil uil-times form_close"></i>
      <!-- Login From -->
      <div class="form login_form">
        <form method="POST">
          <h2>Login</h2>

          <div class="input_box">
            <input type="email" name="UserName" placeholder="Enter your username" required />
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" name="PassWord" placeholder="Enter your password" required />
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>

          <div class="option_field">
            <span class="checkbox">
              <input type="checkbox" id="check" />
              <label for="check">Remember me</label>
            </span>
            <a href="#" class="forgot_pw">Forgot password?</a>
          </div>

          <button class="button" type="submit" name="login" value="Login">Login Now</button>

          <div class="login_signup">Don't have an account? <a href="register.php" id="signup">Signup</a></div>
        </form>
      </div>

      <!-- Signup Form -->
      <div class="form signup_form">
        <form method="post" autocomplete="off">
          <h2>Signup</h2>

          <div class="input_box">
            <input type="email" name="regUserName" placeholder="Enter your email" required />
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" name="regPassWord" placeholder="Create password" minlength="8" required />
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <div class="input_box">
            <input type="text" name="regFullName" placeholder="Fullname" required />
            <i class="uil uil-lock password"></i>
          </div>

          <button class="button" type="submit" name="register" value="Register">Signup Now</button>

          <div class="login_signup">Already have an account? <a href="index.php" id="login">Login</a></div>
        </form>
      </div>
    </div>


    <div class="slider">


      <div class="list">

        <div class="item">
          <img src="../img/el.jpg" alt="">

          <div class="content">
            <div class="title">El Nido</div>
            <div class="type">Palawan</div>
            <div class="description">
            Your Gateway to Untouched Beauty
                 
            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/b11.jpg" alt="">

          <div class="content">
            <div class="title">Boracay</div>
            <div class="type">Aklan</div>
            <div class="description">
            Dive into Crystal Clear Waters
            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/21.jpg" alt="">

          <div class="content">
            <div class="title">Silanguin Cove</div>
            <div class="type">Zambales</div>
            <div class="description">
            Find Peace in the Pristine Shores of Silanguin Cove

            </div>

          </div>
        </div>
        <div class="item">
          <img src="../img/mtp.jpg" alt="">

          <div class="content">
            <div class="title">Mt. Pinatubo</div>
            <div class="type">Pampanga</div>
            <div class="description">
            Experience the Thrill of Mt. Pinatubo’s Epic Trail

            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/batangas.jpg" alt="">

          <div class="content">
            <div class="title">Taal Volcano</div>
            <div class="type">Batangas</div>
            <div class="description">
            Witness the Awe of Taal Volcano

            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/bataan.jpg" alt="">

          <div class="content">
            <div class="title">White Peak</div>
            <div class="type">Bataan</div>
            <div class="description">
            Conquer the Summit at White Peak
            </div>

          </div>
        </div>

        <div class="item">
          <img src="../img/cebu.jpg" alt="">

          <div class="content">
            <div class="title">Kawasan Falls</div>
            <div class="type">Cebu</div>
            <div class="description">
            Chase the Cascades at Kawasan Falls

            </div>

          </div>
        </div>

      </div>


      <div class="thumbnail">

        <div class="item">
          <img src="../img/el.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/b11.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/21.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/mtp.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/batangas.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/bataan.jpg" alt="">
        </div>
        <div class="item">
          <img src="../img/cebu.jpg" alt="">
        </div>

      </div>


      <div class="nextPrevArrows">
        <button class="prev">
          < </button>
            <button class="next"> > </button>
      </div>


    </div>

  </Section>
  <script src="../js/app1.js"></script>
  <script src="../js/script1.js"></script>
  <script>
    setTimeout(() => {
      const notification = document.querySelector('.notification');
      if (notification) {
        notification.classList.add('hide');
      }
    }, 3000);

    const passwordInput = document.querySelector('input[name="regPassWord"]');

    passwordInput.addEventListener('input', function () {
      if (passwordInput.value.length < 8) {
        passwordInput.setCustomValidity("Password must be at least 8 characters long.");
      } else {
        passwordInput.setCustomValidity(""); // Reset the message when valid
      }
    });
  </script>


</body>

</html>