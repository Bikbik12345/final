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
   <title>Explore Now!!</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../style/home.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
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
              <a href="../include/categories.php" class="nav-link">
                <i class="bx bx-menu icon"></i>
                <span class="link" data-lang-en="Categories" data-lang-es="Categorías" data-lang-fr="d'accueil"
            data-lang-de="Kategorien" data-lang-zh="分类" data-lang-jp="カテゴリ (Kategori)"
            data-lang-ru=" Категории" data-lang-it="Categorie"
            data-lang-pt="Categorias" data-lang-ar="الفئات">Categories</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/place.php" class="nav-link">
                <i class="bx bx-map icon"></i>
                <span class="link" data-lang-en="Place" data-lang-es=" Lugar" data-lang-fr="Lieu"
            data-lang-de="Ort" data-lang-zh="地点" data-lang-jp="場所 (Basho)"
            data-lang-ru=" Место" data-lang-it="Luogo"
            data-lang-pt="Local" data-lang-ar="الفئات">Place</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/marketplace.php" class="nav-link">
                <i class="bx bx-gift icon"></i>
                <span class="link" data-lang-en="Marketplace" data-lang-es="Mercado" data-lang-fr="Marché"
            data-lang-de="Marktplatz" data-lang-zh=" 市场" data-lang-jp="マーケットプレイス "
            data-lang-ru="Торговая площадка" data-lang-it="Mercato"
            data-lang-pt="Mercado" data-lang-ar="السوق">Marketplace</span>
              </a>
            </li>
            <li class="list">
              <a href="../social/social.php" class="nav-link">
                <i class="bx bx-camera icon"></i>
                <span class="link" data-lang-en="Social Media" data-lang-es=" Redes sociales" data-lang-fr="Médias sociaux"
            data-lang-de="Soziale Medien" data-lang-zh="社交媒体" data-lang-jp="ソーシャルメディア"
            data-lang-ru="Социальные сети" data-lang-it="Social Media"
            data-lang-pt="Mídias Sociais" data-lang-ar="وسائل التواصل الاجتماعي">Social Media</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/whether.php" class="nav-link">
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

    <Section class="main">
        <div class="container">
          <h1 data-lang-en="Top Tourist Destinations" data-lang-es="Principales Destinos Turísticos" data-lang-fr="Meilleures Destinations Touristiques"
            data-lang-de="Top-Touristenziele" data-lang-zh="顶级旅游目的地 (Dǐngjí Lǚyóu Mùdìdì)" data-lang-jp="トップ観光地 (Toppu Kankōchi)ター"
            data-lang-ru="Топ Туристических Направлений" data-lang-it="Principali Destinazioni Turistiche"
            data-lang-pt="Principais Destinos Turísticos" data-lang-ar="أفضل الوجهات السياحية ">Top Tourist Destinations</h1>
           
           
            <main>

              <div id="carousel" class="carousel">
              
                 <div id='item_1' class="hideLeft">
                  <a class="top" href="boracay.php"><img src="../places/pampanga/Travel Hunter - 9.png"></a>
                  
                </div>
              
                <div id='item_2' class="prevLeftSecond">
                  <a class="top" href="boracay.php"> <img src="../places/pampanga/Travel Hunter - 7.png"></a>
                 
                </div>
              
                <div id='item_3' class="prev">
                  <a class="top" href="boracay.php"> <img src="../places/pampanga/Travel Hunter - 6.png"></a>
                 
                </div>
              
                <div id='item_4' class="selected">
                  <a class="top" href="boracay.php"> <img src="../places/pampanga/Travel Hunter - 8.png"></a>
                 
                </div>
              
                <div id='item_5' class="next">
                  <a class="top" href="boracay.php">  <img src="../places/pampanga/Travel Hunter - 10.png"></a>
                
                </div>
              
                <div id='item_6' class="nextRightSecond">
                  <a class="top" href="boracay.html"> <img src="../places/palawan/Travel Hunter - 1.png"></a>
                 
                </div>
              
                <div id='item_7' class="hideRight">
                  <a class="top" href="boracay.html"> <img src="../places/palawan/Travel Hunter - 2.png"></a>
                 
                </div>
              
                <div id='item_8' class="hideRight">
                  <a class="top" href="boracay.html"> <img src="../places/palawan/Travel Hunter - 3.png"></a>
                 
                </div>
              
              </div>
              
              <div class="buttons">
                  <button class="button-82-pushable" role="button" id="prev"><span class="button-82-shadow"></span><span class="button-82-edge"></span><span class="button-82-front text"><span >&#139;</span></span></span></button>
              
              
                  <button class="button-82-pushable" role="button" id="next"><span class="button-82-shadow"></span><span class="button-82-edge"></span><span class="button-82-front text"><span >&#155;</span></span></button>
              </div>
              
              
              </main>
      
      
        </section>



        <section class="package">

