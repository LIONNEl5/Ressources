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
  isset($_POST['marque_vehicule']) &&
  isset($_POST['chassis_vehicule']) &&
  isset($_POST['sim_iccid']) &&
  isset($_POST['observation_avant']) &&
  isset($_POST['observation_apres']) &&
  isset($_POST['nom_technicien'])
) {
  $imei = $_POST['imei'];
  $nom_client = $_POST['nom_client'];
  $lieu_intervention = $_POST['lieu_intervention'];
  $marque_vehicule = $_POST['marque_vehicule'];
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

  function changmt_sim() {
    global $conn,$chassis_vehicule,$sim_iccid,$date;
    $req_sup = "SELECT i.ICCID, i.NUM_SERIE_CA, i.NUM_SERIE_SO, i.IMEI
              FROM vehicule v
              JOIN installation i ON v.InterventionID = i.InterventionID
              WHERE v.Chassis = '$chassis_vehicule'";

    $resultes = mysqli_query($conn, $req_sup);

    if ($resultes && mysqli_num_rows($resultes) > 0) {
      while ($rowes = mysqli_fetch_assoc($resultes)) {
        $ICCID = $rowes['ICCID'];
        $IMEI = $rowes['IMEI'];
        $ca = $rowes['NUM_SERIE_CA'];
        $so = $rowes['NUM_SERIE_SO'];
      }
      $query = "SELECT * FROM carte_sim WHERE ICCID = '$ICCID'";
      $result = mysqli_query($conn, $query);

      $query2 = "SELECT * FROM carte_sim WHERE ICCID = '$sim_iccid'";
      $results = mysqli_query($conn, $query2);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $status = $row['Statut'];
        }
        if ($status == "Actif") {
          $req_up2 = "UPDATE carte_sim 
              SET Statut = 'suspendu', 
                  Date_Suspension = '$date'
              WHERE ICCID = '$ICCID'";
          if (mysqli_query($conn, $req_up2)) {
            echo "Modification réussie";
          }
        }
      }

      if ($results && mysqli_num_rows($results) > 0) {
        while ($rows = mysqli_fetch_assoc($results)) {
          $status = $rows['Statut'];
        }
        if ($status == "EN STOCK") {
          $req_up2 = "UPDATE carte_sim SET Statut = 'Actif' WHERE ICCID = '$sim_iccid'";
          if (mysqli_query($conn, $req_up2)) {
            echo "Modification réussie";
          }
        }
      }
    }
  }

  function changmt_boitier() {
        global $conn,$imei,$IMEI;

    $query = "SELECT * FROM base_boitier WHERE IMEI = '$IMEI'";
    $result = mysqli_query($conn, $query);

    $query2 = "SELECT * FROM base_boitier WHERE IMEI = '$imei'";
    $results = mysqli_query($conn, $query2);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['Statut'];
      }
      if ($status == "Actif") {
        $req_up2 = "UPDATE base_boitier SET Statut = 'suspendu' WHERE IMEI = '$IMEI'";
        if (mysqli_query($conn, $req_up2)) {
          echo "Modification réussie";
        }
      }
    }

    if ($results && mysqli_num_rows($results) > 0) {
      while ($rows = mysqli_fetch_assoc($results)) {
        $status = $rows['Statut'];
      }
      if ($status == "EN STOCK") {
        $req_up2 = "UPDATE base_boitier SET Statut = 'Actif' WHERE IMEI = '$imei'";
        if (mysqli_query($conn, $req_up2)) {
          echo "Modification réussie";
        }
      }
    }
  }

  function autre_chgmt() {
    // Implémentez la logique pour d'autres changements ici
  }

  $req_insert1 = "INSERT INTO INTERVENTION(Lieu_intervention, Date_intervention, HeureDebut, HeureFin, HeureArriver, HeureDepart, Statut) 
                  VALUES ('$lieu_intervention', '$date', '$heureD', '$heureF', '$heureA', '$heureDP', '$observation_apres')";
  if (mysqli_query($conn, $req_insert1)) {
    $dernierId1 = mysqli_insert_id($conn);
    echo "Enregistrement inséré avec succès";

    $req_insert2 = "INSERT INTO VEHICULE(Marque, Chassis, Immatriculation, Index_kilo, Annee_circulation, InterventionID, Statut)
                    VALUES ('$marque_vehicule', '$chassis_vehicule', '', '', '', '$dernierId1', 'Actif')";
    if (mysqli_query($conn, $req_insert2)) {
      $dernierId2 = mysqli_insert_id($conn);
      echo "Enregistrement inséré avec succès";
    }

    $req_insert0 = "INSERT INTO CLIENT(Nom, Telephone, Email, VehiculeID, InterventionID) 
                    VALUES ('$nom_client', '', '', '$dernierId2', '$dernierId1')";
    if (mysqli_query($conn, $req_insert0)) {
      $dernierId0 = mysqli_insert_id($conn);
      echo "Enregistrement inséré avec succès";
    }

    if (isset($_POST['changmt_sim'])&&isset($_POST['changmt_boitier'])) {
      changmt_sim();
      changmt_boitier();
      $req_insert3 = "INSERT INTO MAINTENANCE(IMEI_FINAL, ICCID_FINAL, NUM_SERIE_CA, NUM_SERIE_SO, InterventionID, description)
                      VALUES ('$imei', '$sim_iccid', '$ca', '$so', '$dernierId1', 'maint')";
      if (mysqli_query($conn, $req_insert3)) {
        $dernierId3 = mysqli_insert_id($conn);
        echo "Enregistrement inséré avec succès";
      }
    }
    }else if(!isset($_POST['changmt_boitier'])){
      $req_sup = " SELECT 
      i.ICCID, 
      i.NUM_SERIE_CA,
      i.NUM_SERIE_SO,
      i.IMEI
    FROM 
      vehicule v
    JOIN 
      installation i ON v.InterventionID = i.InterventionID
    WHERE 
      v.Chassis = '$chassis_vehicule'
    ";
    
    $resultes = mysqli_query($conn, $req_sup);
    if ($resultes && mysqli_num_rows($resultes) > 0) {
    while ($rowes = mysqli_fetch_assoc($resultes)) {
      $ICCID = $rowes['ICCID'];
      $IMEI = $rowes['IMEI'];
      $ca=$rowes['NUM_SERIE_CA'];
      $so=$rowes['NUM_SERIE_SO'];
      // Vous pouvez maintenant utiliser les valeurs de $ICCID et $IMEI
    }
    $req_insert3 = "INSERT INTO MAINTENANCE(IMEI_FINAL,ICCID_FINAL,NUM_SERIE_CA,NUM_SERIE_SO,InterventionID,description)VALUES ('$IMEI', '$ICCID', '$ca','$so','$dernierId1','maint')";
    if (mysqli_query($conn, $req_insert3)) {
    $dernierId3 = mysqli_insert_id($conn);
    echo "Enregistrement inséré avec succès2";
    }
    }
    }
    }
  

