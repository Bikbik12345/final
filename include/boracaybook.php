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

<?php
// Check if the user is logged in
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];

  try {
    // Fetch the user's details from the database using user_id
    $stmt = $pdoConnect->prepare("SELECT UserName, FullName, PassWord, image FROM user WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      // Extract user details
      $email = $user['UserName'];
      $full_name = $user['FullName'];
      $password = $user['PassWord'];
      $profile_image = !empty($user['image']) ? $user['image'] : 'img/default_profile.jpg'; // Fallback to default image
    } else {
      // Handle the case where user details are not found
      echo "User details not found.";
      exit();
    }
  } catch (PDOException $e) {
    // Handle database connection error or query failure
    echo "Error: " . $e->getMessage();
    exit();
  }
} else {
  // Redirect to the login page if the user is not logged in
  header("Location: login.php");
  exit();
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
    <link rel="stylesheet" href="../style/boracaybook.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"
    />
    
  </head>
  <body>

  <nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">TravelHunter</span>
       
           
            <div class="profile">
            <span id="name-span"><?php echo htmlspecialchars($UserName); ?></span>
            <div class="dropdown">
                <img src="<?php echo $profile_image; ?>" alt="Profile Picture" class="user">
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <select class="language" id="language-select" onchange="changeLanguage()">
                <option value="en">English</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="zh">Chinese</option>
                <option value="jp">Japanese</option>
                <option value="ru">Russian</option>
                <option value="it">Italian</option>
                <option value="pt">Portuguese</option>
                <option value="ar">Arabic</option>
            </select>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
           
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">TravelHunter</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="../include/home.php" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link" data-lang-en="Home" data-lang-es=" Inicio" data-lang-fr="d'accueil"
            data-lang-de=" Startseite" data-lang-zh="首页" data-lang-jp="ホーム (Hōmu)ー"
            data-lang-ru="Главная" data-lang-it=" Home"
            data-lang-pt="Início" data-lang-ar="الصفحة الرئيسية">Home</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/categories.php" class="nav-link">
                <i class="bx bx-menu icon"></i>
                <span class="link" data-lang-en="Categories" data-lang-es="Categorías" data-lang-fr="d'accueil"
            data-lang-de="Kategorien" data-lang-zh="分类" data-lang-jp="カテゴリ (Kategori)"
            data-lang-ru=" Категории" data-lang-it="Categorie"
            data-lang-pt="Categorias" data-lang-ar="الفئات">Categories</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/place.html" class="nav-link">
                <i class="bx bx-map icon"></i>
                <span class="link" data-lang-en="Place" data-lang-es=" Lugar" data-lang-fr="Lieu"
            data-lang-de="Ort" data-lang-zh="地点" data-lang-jp="場所 (Basho)"
            data-lang-ru=" Место" data-lang-it="Luogo"
            data-lang-pt="Local" data-lang-ar="الفئات">Place</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/marketplace.html" class="nav-link">
                <i class="bx bx-gift icon"></i>
                <span class="link" data-lang-en="Marketplace" data-lang-es="Mercado" data-lang-fr="Marché"
            data-lang-de="Marktplatz" data-lang-zh=" 市场" data-lang-jp="マーケットプレイス "
            data-lang-ru="Торговая площадка" data-lang-it="Mercato"
            data-lang-pt="Mercado" data-lang-ar="السوق">Marketplace</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/social.html" class="nav-link">
                <i class="bx bx-camera icon"></i>
                <span class="link" data-lang-en="Social Media" data-lang-es=" Redes sociales" data-lang-fr="Médias sociaux"
            data-lang-de="Soziale Medien" data-lang-zh="社交媒体" data-lang-jp="ソーシャルメディア"
            data-lang-ru="Социальные сети" data-lang-it="Social Media"
            data-lang-pt="Mídias Sociais" data-lang-ar="وسائل التواصل الاجتماعي">Social Media</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/whether.html" class="nav-link">
                <i class="bx bx-cloud icon"></i>
                <span class="link" data-lang-en="Whether Forecast" data-lang-es=" Pronóstico del tiempo"
                 data-lang-fr="Prévisions météorologiques"
            data-lang-de="Wettervorhersage" data-lang-zh="天气预报" data-lang-jp="天気予報 (Tenki Yohō)"
            data-lang-ru="Прогноз погоды" data-lang-it="Previsioni del tempo"
            data-lang-pt="Previsão do Tempo" data-lang-ar="توقعات الطقس">Weather Forecast</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/itenerary.html" class="nav-link">
                <i class="bx bx-note icon"></i>
                <span class="link" data-lang-en="My Itinerary" data-lang-es="Mi itinerario" data-lang-fr="Mon itinéraire"
            data-lang-de="Meine Reiseroute" data-lang-zh="我的行程" data-lang-jp="私の旅程 (Watashi no Ritei)"
            data-lang-ru="Мой маршрут" data-lang-it="Il mio itinerario"
            data-lang-pt="Meu Itinerário" data-lang-ar="مسار رحلتي">My Itinerary</span>
              </a>
            </li>
          </ul>

         
         
        </div>
      </div>
    </nav>

    <section class="overlay"></section>
    
    <section class="main">
                    
    <div class="container">
         <header>Booking Form</header>
         <div class="progress-bar">
            <div class="step">
               <p>
                  Personal 
               </p>
               <div class="bullet">
                  <span>1</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Booking 
               </p>
               <div class="bullet">
                  <span>2</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                 Payment 
               </p>
               <div class="bullet">
                  <span>3</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Submit
               </p>
               <div class="bullet">
                  <span>4</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
         </div>
         <div class="form-outer">
            <form id="bookingForm" action="../include/user.php" method="post">
               <div class="page slide-page">
                  <div class="title">
                     Basic Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        Full Name
                     </div>
                     <input type="text" id="name" name="name" required>
                  </div>
                  <div class="field">
                     <div class="label">
                        Email Address
                     </div>
                     <input type="email" id="email" name="email" required><br><br>

                  </div>
				  <div class="field">
					<div class="label">
					   Phone Number
					</div>
          <input type="text" id="phone" name="phone" min="1" max="11" required>
				 </div>
				
                  <div class="field">
                     <button class="firstNext next">Next</button>
                  </div>
               </div>
               <div class="page">
                  <div class="title">
                     Booking Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        Choose Package
                     </div>
					 <select type="select" id="package" name="package" required>
						<option hidden>Choose Package</option>
						<option>Platinum</option>
						<option>Gold</option>
						<option>Silver</option>
						<option>Bronze</option>
						
					  </select>
                  </div>
                  <div class="field">
                     <div class="label">
                       Booking Date
                     </div>
                     <input type="date" id="checkin" name="checkin" required>
                  </div>
				  <div class="field">
					<div class="label">
					  Number of Guests
					</div>
					<input type="number" id="guests" name="guests" min="1" max="50" required>
				 </div>
				 <div class="field">
					<div class="label">
						Number of Days
					</div>
					<input placeholder="Number of Days" type="text" id="days" name="days" required>
				 </div>
                  <div class="field btns">
                     <button class="prev-1 prev">Previous</button>
                     <button class="next-1 next">Next</button>
                  </div>
               </div>
			   
               <div class="page">
                  <div class="title">
                     Payment:
                  </div>
				  <div class="field">
					<div class="label">
					 Mode of Payment
					</div>
					<select type="select" id="payment" name="payment" required>
						<option hidden>Payment Method</option>
						<option>Gcash</option>
						<option>Maya</option>
						<option>Paypal</option>
						
					  </select>	
				 </div>
                  <div class="field">
                     <div class="label">
                        Down Payment
                     </div>
                     <input type="number" id="amount" name="amount" step="0.01" required>
                  </div>
				  <div class="field">
					<div class="label">
					   Reference Number
					</div>
					<input type="text" id="Reference" name="Reference" required>
				 </div>
				
                  <div class="field btns">
                     <button class="prev-2 prev">Previous</button>
                     <button class="next-2 next">Next</button>
                  </div>
               </div>
               <div class="page">
                  <div class="title">
                     Login Details:
                  </div>
                  <div class="field">
                     <div class="label">
                        Username
                     </div>
                     <input type="text">
                  </div>
                  <div class="field">
                     <div class="label">
                        Password
                     </div>
                     <input type="password">
                  </div>
                  <div class="field btns">
                     <button class="prev-3 prev">Previous</button>
                     <button class="submit" type="submit" value="Book and Pay">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <script src="../js/socmed.js"></script>

    </section>
    <script src="../js/home.js"></script>
    <script src="../js/language.js"></script>
  </body>
</html>



