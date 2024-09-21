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
    <link rel="stylesheet" href="../style/boracay.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
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
             <a  href="../include/boracaycancel.php"> <i class="bx bx-book icon"></i> Cancel Booking</a>
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

    <Section class="main">
  <div class="pano">

      <div class="main1">
         <h4>Boracay</h4>
         <p>It's more fun in Boracay Philippines!!</p>
         <button class="button" type="button" ><a href="../include/boracaybook.php">Book Now!!</a></button>
         <button class="button" ><a href="../include/boracayfeed.html">Newsfeed!!</a></button>
         <button class="button" ><a href="../include/boracayfeed.html">Offline</a></button>
  
      </div>

      <div class="history">
        <div class="container">
            <div class="tour__head">
                
            </div>

            <div class="image-container"></div>
        </div>
      </div>
      </div>
      
 
      <div class="img">
        <main>

          <div id="carousel" class="carousel">
          
             <div id='item_1' class="hideLeft">
              <img src="../places/boracay/1.jpg">
            </div>
          
            <div id='item_2' class="prevLeftSecond">
              <img src="../places/boracay/2.jpg">
            </div>
          
            <div id='item_3' class="prev">
              <img src="../places/boracay/4.jpg">
            </div>
          
            <div id='item_4' class="selected">
              <img src="../places/boracay/5.jpg">
            </div>
          
            <div id='item_5' class="next">
              <img src="../places/boracay/6.jpg">
            </div>
          
            <div id='item_6' class="nextRightSecond">
              <img src="../places/boracay/7.jpg">
            </div>
          
            <div id='item_7' class="hideRight">
              <img src="../places/boracay/8.jpg">
            </div>
          
            <div id='item_8' class="hideRight">
              <img src="../places/boracay/9.jpg">
            </div>
          
          </div>
          
          <div class="buttons">
              <button class="button-82-pushable" role="button" id="prev"><span class="button-82-shadow"></span><span class="button-82-edge"></span></span></button>
          
          
              <button class="button-82-pushable" role="button" id="next"><span class="button-82-shadow"></span><span class="button-82-edge"></span></button>
          </div>
          
          </main>
          </div>
          
          <section class="package">

            <main>
              <header>
                <h1>Boracay Tour Package </h1>
                <p>
                 <span class="span1" >&#139;</span>
                <span class="span1" >&#155;</span>
                  
                </p>
              </header>
              <section class="section6">
                <div class="product">
                  <picture>
                    <img src="../img/bpackage1.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Platinum Package</b><br>
                      <small>-Hotel 6 star or Mansion</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast and Fine Dining</small><br>
                      <small>-Premium Souvenir</small>
                  
                      
                    </p>
                    <samp>₱10,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>



                <div class="product">
                  <picture>
                  <img src="../img/bpackage2.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Gold Package</b><br>
                      <small>-Hotel 5 star or Standard Villa</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast and Fine Dining</small><br>
                     
                    </p>
                    <samp>₱9,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>
                <div class="product">
                  <picture>
                  <img src="../img/bpackage3.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Silver Package</b><br>
                      <small>-Hotel 4 star</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast</small><br>
                    </p>
                    <samp>₱8,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>

                    
                  </div>
                </div>
                <div class="product">
                  <picture>
                  <img src="../img/bpackage4.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Bronze Package</b><br>
                      <small>-Hotel 3 star</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast</small><br>
                    </p>
                    <samp>₱6,999.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>
                <div class="product">
                  <picture>
                    <img src="../img/bpackage1.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Platinum Package</b><br>
                      <small>-Hotel 6 star or Mansion</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast and Fine Dining</small><br>
                      <small>-Premium Souvenir</small>
                  
                      
                    </p>
                    <samp>₱10,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>



                <div class="product">
                  <picture>
                  <img src="../img/bpackage2.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Gold Package</b><br>
                      <small>-Hotel 5 star or Standard Villa</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast and Fine Dining</small><br>
                     
                    </p>
                    <samp>₱9,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>
                <div class="product">
                  <picture>
                  <img src="../img/bpackage3.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Silver Package</b><br>
                      <small>-Hotel 4 star</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast</small><br>
                    </p>
                    <samp>₱8,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>

                    
                  </div>
                </div>
                <div class="product">
                  <picture>
                  <img src="../img/bpackage4.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Bronze Package</b><br>
                      <small>-Hotel 3 star</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast</small><br>
                    </p>
                    <samp>₱6,999.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>
                <div class="product">
                  <picture>
                    <img src="../img/bpackage1.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Platinum Package</b><br>
                      <small>-Hotel 6 star or Mansion</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast and Fine Dining</small><br>
                      <small>-Premium Souvenir</small>
                  
                      
                    </p>
                    <samp>₱10,8999.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>



                <div class="product">
                  <picture>
                  <img src="../img/bpackage2.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Gold Package</b><br>
                      <small>-Hotel 5 star or Standard Villa</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast and Fine Dining</small><br>
                     
                    </p>
                    <samp>₱9,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>
                <div class="product">
                  <picture>
                  <img src="../img/bpackage3.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Silver Package</b><br>
                      <small>-Hotel 4 star</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast</small><br>
                    </p>
                    <samp>₱8,899.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>

                    
                  </div>
                </div>
                <div class="product">
                  <picture>
                  <img src="../img/bpackage4.jpg">
                  </picture>
                  <div class="detail">
                    <p>
                      <b>Bronze Package</b><br>
                      <small>-Hotel 3 star</small><br>
                      <small>-Tour Guide</small><br>
                      <small>-Transport</small><br>
                      <small>-Destinations</small><br>
                      <small>-Breakfast</small><br>
                    </p>
                    <samp>₱6,999.00</samp>
                  </div>
                  <div class="button7">
                    <p class="star">
                    </p>
                    <a class="a1" href="#">Book Now!!</a>
                  </div>
                </div>
              </section>
            </main>
        
        <main>
          <header>
            <h1>Top Hottest Activities in Boracay</h1>
            <p>
             <span class="span1" >&#139;</span>
            <span class="span1" >&#155;</span>
              
            </p>
          </header>
          <section class="section6">
            <div class="product">
              <picture>
              <img src="../places/boracay/Zipline Boracay.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Zipline Boracay</b><br>
                </p>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Kite Surf on Bulabog Beach.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Kite Surf on Bulabog Beach</b><br>
                  <small>Station 3 Beach front, Boracay Island 5608</small>
                </p>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Ride the Zorb.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Ride the Zorb</b><br>
                  <small>Beach front Dmall of Boracay Station 2, Boracay, Malay, 5608 Aklan</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Go Island Hopping.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Go Island Hopping</b><br>
                  <small>Station 1, Boracay</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Parasail.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Parasail/b><br>
                  <small>704 Sitio Pinaongon White House Beach Resort, Malay, Aklan Province 5608</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Boracay Pub Crawl.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Boracay Pub Crawl</b><br>
                  <small>Station 3, Front Beach Malay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Bat Caves.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b> Bat Caves</b><br>
                  <small>Main Road, Barangay Balabag (near BPI D'mall)</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Do Some Shopping.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Do Some Shopping</b><br>
                  <small> D'Mall Boracay, Station 2</small>
                </p>
              
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
              
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Learn to Freedive.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Learn to Freedive </b><br>
                  <small>Station 3 Beachfront</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Go Scuba Diving'.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Go Scuba Diving</b><br>
                  <small>Brgy. Balabag, Station 1</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Philippine Mermaid Swimming Academy.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Philippine Mermaid Swimming Academy </b><br>
                  <small> Dmall Boracay, Station 2 (next to Epic)</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Island Nature Tour.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Island Nature Tour</b><br>
                  <small>Bolabog & Angol , Malay, Philippines</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
          </section>
        </main>

        <main>
          <header>
            <h1>Top Hottest Resturants</h1>
            <p>
             <span class="span1" >&#139;</span>
            <span class="span1" >&#155;</span>
              
            </p>
          </header>
          <section class="section6">
            <div class="product">
              <picture>
              <img src="../places/boracay/nalka1.png">
              </picture>
              <div class="detail">
                <p>
                  <b>Nalka Seafood Restaurant </b><br>
                  <small>Malay, Aklan</small>
                </p>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/maruha.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Café Maruja</b><br>
                  <small>Station 3 Beach front, Boracay Island 5608</small>
                </p>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/cafe del sol.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b> Café del Sol</b><br>
                  <small>Beach front Dmall of Boracay Station 2, Boracay, Malay, 5608 Aklan</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/barlo.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Barlo Resturant</b><br>
                  <small>Station 1, Boracay</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/losindios.png">
              </picture>
              <div class="detail">
                <p>
                  <b>Los Indios Bravos</b><br>
                  <small>704 Sitio Pinaongon White House Beach Resort, Malay, Aklan Province 5608</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/dampa.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Vhub Dampa Seafood Grill and Restaurant</b><br>
                  <small>Station 3, Front Beach Malay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/meze.png">
              </picture>
              <div class="detail">
                <p>
                  <b>Meze Wrap</b><br>
                  <small>Main Road, Barangay Balabag (near BPI D'mall)</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/spice.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>SpiceBird</b><br>
                  <small> D'Mall Boracay, Station 2</small>
                </p>
              
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
              
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/sunny.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>The Sunny Side Cafe </b><br>
                  <small>Station 3 Beachfront</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/blackfish.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Blackfish Coffee Bar </b><br>
                  <small>Brgy. Balabag, Station 1</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/littletaj.jpeg">
              </picture>
              <div class="detail">
                <p>
                  <b>Little Taj Boracay </b><br>
                  <small> Dmall Boracay, Station 2 (next to Epic)</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/congas.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Congas Restaurant</b><br>
                  <small>Bolabog & Angol , Malay, Philippines</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
          </section>
        </main>


        <main>
          
          <header>
            <h1>Top Hottest Accomodations</h1>
            <p>
            <span class="span2" >&#139;</span>
            <span class="span2" >&#155;</span>
              
            </p>
          </header>
          <section class="section6">
            <div class="product">
              <picture>
              <img src="../places/boracay/shangrila.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Shangri-La Hotels and Resorts</b><br>
                  <small>Barangay Yapak, Boracay Island, Malay, Aklan 5608</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/mandala.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Mandala Spa and Resort Villas</b><br>
                  <small> Station 3, Barangay Manoc-Manoc, Boracay Island</small>
                </p>
                
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/fairways.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Fairways & Bluewater Boracay</b><br>
                  <small>Station 1, Balabag and Yapak, Balabag, 5608 Boracay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/henann.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Henann Crystal Sands Resort</b><br>
                  <small>Station 1 (In between boat station 1 and D'mall) Boracay Island.</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/astoria.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Astoria Current</b><br>
                  <small>Sitio Mangayad, Brgy. Manoc Manoc, Station 3, Malay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/mandarin.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Mandarin Bay Resort & Spa</b><br>
                  <small>Beachfront, Station 2, Boracay, Malay</small>
                </p>
              
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/movenpick.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Mövenpick Resort & Spa Boracay</b><br>
                  <small>Punta Bunga Cove, Barangay Yapak, Boracay Island, Malay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
             
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/hue.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Hue Hotels and Resorts Boracay</b><br>
                  <small>Station 2, Hue Hotels and Resorts Boracay </small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/belmont.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Belmont Hotel Boracay</b><br>
                  <small>Newcoast Drive, Boracay Newcoast, Barangay Yapak, Boracay Island, Malay</small>
                </p>
              
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/lind1.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>The Lind Boracay</b><br>
                  <small>Station 1, Malay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/savoy.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Savoy Hotel Boracay Newcoast</b><br>
                  <small>Newcoast Drive Malay</small>
                </p>
               
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/lacarmela.png">
              </picture>
              <div class="detail">
                <p>
                  <b> La Carmela de Boracay Resort Hotel</b><br>
                  <small>Station 2, Balabag, Boracay Island, Malay</small>
                </p>
              
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
               
              </div>
            </div>
          </section>
        </main>


   
        <main>
          <div class="text">
          
          </div>
          <header>
            <h1>Top Hottest Products</h1>
            <p>
            <span class="span3" >&#139;</span>
            <span class="span3" >&#155;</span>
              
            </p>
          </header>
          <section class="section6">
            <div class="product">
              <picture>
              <img src="../places/boracay/dried mangoes.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Dried Mangoes</b><br>
                 
                </p>
                <samp>₱500.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Kapeng-Barako.png">
              </picture>
              <div class="detail">
                <p>
                  <b>Barako Coffee</b><br>
                 
                </p>
                <samp>₱300.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Handicrafts.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Handicrafts</b><br>
                 
                </p>
                <samp>₱500.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/keychains.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Keychains</b><br>
                 
                </p>
                <samp>₱300.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Buko Pie.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Buko Pie</b><br>
                 
                </p>
                <samp>₱300.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Beachwear.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Beachwear</b><br>
                 
                </p>
                <samp>₱600.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Seafood.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Seafoods</b><br>
                 
                </p>
                <samp>₱1000.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Ref Magnet.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Ref Magnet</b><br>
                
                </p>
                <samp>₱200.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/sunny.jpg">
              </picture>
              <div class="detail">
                <p>
                  <b>Product Nine</b><br>
                  <small>New arrival</small>
                </p>
                <samp>₱300.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Piaya.png">
              </picture>
              <div class="detail">
                <p>
                  <b>Piaya</b><br>
                  
                </p>
                <samp>₱300.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/T’nalak Cloth.jpeg">
              </picture>
              <div class="detail">
                <p>
                  <b>T’nalak Cloth  </b><br>
                  
                </p>
                <samp>₱700.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
            <div class="product">
              <picture>
              <img src="../places/boracay/Banana Chips.jpeg">
              </picture>
              <div class="detail">
                <p>
                  <b>Banana Chips</b><br>
                
                </p>
                <samp>₱150.00</samp>
              </div>
              <div class="button7">
                <p class="star">
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                  <strong>&star;</strong>
                </p>
                <a class="a1" href="#">Add-cart</a>
              </div>
            </div>
          </section>
        </main>
        
      

      
          <div class="maps">
            <h5>Interactive Map</h5>
            
            <div class="frame">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d35046.36441104783!2d121.90658652462383!3d11.969282395587411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a53c2f324b4ee7%3A0xa738e81e5e6dda36!2sBoracay!5e1!3m2!1sen!2sph!4v1726750259691!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="loc">
            
             <h6>Here are more bits about Boracay.</h6><br>
             <i class="bx bx-map icon"><span class="sp"></span><span class="text">Location: </span> Boracay is within the municipality of Malay, province of Aklan in the Philippines. Mainland Aklan is part of Panay Island.</i>
             <i class="bx bx-flag icon"><span class="sp"></span><span class="text">Languages:</span> Aklanon and Ati are the native languages. But locals, especially those working in the tourism industry, can fluently speak and understand Tagalog and English.</i>
             <i class="bx bx-time icon"><span class="sp"></span><span class="text">Time Zone:</span> UTC+8 (Philippine Standard Time). The Philippines is in the same time zone as Singapore and Beijing, one hour ahead of Thailand, and one hour behind Japan.</i>
             <i class="bx bx-money icon"><span class="sp"></span><span class="text">Currency:</span> Philippine peso (PHP, ₱). PHP100 is around USD 1.81, EUR 1.66, SGD 2.45 (as of July 2023).</i>
             <i class="bx bx-money icon"><span class="sp"></span><span class="text">Modes of payment:</span> CASH, primarily. Some establishments accept credit cards, but most smaller stores and eateries accept only cash or GCash.
             </i><br><br>
            </div>
        </div>

      </section>
      
    </Section>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"></script>
    <script src="../js/panolens.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/palawan.js"></script>
    <script src="../js/home.js"></script>
    <script src="../js/darkmode.js"></script>
    <script src="../js/language.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/boracay.js"></script>
    <script src="../js/index.js"></script>
    <script type="text/javascript" src="../js/fin.js"></script>
    <script src="../js/app.js"></script>
    
   
  </body>
</html>