?>
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
        <form method="POST" action="#">
        <div class="group">
        <div class="input-container">
          <h4>DATE</h4>
        <input type="DATE" placeholder="DATE" class="text-input" name="date">
        </div>
        <p></p>
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
                <input type="checkbox" name="changmt_sim" id="changmt_sim">
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
                <input type="checkbox" name="changmt_boitier" id="changmt_boitier">
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
          <input type="number" placeholder="NOUVELLE IMEI" class="text-input" name="imei" id="nimei" disabled>
<input type="text" placeholder="NOM DE CLIENT" class="text-input" name="nom_client">
<input type="text" placeholder="LIEU D'INTERVENTION " class="text-input" name="lieu_intervention">
<input type="text" placeholder="MARQUE DU VEHICULE" class="text-input" name="marque_vehicule">
<input type="text" placeholder="CHASSIS DU VEHICULE" class="text-input" name="chassis_vehicule">
<input type="number" placeholder=" NOUVELLE ICCID " class="text-input" name="sim_iccid" id="sim_iccid" disabled>
<input type="text" placeholder="OBSERVATION avnt intervention " class="text-input" name="observation_avant">
<input type="text" placeholder="OBSERVATION apres intervention " class="text-input" name="observation_apres">
<input type="text" placeholder="NOM DU TECHNICIEN " class="text-input" name="nom_technicien">
          
        </div>
      </div>

    <div class="form-container">
    <h2>MATERIEL COMPLEMENTAIRE</h2>
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
      </div></div></div>
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
<script>
document.getElementById('changmt_sim').addEventListener('change', function() {
  const simNumberInput = document.getElementById('sim_iccid');
  if (this.checked) {
    simNumberInput.disabled = false;
  } else {
    simNumberInput.disabled = true;
  }
});
document.getElementById('changmt_boitier').addEventListener('change', function() {
  const IMEIInput = document.getElementById('nimei');
  if (this.checked) {
    IMEIInput.disabled = false;
  } else {
    IMEIInput.disabled = true;
  }
});

</script>

    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>