<main>
<header>
<h1 data-lang-en="Top Tourist Destination in Pampanga" data-lang-es="Principal Destino Turístico en Pampanga" data-lang-fr="Meilleure Destination Touristique à Pampanga"
            data-lang-de="Top-Touristenziel in Pampanga" data-lang-zh="邦板牙的顶级旅游目的地" data-lang-jp="パンパンガのトップ観光地 "
            data-lang-ru="Топ Туристическое Направление в Пампанге" data-lang-it="Principale Destinazione Turistica a Pampanga"
            data-lang-pt="Principal Destino Turístico em Pampanga" data-lang-ar="أفضل وجهة سياحية في بامبانجا">Top Tourist Destination in Pampanga</h1>
<p>
 <span class="span1" >&#139;</span>
<span class="span1" >&#155;</span>
  
</p>
</header>
<section class="section6">
<div class="product">
  <picture>
  <img src="../places/pampanga/Travel Hunter - 9.png">
  </picture>
  <div class="detail">
    <p>
      <b data-lang-en="Summer Place(Palakol)" data-lang-es="Lugar de Verano (Palakol)" data-lang-fr="Endroit Estival (Palakol)"
            data-lang-de="Sommerort (Palakol)" data-lang-zh="夏日之地 " data-lang-jp="夏の場所"
            data-lang-ru="Летнее Место (Палакол)" data-lang-it="Luogo Estivo (Palakol)"
            data-lang-pt="Lugar de Verão (Palakol)" data-lang-ar="مكان الصيف ">Summer Place(Palakol) </b><br>
      <small data-lang-en="San Jose Floridablanca, Pampanga" data-lang-es="Lugar de Verano (Palakol)" data-lang-fr="Endroit Estival (Palakol)"
            data-lang-de="Sommerort (Palakol)" data-lang-zh="圣何塞佛罗里达布兰卡 " data-lang-jp="サン・ホセ・フロリダブランカ、パンパンガ "
            data-lang-ru="Сан-Хосе Флоридабланка, Пампанга" data-lang-it="Luogo Estivo (Palakol)"
            data-lang-pt="Lugar de Verão (Palakol)" data-lang-ar="سان خوسيه فلوريدابلانكا، بامبانج">San Jose Floridablanca, Pampanga</small>
    </p>
  </div>
 
