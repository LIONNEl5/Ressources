<?php
require '../required/db_connect.php';

$date = $_POST['date'];
$numero_commande = $_POST['numco'];
$leasing = $_POST['leasing'];
$nombre_vehicule = $_POST['nombre_vehicule'];
$marque_vehicule = $_POST['marque_vehicule'];
$lieu_intervention = $_POST['lieu_intervention'];
$concessionaire = $_POST['concessionaire'];
$reference_facture = $_POST['reference_facture'];

$services = array();
if (isset($_POST['service1'])) {
    $services[] = "Kid Tracking";
}
if (isset($_POST['service2'])) {
    $services[] = "Service Sondes";
}
if (isset($_POST['service3'])) {
    $services[] = "Services Badges & key";
}
if (isset($_POST['service4'])) {
    $services[] = "Camera embarquée";
}
if (isset($_POST['service5'])) {
    $services[] = "RFID services";
}

$designation = implode(", ", $services);
$req_insert1 = "INSERT INTO commande (Numero_Bon,Date_reception, Designation, Reference, nombre_vehicule, marque_vehicule)
                VALUES ('$numero_commande','$date','$designation', '$reference_facture', '$nombre_vehicule', '$marque_vehicule')";

if (mysqli_query($conn, $req_insert1)) {
    echo "Enregistrement réussi dans la table 'commande'";
} else {
    echo "Erreur lors de l'enregistrement dans la table 'commande' : ";
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Operation</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Css/styles_Index.css">
    <link rel="stylesheet" href="../Css/stales.css">
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
            <a href="commande.php">
              <span class="material-icons-outlined">article</span> Commande
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
    <p class="font-weight-bold"><strong>BON DE COMMANDE</strong></p>
  </div>
 <!-- Formulaire -->
 <div class="form-container">
      <div class="form-section">
        <p class="form-section-title">FICHE DE COMMANDE </p>
        <form method="POST" action="#">
        <div class="group">
        <div class="input-container">
          <h4>DATE</h4>
        <input type="DATE" placeholder="DATE" class="text-input" name="date">
        <h4>ENTREPRISE(CLIENT)</h4>
<select id="my-select" name="my-select"  class="texta-input" >
  <option value="">-- Choisissez une option --</option>
  <option value="option1">Option 1</option>
  <option value="option2">Option 2</option>
  <option value="option3">Option 3</option>
</select>
<h4>N° BON DE COMMANDE</h4>
        <input type="number" placeholder="numero" class="text-input" name="numco">
</div>
          <div class="checkbox-container">
           
          </div>
        </div>
    
    </div>
</div>    
      <div class="form-section">
        <p class="form-section-title">ENREGISTREMENT</p>
         <div class="input-container">
    <input type="text" placeholder="Leasing" class="text-input" name="leasing">
    <input type="text" placeholder="NOMBRE DE VEHICULE" class="text-input" name="nombre_vehicule">
    <input type="text" placeholder="MARQUE DU VEHICULE" class="text-input" name="marque_vehicule">
    <input type="text" placeholder="LIEU D'INTERVENTION" class="text-input" name="lieu_intervention">
    <input type="text" placeholder="CONCESSIONAIRE" class="text-input" name="concessionnaire">
    <input type="text" placeholder="REFERENCE(Facture)" class="text-input" name="reference_facture">
  </div>
</div>

<div class="form-section">
  <p class="form-section-title">OPERATIONS DESIGNEES</p>
  <div class="input-containers">
    <h4>Veuillez sélectionner les services souhaités :</h4>
    <div class="checkbox-container">
      <label>
        <input type="checkbox" name="service1" value="service1"> Kid Tracking
      </label>
      <label>
        <input type="checkbox" name="service2" value="service2"> Service Sondes
      </label>
      <label>
        <input type="checkbox" name="service3" value="service3"> Services Badges & key
      </label>
      <label>
        <input type="checkbox" name="service4" value="service4"> Camera embarquée
      </label>
      <label>
        <input type="checkbox" name="service5" value="service5"> RFID services 
      </label>
    </div>
    <p></p>
    <textarea placeholder="Commentaires / Remarques" class="text-input" name="comments"></textarea>
  </div>
</div>

<div class="form-actions">
  <button type="submit" class="text-submit">Envoyer</button>
</div>
</div> </main>
<!-- End Main -->
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>