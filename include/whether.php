<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Travel Hunter</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../style/whether.css">
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
                <span class="link" data-lang-en="Home" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Home</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/categories.html" class="nav-link">
                <i class="bx bx-menu icon"></i>
                <span class="link" data-lang-en="Categories" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Categories</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/place.html" class="nav-link">
                <i class="bx bx-map icon"></i>
                <span class="link" data-lang-en="Place" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Place</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/marketplace.html" class="nav-link">
                <i class="bx bx-gift icon"></i>
                <span class="link" data-lang-en="Marketplace" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Marketplace</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/social.html" class="nav-link">
                <i class="bx bx-camera icon"></i>
                <span class="link" data-lang-en="Social Media" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Social Media</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/whether.html" class="nav-link">
                <i class="bx bx-cloud icon"></i>
                <span class="link" data-lang-en="Whether Forecast" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Whether Forecast</span>
              </a>
            </li>
            <li class="list">
              <a href="../include/itenerary.html" class="nav-link">
                <i class="bx bx-note icon"></i>
                <span class="link" data-lang-en="My Itinerary" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">My Itinerary</span>
              </a>
            </li>
          </ul>

          <div class="bottom-cotent">
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bx-cog icon"></i>
                <span class="link" data-lang-en="Profile" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Profile</span>
              </a>
            </li>
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bx-log-out icon"></i>
                <span class="link" data-lang-en="Logout" data-lang-es="Cazador de viajes" data-lang-fr="Chasseur de voyages"
            data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
            data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi"
            data-lang-pt="Caçador de viagens" data-lang-ar="صياد السفر">Logout</span>
              </a>
            </li>
          </div>
        </div>
      </div>
    </nav>

    <section class="overlay"></section>

    <Section class="main">
      <h1>Weather Forecast</h1>
      <div class="container">
        <div class="weather-input">
          <h3>Enter a Destination</h3>
          <input class="city-input" type="text" placeholder="E.g., Batanes, Palawan, Boracay">
          <button class="search-btn">Search</button>
          <div class="separator"></div>
          <button class="location-btn">Use Current Location</button>
        </div>
        <div class="weather-data">
          <div class="current-weather">
            <div class="details">
              <h2>_______ ( ______ )</h2>
              <h6>Temperature: __°C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </div>
          </div>
          <div class="days-forecast">
            <h2>5-Day Forecast</h2>
            <ul class="weather-cards">
              <li class="card">
                <h3>( ______ )</h3>
                <h6>Temp: __C</h6>
                <h6>Wind: __ M/S</h6>
                <h6>Humidity: __%</h6>
              </li>
              <li class="card">
                <h3>( ______ )</h3>
                <h6>Temp: __C</h6>
                <h6>Wind: __ M/S</h6>
                <h6>Humidity: __%</h6>
              </li>
              <li class="card">
                <h3>( ______ )</h3>
                <h6>Temp: __C</h6>
                <h6>Wind: __ M/S</h6>
                <h6>Humidity: __%</h6>
              </li>
              <li class="card">
                <h3>( ______ )</h3>
                <h6>Temp: __C</h6>
                <h6>Wind: __ M/S</h6>
                <h6>Humidity: __%</h6>
              </li>
              <li class="card">
                <h3>( ______ )</h3>
                <h6>Temp: __C</h6>
                <h6>Wind: __ M/S</h6>
                <h6>Humidity: __%</h6>
              </li>
            </ul>
          </div>
        </div>
      </div>
  
    </Section>

    <script src="../js/home.js"></script>
    <script src="../js/language.js"></script>
    <script src="../js/whether.js" defer></script>
  </body>
</html>
























