</div>
<div class="product">
  <picture>
  <img src="../places/pampanga/nabuclod.jpg">
  </picture>
  <div class="detail">
    <p>
      <b data-lang-en="Nabuclod Mountain View" data-lang-es="Vista de la Montaña Nabuclod" data-lang-fr="Vue sur la Montagne Nabuclod"
            data-lang-de="Nabuclod-Bergblick" data-lang-zh="那布克洛德山景  " data-lang-jp=" ナブクロッドの山の眺め "
            data-lang-ru="Вид на Гору Набуклод" data-lang-it="Vista sulla Montagna Nabuclod"
            data-lang-pt="Vista da Montanha Nabuclod" data-lang-ar="إطلالة جبل نابوكلود ">Nabuclod Mountain View</b><br>
      <small data-lang-en="Nabuclod, Floridablanca, Pampanga" data-lang-es="Nabuclod, Floridablanca, Pampanga" data-lang-fr="Nabuclod, Floridablanca, Pampanga"
            data-lang-de="Nabuclod, Floridablanca, Pampanga" data-lang-zh=" 那布克洛德  " data-lang-jp=" ナブクロッド、フロリダブランカ、パンパンガ 眺め "
            data-lang-ru="Набуклод, Флоридабланка" data-lang-it="Nabuclod, Floridablanca, Pampanga"
            data-lang-pt="Nabuclod, Floridablanca, Pampanga" data-lang-ar="نابوكلود، فلوريدابلانكا، بامبانجا">Nabuclod, Floridablanca, Pampanga</small>
    </p>
  </div>
  <div class="button7">
    
   
  </div>
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/tungab1.jpg">
  </picture>
  <div class="detail">
    <p>
      <b data-lang-en="Tungab Lagoon" data-lang-es="Laguna Tungab" data-lang-fr="Lagon Tungab"
            data-lang-de="Tungab-Lagune" data-lang-zh=" 通加布泻湖 " data-lang-jp=" トゥンガブ潟湖  "
            data-lang-ru="Лагуна Тунгаб" data-lang-it="Laguna di Tungab"
            data-lang-pt="Lagoa Tungab" data-lang-ar="بحيرة تونجاب"> Tungab Lagoon</b><br>
      <small data-lang-en="Nabuclod, Floridablanca, Pampanga" data-lang-es="Nabuclod, Floridablanca, Pampanga" data-lang-fr="Nabuclod, Floridablanca, Pampanga"
            data-lang-de="Nabuclod, Floridablanca, Pampanga" data-lang-zh=" 那布克洛德  " data-lang-jp=" ナブクロッド、フロリダブランカ、パンパンガ 眺め "
            data-lang-ru="Набуклод, Флоридабланка" data-lang-it="Nabuclod, Floridablanca, Pampanga"
            data-lang-pt="Nabuclod, Floridablanca, Pampanga" data-lang-ar="نابوكلود، فلوريدابلانكا، بامبانجا">Nabuclod, Floridablanca, Pampanga</small>
    </p>
   
  </div>
  <div class="button7">
    
    
  </div>
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/sumuclab.jpg">
  </picture>
  <div class="detail">
    <p>
      <b data-lang-en="Sumuclab Lagoon" data-lang-es="Laguna Sumuclab" data-lang-fr="Lagon Sumuclab"
            data-lang-de="Sumuclab-Lagune" data-lang-zh=" 通加布泻湖 " data-lang-jp=" トゥンガブ潟湖  "
            data-lang-ru="Лагуна Тунгаб" data-lang-it="Laguna di Sumuclab"
            data-lang-pt="Lagoa Sumuclab" data-lang-ar="بحيرة تونجاب">Sumuclab Lagoon</b><br>
      <small data-lang-en="Nabuclod, Floridablanca, Pampanga" data-lang-es="Nabuclod, Floridablanca, Pampanga" data-lang-fr="Nabuclod, Floridablanca, Pampanga"
            data-lang-de="Nabuclod, Floridablanca, Pampanga" data-lang-zh=" 那布克洛德  " data-lang-jp=" ナブクロッド、フロリダブランカ、パンパンガ 眺め "
            data-lang-ru="Набуклод, Флоридабланка" data-lang-it="Nabuclod, Floridablanca, Pampanga"
            data-lang-pt="Nabuclod, Floridablanca, Pampanga" data-lang-ar="نابوكلود، فلوريدابلانكا، بامبانجا">Nabuclod, Floridablanca, Pampanga</small>
    </p>
    
  </div>
  <div class="button7">
    
   
  </div>
