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
    <link rel="stylesheet" href="../style/marketplace.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
  </head>
  <body>
    <nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">TravelHunter</span>
       
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

  <div class="bottom-cotent">
    <li class="list">
      <a href="profile.php?id=<?php echo $user['id']; ?>" class="nav-link">
        <i class="bx bx-cog icon"></i>
        <span class="link" data-lang-en="Profile" data-lang-es="perfil" data-lang-fr="profil"
    data-lang-de="Profil" data-lang-zh="輪廓" data-lang-jp="プロフィール"
    data-lang-ru="профиль" data-lang-it="profilo"
    data-lang-pt="perfil" data-lang-ar="حساب تعريفي">Profile</span>
      </a>
    </li>


    <li class="list">
      <a href="logout.php" class="nav-link">
        <i class="bx bx-log-out icon"></i>
        <span class="link" data-lang-en="Logout" data-lang-es="cerrar sesión" data-lang-fr="Se déconnecter"
    data-lang-de="Ausloggen" data-lang-zh="登出" data-lang-jp="ログアウト"
    data-lang-ru="выйти" data-lang-it="disconnettersi"
    data-lang-pt="sair" data-lang-ar="تسجيل خروج">Logout</span>

    
      </a>
    </li>
  </div>
</div>
</div>
</nav>

    <section class="overlay"></section>

    <Section class="main">
   

<main>
<div class="text">

</div>
<header>
<h1 data-lang-en="Top Hottest Products in Pampanga" data-lang-es="Los productos más populares en Pampanga" data-lang-fr="Les produits les plus populaires à Pampanga"
            data-lang-de="Die heißesten Produkte in Pampanga" data-lang-zh=" 邦板牙最热门的产品" data-lang-jp=" パンパンガで最も人気のある商品"
            data-lang-ru="Самые популярные товары в Пампанге" data-lang-it=" I prodotti più popolari a Pampanga"
            data-lang-pt="Os produtos mais populares em Pampanga" data-lang-ar="المنتجات الأكثر شعبية في بامبانغا">Top Hottest Products in Pampanga</h1>
<p>
<span class="span1" >&#139;</span>
<span class="span1" >&#155;</span>
  
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
<span class="span2" >&#139;</span>
<span class="span2" >&#155;</span>
  
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
   
    <a class="a1" href="#">Buy Now!!</a>
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
    
    <a class="a1" href="#">Buy Now!!</a>
  </div>
</div>
</section>
</main>







        </section>
    
    <script src="../js/home.js"></script>
    <script src="../js/darkmode.js"></script>
    <script src="../js/language.js"></script>
    <script src="../js/explore.js" defer></script>
    <script src="../js/script.js"></script>
    <script src="../js/fin.js"></script>
    <script src="../js/product.js"></script>
    <script src="../js/market1.js"></script>
  </body>
</html>