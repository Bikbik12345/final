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
    <link rel="stylesheet" href="../style/place.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">TravelHunter</span>
       
            <div class="search-box">

                <form>
                    <button type="submit"><i class="fa fa-search"></i></button>
                    <input type="text" id="search-box" placeholder="Search a place here..">

                </form>
            </div>
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

        <div class="bottom-content">
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
              <a href="../include/categories.html" class="nav-link">
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
              <a href="../include/socmed.php" class="nav-link">
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
            data-lang-pt="Previsão do Tempo" data-lang-ar="توقعات الطقس">Whether Forecast</span>
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
      </div>
    </nav>

    <section class="overlay"></section>

    <section class="main">
        <section class="section3">
           
            <div class="florida">

                <h1
                    style="color: rgb(255, 255, 255); font-size: 30px; font-family: Georgia, 'Times New Roman', Times, serif;">
                    Aklan
                </h1>
                <div class="container1">
                    <div class="card">
                        <img src="../Places/Aklan/Travel Hunter - 21.png" alt="HolyRosaryParishChurch">
                        <div class="intro">
                            <h1>Boracay Islands</h1>
                            <p>Located in:Aklan, Philippines</p>
                            <a class="location" href="https://maps.app.goo.gl/ofmcxU8KQYVrpBxy9"
                                target="_blank">Location</a>


                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/Aklan/Travel Hunter - 22.png" alt="PuningHotSpring">
                        <div class="intro">
                            <h1>Ariel's Point</h1>
                            <p>Located in:Aklan, Philippines </p>
                            <a class="location" href="https://maps.app.goo.gl/XoVfS425knwXfUV99"
                                target="_blank">Location</a>

                        </div>
                    </div>


                    <div class="card">
                        <img src="../Places/Aklan/Travel Hunter - 23.png" alt="MuseoningAngeles">
                        <div class="intro">
                            <h1>Willy's Rock</h1>
                            <p>Located in:Aklan, Philippines </p>
                            <a class="location" href="https://maps.app.goo.gl/LdtP8HRbbkFKmfgk8"
                                target="_blank">Location</a>


                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/Aklan/Travel Hunter - 24.png" alt="apung">
                        <div class="intro">
                            <h1>Puka Shell Beach</h1>
                            <p>Located in:Aklan, Philippines</p>
                            <a class="location" href="https://maps.app.goo.gl/Ehms89Z8pZfytvVu8"
                                target="_blank">Location</a>

                        </div>
                    </div>
                </div>
            </div>





            <div class="florida">

                <h1
                    style="color: rgb(255, 255, 255); font-size: 30px; font-family: Georgia, 'Times New Roman', Times, serif;">
                    Batanes
                </h1>
                <div id="arayat" class="container1">
                    <div class="card">
                        <img src="../Places/batanes/Travel Hunter - 16.png" alt="Sulipan Bridge">
                        <div class="intro">
                            <h1>Basco Light House</h1>
                            <p>Located in: Batanes, Philippines</p>
                            <a class="location" href="https://maps.app.goo.gl/YMWPR79wJx1DA26R7"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/batanes/Travel Hunter - 17.png" alt="StPeter">
                        <div class="intro">
                            <h1>Rakuha Payaman</h1>
                            <p>Located in: Batanes, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/UtAkF3fFRnBhhA5j8"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/batanes/Travel Hunter - 18.png" alt="miyamit">
                        <div class="intro">
                            <h1>Valugan Boulder Beach</h1>
                            <p>Located in: Batanes, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/ikJJVp9vnemZqGxe7"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/batanes/Travel Hunter - 19.png" alt="miyamit">
                        <div class="intro">
                            <h1>Morong Beach</h1>
                            <p>Located in: Batanes, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/qxHdQGFANw3HXrHU8"
                                target="_blank">Location</a>

                        </div>
                    </div>


                </div>

            </div>
            <div class="florida">


                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Batangas</h1>
                <div id="bacolor" class="container1">
                    <div class="card">
                        <img src="../Places/batangas/Travel Hunter - 11.png" alt="suvablessed">
                        <div class="intro">
                            <h1>Taal Volcano and Lake</h1>
                            <p>Located in:Batangas, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/6uK6ehdNt5CpvUof9"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/batangas/Travel Hunter - 12.png" alt="Mtarayat">
                        <div class="intro">
                            <h1>Masasa Beach</h1>
                            <p>Located in:Batangas, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/vQKFMWt3Ahveig4A9"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/batangas/Travel Hunter - 13.png" alt="sunflower">
                        <div class="intro">
                            <h1>Nasugbu Beach</h1>
                            <p>Located in:Batangas, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/hzeoANFaYv8EKRp96"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/batangas/Travel Hunter - 14.png" alt="Balebatu">
                        <div class="intro">
                            <h1>Mount Batulao</h1>
                            <p>Located in:Batangas, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/Pcz5h3oqTdwZ194b6 "
                                target="_blank">Location</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="florida">

                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Palawan</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../Places/palawan/Travel Hunter - 1.png" alt="Bacolor_Church">
                        <div class="intro">
                            <h1>Puerto Princesa Underground River </h1>
                            <p>Located in: Palawan, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/rFrST9msuLAtSKrc6"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/palawan/Travel Hunter - 2.png" alt="diaspora">
                        <div class="intro">
                            <h1>El Nido</h1>
                            <p>Located in: Palawan, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/gBFhN3ac9BSaNfE56"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/palawan/Travel Hunter - 3.png" alt="sanantonio">
                        <div class="intro">
                            <h1>Coron Island</h1>
                            <p>Located in: Palawan, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/UodgkfEcCnQVyBej8"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/palawan/Travel Hunter - 4.png" alt="archdiocesan">
                        <div class="intro">
                            <h1>Kayangan Lake</h1>
                            <p>Located in: Palawan, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/uJkQ4kH1b7RXVSp86"
                                target="_blank">Location</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Pampanga</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../Places/Pampanga/Travel Hunter - 10.png" alt="miyamit">
                        <div class="intro">
                            <h1>Dara Water Falls</h1>
                            <p>Located in:Porac, Pampanga, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/SiJdrqdmVc4xLimj9"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/Pampanga/Travel Hunter - 6.png" alt="miyamit">
                        <div class="intro">
                            <h1>Miyamit Falls</h1>
                            <p>Located in: Porac, Pampanga, Philippines.</p>
                            <a class="location" href="https://maps.app.goo.gl/Krvvrh9ujVq3h9SY9"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/Pampanga/Travel Hunter - 7.png" alt="pinak">
                        <div class="intro">
                            <h1>Puning Hotspring</h1>
                            <p>Located in: Porac, Pampanga, Philippines</p>
                            <a class="location" href="https://maps.app.goo.gl/MNxStiHvahBYBRMd6"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../Places/Pampanga/Travel Hunter - 8.png" alt="paligue">
                        <div class="intro">
                            <h1>Mount Arayat </h1>
                            <p>Located in:Arayat, Pampanga, Philippines</p>
                            <a class="location" href="https://maps.app.goo.gl/c2WQsnuEjzJAJo5x8"
                                target="_blank">Location</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Floridablanca</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../Places/Places/florida/tungab.jpg" alt="tungab">
                        <div class="intro">
                            <h1>Tungab</h1>
                            <p>Located in:San Ramon Floridablanca, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/1i3YJFPuyFLxyxg8A"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/florida/summer.jpg" alt="summer">
                        <div class="intro">
                            <h1>Palakol Summer Place</h1>
                            <p>Located in:San Jose Floridablanca, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/gikc2UWzdbw21EzFA"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/florida/sumuclab.png" alt="sumuclab">
                        <div class="intro">
                            <h1>Sumuclab Lagoon</h1>
                            <p>Located in:Mawacat Floridablanca, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/R5VxmwHucQFycbaDA"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/florida/nabuclod.jpg" alt="nabuclod">
                        <div class="intro">
                            <h1>Nabuclod Mountain View</h1>
                            <p>Located in:Nabuclod Floridablanca, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/KZA6kvjvXo6Z1PXAA"
                                target="_blank">Location</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Guagua</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/guagua/venta.jpg" alt="venta">
                        <div class="intro">
                            <h1>The Venta Suites Pampanga</h1>
                            <p>Located in:Guagua, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/R3XDBH8rsKj15RDH7"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/guagua/angela.jpg" alt="angela">
                        <div class="intro">
                            <h1>Angela's Private Resort</h1>
                            <p>Located in:Guagua, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/NDcWQ4zHav4QEQca9"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/guagua/pricilla.jpg" alt="pricilla">
                        <div class="intro">
                            <h1>Villa Priscilla Resort & Pavilion</h1>
                            <p>Located in:Guagua, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/35jWgoLrZ1Lk9ucq9"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/guagua/church.jpg" alt="miyamit">
                        <div class="intro">
                            <h1> St James the Apostol Parish</h1>
                            <p>Located in:Betis Guagua, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/kHe5CkxPRxn2rNDD9 "
                                target="_blank">Location</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Lubao</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/lubao/bamboo.jpg" alt="bamboo">
                        <div class="intro">
                            <h1>Bamboo Park</h1>
                            <p>Located in:Lubao, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/ZiCewXAeF5i8RJS18 "
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/lubao/sanagus.jpg" alt="sanagus">
                        <div class="intro">
                            <h1>San Agustin Church</h1>
                            <p>Located in:Lubao, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/ZHZRkUYNZypc9kcu6 "
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/lubao/museum.jpg" alt="museum">
                        <div class="intro">
                            <h1>Museo at Aklatan ni Diosdado Macapagal</h1>
                            <p>Located in:Lubao, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/T9FqSTCrVJcUio3e8"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/lubao/Sanan.jpg" alt="sanan">
                        <div class="intro">
                            <h1>San Antonio De Padua Parish</h1>
                            <p>Located in:San Antonio Lubao, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/GKNc5Rpkrjj9Aau86"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: rgb(255, 255, 255); font-size: 30px;">Macabebe</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/macabebe/consuelo.jpg" alt="consuelo">
                        <div class="intro">
                            <h1>Consuelo Beach</h1>
                            <p>Located in:Consuelo Macabebe, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/macabebe/cabalen.jpg" alt="cabalen">
                        <div class="intro">
                            <h1>Cabalen</h1>
                            <p>Located in:Cabalen Macabebe, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/macabebe/casa.jpeg" alt="casa">
                        <div class="intro">
                            <h1>Casa Palmera</h1>
                            <p>Located in:Macabebe, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/macabebe/cabalenchirch.jpg" alt="cabalenchurch">
                        <div class="intro">
                            <h1>Cabalen Church</h1>
                            <p>Located in:Cabalen Macabebe, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: rgb(0, 0, 0); font-size: 30px;">Magalang</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/magalang/Facade_of_San_Bartolome_Church_(Magalang).jpg" alt="sanbart">
                        <div class="intro">
                            <h1>San Bartolome</h1>
                            <p>Located in:San Bartolome Magalang, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/magalang/plaza.jpg" alt="plaza">
                        <div class="intro">
                            <h1>Magalang Plaza</h1>
                            <p>Located in:Plaza Magalang, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/magalang/Elevation.jpg" alt="Elevation">
                        <div class="intro">
                            <h1>Elevation Magalang</h1>
                            <p>Located in:Elevation Magalang, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/magalang/gueco.jpg" alt="gueco">
                        <div class="intro">
                            <h1>Gueco House</h1>
                            <p>Located in:Magalang, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Masantol</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/masantol/Sanmiguel/3.jpg" alt="San Miguel Arcangel Parish Church">
                        <div class="intro">
                            <h1>San Miguel Arcangel Parish Church</h1>
                            <p>Located in:Masantol, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>

                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/masantol/king.jpg" alt="miyamit">
                        <div class="intro">
                            <h1>King Arthur's Private Resort</h1>
                            <p>Located in:Masantol, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/masantol/ashley.jpg" alt="ashley">
                        <div class="intro">
                            <h1>Ashley's Villa</h1>
                            <p>Located in:Masantol, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/masantol/malauli.jpg" alt="malauli">
                        <div class="intro">
                            <h1>Malauli</h1>
                            <p>Located in:Masantol, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Mexico</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/mexico/lake.jpg" alt="mexico">
                        <div class="intro">
                            <h1>Lakeshore</h1>
                            <p>Located in:Mexico, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/mexico/skyranch.jpg" alt="skyranch">
                        <div class="intro">
                            <h1>Skyranch Pampanga</h1>
                            <p>Located in:Mexico, Pampanga.</p>
                            <aclass="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7" target="_blank">
                                Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/mexico/villa.jpg" alt="villa">
                        <div class="intro">
                            <h1>Villa Alfredos</h1>
                            <p>Located in:Mexico, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/mexico/santodomingo.JPG" alt="santodomingo">
                        <div class="intro">
                            <h1>Oval</h1>
                            <p>Located in:Santo Domingo Mexico, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Minalin</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/minalin/sunset.jpg" alt="Sunset Park">
                        <div class="intro">
                            <h1>Sunset Park</h1>
                            <p>Located in:Minalin, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/minalin/stamonica.jpg" alt="Sta. Monica Parish Church">
                        <div class="intro">
                            <h1>Sta. Monica Parish Church</h1>
                            <p>Located in:Sta Monica Minalin, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/minalin/riverside.jpg" alt="riverside">
                        <div class="intro">
                            <h1>Riverside Monument Santa Rita</h1>
                            <p>Located in:Santo Tomas Minalin, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/minalin/river.jpg" alt="river">
                        <div class="intro">
                            <h1>Minalin River</h1>
                            <p>Located in:Minalin, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Porac</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/porac/Miyamit/3.jpg" alt="Miyamit">
                        <div class="intro">
                            <h1>Miyamit Falls</h1>
                            <p>Located in:Porac, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/porac/sandbox.png" alt="Sandbox">
                        <div class="intro">
                            <h1>SandBox Alviera</h1>
                            <p>Located in:Porac, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/porac/haduan-falls.jpg" alt="haduan-falls">
                        <div class="intro">
                            <h1>Haduan Falls</h1>
                            <p>Located in:Porac, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/porac/inararo.jpg" alt="inararo">
                        <div class="intro">
                            <h1>Inararo Ecotour</h1>
                            <p>Located in:Porac, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">San Fernando</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/san fernando/train.jpg" alt="train">
                        <div class="intro">
                            <h1>San Fernando Train Station</h1>
                            <p>Located in:San Fernando, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/san fernando/heroeshall.jpg" alt="heroes hall">
                        <div class="intro">
                            <h1>Heroes Hall</h1>
                            <p>Located in:San Fernando, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/san fernando/lazatin.jpg" alt="lazatin">
                        <div class="intro">
                            <h1>Lazatin House</h1>
                            <p>Located in:San Fernando, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/san fernando/deathmarch.jpg" alt="deathmarch">
                        <div class="intro">
                            <h1>Death March Maker</h1>
                            <p>Located in:San Fernando, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">San Luis</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/Sanluiss/IMG_20221127_085503.jpg" alt="luis">
                        <div class="intro">
                            <h1>Luis Taruc Monument</h1>
                            <p>Located in:San Luis, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/Sanluiss/lotgar.jpg" alt="lotgar">
                        <div class="intro">
                            <h1>Lot-Gar Farm Resort</h1>
                            <p>Located in:San Luis, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/Sanluiss/idol.jpg" alt="idol">
                        <div class="intro">
                            <h1>Idol Tiktok</h1>
                            <p>Located in:San Luis, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/Sanluiss/church.jpg" alt="Sanluis">
                        <div class="intro">
                            <h1>San Luis Gonzaga Parish Church</h1>
                            <p>Located in:San Luis, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">San Simon</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/san simon/sansimonchurch.jpg" alt="church">
                        <div class="intro">
                            <h1>San Simon Parish Church</h1>
                            <p>Located in:San Simon, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/san simon/aerostop.png" alt="aerostop">
                        <div class="intro">
                            <h1>Hacienda Galea Resort</h1>
                            <p>Located in:San Simon, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/san simon/villa.jpg" alt="villa">
                        <div class="intro">
                            <h1>Villa Teresa Resort</h1>
                            <p>Located in:San Simon, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/san simon/del.jpg" alt="del">
                        <div class="intro">
                            <h1>Del Mar Resort</h1>
                            <p>Located in:San Simon, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Santa Ana</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/santa ana/Boracandaba.jpeg" alt="Boracandaba">
                        <div class="intro">
                            <h1>Boracandaba Resort</h1>
                            <p>Located in:Santa Ana, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/santa ana/sawali.jpg" alt="sawali">
                        <div class="intro">
                            <h1>Sawali Garden Resort</h1>
                            <p>Located in:Santa Ana, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/santa ana/barok.jpg" alt="barok">
                        <div class="intro">
                            <h1>Barok's Resort</h1>
                            <p>Located in:Santa Ana, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/santa ana/church.jpg" alt="church">
                        <div class="intro">
                            <h1>Santa Ana Parish Church</h1>
                            <p>Located in:Santa Ana, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Santa Rita</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/starita/church.jpg" alt="church">
                        <div class="intro">
                            <h1>Sta Rita Parish Church</h1>
                            <p>Located in:Sta Rita, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/starita/Ecopark/3.jpg" alt="Ecopark">
                        <div class="intro">
                            <h1>Saint Rita of Cascia Ecopark</h1>
                            <p>Located in:Sta Rita, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/starita/res.jpg" alt="res">
                        <div class="intro">
                            <h1>Ocampo Private Resort</h1>
                            <p>Located in:Sta Rita, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/starita/alviz.jpg" alt="alviz">
                        <div class="intro">
                            <h1>Alviz Farm</h1>
                            <p>Located in:Sta Rita, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Santo Tomas</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/santo tomas/pottery.jpg" alt="pottery">
                        <div class="intro">
                            <h1>Pampanga Pottery</h1>
                            <p>Located in:Santo Tomas, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/santo tomas/stotomas.jpg" alt="Stotomas">
                        <div class="intro">
                            <h1>Santo Tomas</h1>
                            <p>Located in:Santo Tomas, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/santo tomas/mula.jpeg" alt="mula">
                        <div class="intro">
                            <h1>Mula De Victoria Hidden Farm Resort</h1>
                            <p>Located in:Santo Tomas, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/santo tomas/sanrise.jpg" alt="sanrise">
                        <div class="intro">
                            <h1>Sanrise Private Resort</h1>
                            <p>Located in:Santo Tomas, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="florida">

                <h1 style="color: white; font-size: 30px;">Sasmuan</h1>
                <div id="candaba" class="container1">
                    <div class="card">
                        <img src="../spot/sasmuan/bangkung malapad.jpg" alt="bangkung">
                        <div class="intro">
                            <h1>Bangkung Malapad</h1>
                            <p>Located in:Sasmuan, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/sasmuan/starosario.JPG" alt="starosario">
                        <div class="intro">
                            <h1>Sta Rosario Parish Church</h1>
                            <p>Located in:Sta Rosario Sasmuan, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/sasmuan/banqueruan.jpg" alt="banqueruan">
                        <div class="intro">
                            <h1>Banqueruan Places</h1>
                            <p>Located in:Banqueruan Sasmuan, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../spot/sasmuan/stalucia.jpg" alt="stalucia">
                        <div class="intro">
                            <h1>Sta Lucia Parish Church</h1>
                            <p>Located in:Sta Lucia Sasmuan, Pampanga.</p>
                            <a class="location" href="https://maps.app.goo.gl/Qhup1U9BVeDRVBCG7"
                                target="_blank">Location</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
    <script src="../js/home.js"></script>
    <script src="../js/language.js"></script>
    <script src="../js/place.js"></script>
</body>

</html>