</div>
<div class="product">
  <picture>
    <img src="../places/Pampanga/puning1.jpg">
  </picture>
  <div class="detail">
    <p>
      <b data-lang-en="Puning Hot Spring" data-lang-es="Aguas Termales de Puning" data-lang-fr="Source Thermale de Puning"
            data-lang-de="Puning-Heißquelle" data-lang-zh=" 埔宁温泉 " data-lang-jp=" プニング温泉  "
            data-lang-ru="Горячий Источник Пуньин " data-lang-it="Sorgente Termale di Puning"
            data-lang-pt="Fonte Termal de Puning" data-lang-ar=" الينابيع الساخنة في بونينغ ">Puning Hot Spring</b><br>
      <small data-lang-en="Sapang Bato, Angeles City,Pampanga" data-lang-es="Sapang Bato, Ciudad de Angeles, Pampanga" data-lang-fr="Sapang Bato, Ville d'Angeles, Pampanga "
            data-lang-de="Sapang Bato, Angeles Stadt, Pampanga" data-lang-zh=" 萨庞巴托，安赫莱斯市，邦板牙  " data-lang-jp=" サパンバト、アンヘレス市、パンパンガ  "
            data-lang-ru="Сапанг Батo, Город Анджелес, Пампанга" data-lang-it=" Sapang Bato, Città di Angeles, Pampanga"
            data-lang-pt="Sapang Bato, Cidade de Angeles, Pampanga" data-lang-ar=" سابانغ باتو، مدينة أنجيليس، بامبانجا ">Sapang Bato, Angeles City,Pampanga</small>
    </p>
    
  </div>
  <div class="button7">
    
  </div>
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/mtp.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Mount Pinatubo</b><br>
      <small>Station 3, Front Beach Malay</small>
    </p>
   
  </div>
  <div class="button7">
   
   
  </div>
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/miyamit.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Miyamit Falls</b><br>
      <small>Baranggay Sapang Uwak, Porac,Pampanga</small>
    </p>
   
  </div>
  <div class="button7">
    
  </div>
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/mt arayat.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Mount Arayat National Park</b><br>
      <small> Arayat, Pampanga</small>
    </p>
  
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/ilog kamalig.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Ilog Kamalig </b><br>
      <small>Pio, Porac, Pampanga</small>
    </p>
   
  </div>
 
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/ana an.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Ana an Falls </b><br>
      <small>Inararo,Porac, Pampanga</small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/dara.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Dara Water Falls </b><br>
      <small> Jalung, Porac, Pampanga</small>
    </p>
   
  </div>
 
</div>
<div class="product">
  <picture>
  <img src="../places/Pampanga/Bigfalls.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Big Falls</b><br>
      <small>Pidpid, Porac, Pampanga</small>
    </p>
    
  </div>
  
</div>
</section>
</main>


<main>

<header>
<h1 data-lang-en="Top Tourist Destination in Boracay" data-lang-es="Principal Destino Turístico en Boracay" data-lang-fr="Meilleure Destination Touristique à Boracay"
            data-lang-de="Top-Touristenziel in Boracay" data-lang-zh="邦板牙的顶级旅游目的地" data-lang-jp="パンパンガのトップ観光地 "
            data-lang-ru="Топ Туристическое Направление в Пампанге" data-lang-it="Principale Destinazione Turistica a Boracay"
            data-lang-pt="Principal Destino Turístico em Boracay" data-lang-ar="أفضل وجهة سياحية في بامبانجا">Top Tourist Destination in Boracay</h1>
<p>
<span class="span2" >&#139;</span>
<span class="span2" >&#155;</span>
  
</p>
</header>
<section class="section6">
<div class="product">
  <picture>
  <img src="../places/boracay/white1.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>White Beach</b><br>
      <small>White Beach Station 1, Boracay Island, Malay, Philippines</small>
    </p>
   
  </div>
 
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/Puka Shell Beach.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Puka Shell Beach</b><br>
      <small> Malay, Aklan</small>
    </p>
    
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/ariel1.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Ariel's Point</b><br>
      <small>Batason, Buruanga, Malay, Aklan Province</small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/din.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Diniwid Beach</b><br>
      <small>Malay, Aklan.</small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/will.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Willy's Rock</b><br>
      <small>XW99+7FW, Malay, Aklan</small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/Iligiligan-beach.jpg">
  </picture>
  <div class="detail">
    <p>
      <b> Ilig Iligan Beach</b><br>
      <small> Malay, Aklan</small>
    </p>
  
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/mount-luho.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Mount Luho</b><br>
      <small>Malay, Aklan</small>
    </p>
   
  </div>
 
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/bulabog.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Bulabog Beach</b><br>
      <small>Malay, Aklan</small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/crystal.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Crystal Cove Island</b><br>
      <small>Tabon Point, Malay, Aklan </small>
    </p>
  
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/crocodile.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Crocodile Island</b><br>
      <small>Malay,Aklan</small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/baling.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Balinghai Beach</b><br>
      <small>Road-C, Malay, Aklan </small>
    </p>
   
  </div>
  
