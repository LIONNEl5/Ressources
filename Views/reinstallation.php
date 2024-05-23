<?php
require '../required/db_connect.php';
if (
  isset($_POST['date']) &&
  isset($_POST['HD']) &&
  isset($_POST['HA']) &&
  isset($_POST['HF']) &&
  isset($_POST['HDP']) &&
  isset($_POST['imei']) &&
  isset($_POST['nom_client']) &&
  isset($_POST['lieu_intervention']) &&
  isset($_POST['chassis_vehicule']) &&
  isset($_POST['sim_iccid']) &&
  isset($_POST['observation_avant']) &&
  isset($_POST['observation_apres']) &&
  isset($_POST['nom_technicien'])

) {
$imei = $_POST['imei'];
$nom_client = $_POST['nom_client'];
$lieu_intervention = $_POST['lieu_intervention'];
$chassis_vehicule = $_POST['chassis_vehicule'];
$sim_iccid = $_POST['sim_iccid'];
$observation_avant = $_POST['observation_avant'];
$observation_apres = $_POST['observation_apres'];
$nom_technicien = $_POST['nom_technicien'];
$date = $_POST['date'];
    $heureD = $_POST['HD'];
    $heureA = $_POST['HA'];
    $heureF = $_POST['HF'];
    $heureDP = $_POST['HDP'];



    $so = $_POST['so'];
    $ca = $_POST['ca'];

$req_up0="UPDATE base_boitier
SET Statut = 'Suspend'
WHERE  IMEI='$imei'";
if (mysqli_query($conn, $req_up0)) {
echo "modif reussi";
}

$req_up1="UPDATE VEHICULE
SET Statut = 'desinstaller'
WHERE Chassis ='$chassis_vehicule'";
if (mysqli_query($conn, $req_up1)) {
echo "modif reussi";

$req_up2="UPDATE carte_sim
SET Statut = 'suspendu'
WHERE ICCID=$sim_iccid";
if (mysqli_query($conn, $req_up2)) {
echo "modif reussi";
}


  $req_insert1 = "INSERT INTO INTERVENTION(Lieu_intervention,Date_intervention,HeureDebut,HeureFin,HeureArriver,HeureDepart,Statut)VALUES('$lieu_intervention', '$date', '$heureD', '$heureF','$heureA','$heureDP','$observation_apres')";
  if (mysqli_query($conn, $req_insert1)) {
$dernierId1 = mysqli_insert_id($conn);
echo "Enregistrement inséré avec succès2";
   
$req_se1="SELECT VehiculeID FROM VEHICULE
WHERE Chassis ='$chassis_vehicule'";
  if (mysqli_query($conn, $req_se1)) {
  echo "modif reussi";
  $dernierId = mysqli_insert_id($conn);


$req_insert0 = "INSERT INTO CLIENT(Nom,Telephone,Email,VehiculeID,InterventionID)  VALUES ('$nom_client', '', '', '$dernierId','$dernierId1')";
    if (mysqli_query($conn, $req_insert0)) {
    $dernierId0 = mysqli_insert_id($conn);
    echo "Enregistrement inséré avec succès2";
 
   $req_insert2 = "INSERT INTO DESINSTALLATION(ICCID,NUM_SERIE_CA,NUM_SERIE_SO,IMEI,InterventionID )VALUES ('$sim_iccid', '$ca', '$so','$imei','$dernierId1')";
       if (mysqli_query($conn, $req_insert2)) {
    $dernierId2 = mysqli_insert_id($conn);
    echo "Enregistrement inséré avec succès2";

        }
      }
    }
  

  /* Traiter le cas où aucune checkbox "OUI" n'est cochée
  if (!$badgeIdChauffeurOui && !$sondeOui && !$cameraOui) {
      echo "Aucune checkbox 'OUI' n'a été cochée.<br>";
  }
    */
 }else{
    echo "Enregistrement echec avec succès1";
  }
}else{


}

}else{
  echo "tout n'est pas bon";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Installation</title>

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
      <p class="font-weight-bold">INSTALLATION</p>
    </div>
  
    <!-- Formulaire -->
    <div class="form-container">
      <div class="form-section">
        <p class="form-section-title">FICHE TECHNIQUE D'INTERVENTION</p>
        <form method="POST" action="#">
        <div class="group">
        <div class="input-container">
          <h4>DATE</h4>
        <input type="DATE" placeholder="DATE" class="text-input" name="date">
          <div class="checkbox-container">

          </div>
        </div>
    
    </div>
</div>
        
      <div class="form-section">
        <p class="form-section-title">INFORMATIONS</p>
        <div class="input-container">
          <form method="POST" action="#">
          <input type="number" placeholder="IMEI" class="text-input" name="imei">
<input type="text" placeholder="NOM DE CLIENT" class="text-input" name="nom_client">
<input type="text" placeholder="LIEU D'INTERVENTION " class="text-input" name="lieu_intervention">
<input type="text" placeholder="CHASSIS DU VEHICULE" class="text-input" name="chassis_vehicule">
<input type="number" placeholder="SIM ICCID " class="text-input" name="sim_iccid">
<input type="text" placeholder="OBSERVATION avnt intervention " class="text-input" name="observation_avant">
<input type="text" placeholder="OBSERVATION apres intervention " class="text-input" name="observation_apres">
<input type="text" placeholder="NOM DU TECHNICIEN " class="text-input" name="nom_technicien">
           

            
          
        </div>
      </div>

    </div>
<div class="form-container">
<div class="input-container">
  <div class=column>
  <label>HEURE D'ARRIVE  </label><input type="TIME" placeholder="HEURE D'ARRIVE "class="text-input" name="HA">
  </div>
  <div class=column>
  <label>HEURE DE DEBUT  </label><input type="TIME" placeholder="HEURE D'ARRIVE "class="text-input" name="HD">
  </div>
  <div class=column>
  <label>HEURE DE FIN  </label><input type="TIME" placeholder="HEURE D'ARRIVE "class="text-input" name="HF">
  </div>
  <div class=column>
  <label>HEURE DE DEPART  </label><input type="TIME" placeholder="HEURE D'ARRIVE " class="text-input" name="HDP">
</div>

</div>
<input type="submit" value="Enregistrer" class="text-submit">
</form>
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