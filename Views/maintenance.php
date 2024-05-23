<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Maintenance</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Css/styles_Index.css">
    <link rel="stylesheet" href="../Css/styless.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined">search</span>
        </div>
        <div class="header-right">
          <span class="material-icons-outlined">notifications</span>
          
        
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">build</span> OPTech
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a href="../../Indexe.php">
              <span class="material-icons-outlined">dashboard</span> Acceuil
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="operation.php">
              <span class="material-icons-outlined">inventory_2</span> Operation
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="plannification.php">
              <span class="material-icons-outlined">fact_check</span> Plannification
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Stock.php">
              <span class="material-icons-outlined">add_shopping_cart</span> Stocks
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#">
              <span class="material-icons-outlined">folder_open</span> Repertoire
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Mission.php">
              <span class="material-icons-outlined">flight_takeoff</span> Missions
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">settings</span> Settings
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
<main class="main-container">
    <div class="main-title">
      <p class="font-weight-bold">MAINTENANCE</p>
    </div>
  
    <!-- Formulaire -->
    <div class="form-container">
      <div class="form-section">
        <p class="form-section-title">FICHE TECHNIQUE D'INTERVATION</p>
        <div class="group">
          <div class="checkbox-container">
            <div class="column">
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Installation
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Chang'mt SIM
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Chang'mt Lecteur
                </label>
              </div>
            </div>
            <div class="column">
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Desinstallation
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Chang'mt Boitier
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Chang'mt Relais
                </label>
              </div>
            </div>
            <div class="column">
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Reinstallation
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Chang'mt Antenne
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Vehicule non creer
                </label>
              </div>
            </div>
            <div class="column">
              <div class="checkbox-row">
                <label>
                  <input type="checkbox" checked>
                  Maintenance
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Chang'mt Badge
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Reboutage
                </label>
              </div>
            </div>
            <div class="column">
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Calibrage
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  RAS
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Instal corrigé
                </label>
              </div>
            </div>
            <div class="column">
              <div class="checkbox-row">
                <label>
                 
                  
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  
                
                </label>
              </div>
              <div class="checkbox-row">
                <label>
                  <input type="checkbox">
                  Défaut GSM
                </label>
              </div>
            </div>
          </div>
        </div>
    
    </div>
</div>
        
      <div class="form-section">
        <p class="form-section-title">INFORMATIONS</p>
        <div class="input-container">
            <input type="number" placeholder="IMEI" class="text-input">
            <input type="text" placeholder="NOM DE CLIENT" class="text-input">
            <input type="text" placeholder="LIEU D'INTERVENTION " class="text-input">
            <input type="text" placeholder="MARQUE DU VEHICULE" class="text-input">
            <input type="text" placeholder="CHASSIS DU VEHICULE" class="text-input">
            <input type="text" placeholder="IMMATRICULATION"class="text-input">
            <input type="text" placeholder="ANNEE DE MISE EN CIRCULATION" class="text-input">
            <input type="text" placeholder="INDEX KILO" class="text-input">
            <input type="number" placeholder="N° CARTE SIM" class="text-input">
            <input type="number" placeholder="PUK CARTE SIM " class="text-input">
            <input type="number" placeholder="ANCIEN ICCID" class="text-input">
            <input type="number" placeholder="NOUVEAU  ICCID "class="text-input">
            <input type="text" placeholder="OBSERVATION avnt intervention "class="text-input">
            <input type="text" placeholder="NOM DU TECHNICIEN "class="text-input">
          
        </div>
      </div>

      <div class="form-container">
    <h2>MATERIEL COMPLEMENTAIRE</h2>
    <div class="group">
      <div class="checkbox-container">
        <div class="column">
          <div class="checkbox-row">
            <label>
              Badge/Id Chauffeur
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              Sonde
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              Caméra
            </label>
          </div>
        </div>
        <div class="column">
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              OUI
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              OUI
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              OUI
            </label>
          </div>
        </div>
        <div class="column">
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              NON
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              NON
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              NON
            </label>
          </div>
        </div>
      
      </div>
    </div>

    
    <h2>PRECONFIGURATION</h2>
    <div class="group">
      <div class="checkbox-container">
        <div class="column">
          <div class="checkbox-row">
            <label>
              Buzzer paramétré
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              Bouton d'alerte paramétré
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              Test Commande d'immobilisation
            </label>
          </div>
        </div>
        <div class="column">
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              OUI
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              OUI
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              OUI
            </label>
          </div>
        </div>
        <div class="column">
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              NON
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              NON
            </label>
          </div>
          <div class="checkbox-row">
            <label>
              <input type="checkbox">
              NON
            </label>
          </div>
        </div>
      
      </div>

</div>

  </main>
  <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>