</div>
<div class="product">
  <picture>
  <img src="../places/boracay/tambisan.jpg">
  </picture>
  <div class="detail">
    <p>
      <b>Tambisaan Beach</b><br>
      <small>Malay, Aklan </small>
    </p>
  
  </div>
  
</div>
</section>
</main>



<main>
<div class="text">

</div>
<header>
<h1 data-lang-en="Top Hottest Products" data-lang-es="Los Productos Más Populares" data-lang-fr="Produits Les Plus Tendance"
            data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品" data-lang-jp="最も人気のある製品 "
            data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
            data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة ">Top Hottest Products</h1>
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


</Section>

      <section class="sec2">
        <h1>Explore Now!!!</h1>
          <div class="container2">
            <div class="main-video">
                <div class="Video">
                    <video class="secvid" src="../Places/Pampanga/mtpulag.mp4" controls
                        unmuted autoplay></video>
                    <h3 class="title">Nabuclod View Deck</h3>
                </div>
    
            </div>
    
            <div class="video-list">
                <div class="vid">
                    <video src="../Places/Pampanga/barundon.mp4"
                        muted></video>
                    <h3 class="title">Bamboo Park</h3>
                </div>
    
                <div class="vid">
                    <video src="../Places/Pampanga/caposes island.mp4"
                        muted></video>
                    <h3 class="title">Summer Place Palakol</h3>
                </div>
    
                <div class="vid">
                    <video
                        src="../vids/Montalban Trilogy Version 2 _ Mt. Susong Dalaga _ Mt. Parawagan _ Mt. Lagyo(720P_HD).mp4"
                        muted></video>
                    <h3 class="title">Susung Dalaga</h3>
                </div>
    
                <div class="vid">
                    <video src="../vids/Nabuclod Mountain View in Floridablanca_ Pampanga(720P_HD).mp4" muted></video>
                    <h3 class="title">Nabuclod</h3>
                </div>
    
                <div class="vid">
                    <video src="../yes we are/Forest Lake Florida blanca park.mp4" muted></video>
                    <h3 class="title">Forest Lake Floridablanca Pampanga</h3>
                </div>
    
                <div class="vid">
                    <video src="../vids/Facebook 692100841679786(720p).mp4" muted></video>
                    <h3 class="title">Sumuclab Lagoon</h3>
                </div>
    
                <div class="vid">
                    <video src="../vids/lv_0_20231205084131.mp4" muted></video>
                    <h3 class="title">Dara Falls</h3>
                </div>
    
                <div class="vid">
                    <video src="../vids/lv_0_20231205084601.mp4" muted></video>
                    <h3 class="title">Barundon View Deck</h3>
                </div>
    
                <div class="vid">
                    <video src="../vids/lv_0_20231205085158.mp4" muted></video>
                    <h3 class="title">Ilog Kamalig</h3>
                </div>
            </div>
    
    
            <script>
                // Your JavaScript code goes here
                let listVideo = document.querySelectorAll('.video-list .vid');
                let mainVideo = document.querySelector('.main-video video');
                let title = document.querySelector('.main-video .title');
    
                listVideo.forEach(video => {
                    video.onclick = () => {
                        listVideo.forEach(vid => vid.classList.remove('active'));
                        video.classList.add('active');
                        if (video.classList.contains('active')) {
                            let src = video.children[0].getAttribute('src');
                            mainVideo.src = src;
                            let text = video.children[1].innerHTML;
                            title.innerHTML = text;
    
                        };
    
                    };
                });
    
    
            </script>
    
       
 
    </Section>

    <script src="../js/home.js"></script>
    <script src="../js/index.js"></script>
    <script src="../js/darkmode.js"></script>
    <script src="../js/language.js"></script>
    <script src="../js/explore.js" defer></script>
    <script src="../js/script.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="../js/product.js"></script>
    <script src="../js/explore2.js" defer></script>
    <script type="text/javascript" src="../js/fin.js"></script>
  </body>
</html>