<?php
require '../required/db_connect.php';
if (
  isset($_POST['name']) &&
  isset($_POST['object']) &&
  isset($_POST['vehnum']) &&
  isset($_POST['daynum']) &&
  isset($_POST['ddate']) &&
  isset($_POST['rdate'])&&
  isset($_POST['trajet'])
) {
  $nom = $_POST['name'];
  $objet = $_POST['object'];
  $nombreVehicules = $_POST['vehnum'];
  $nombreJours = $_POST['daynum'];
  $dateDepart = $_POST['ddate'];
  $dateRetour = $_POST['rdate'];
  $trajet=$_POST['trajet'];

  $req_insert = "INSERT INTO MISSION(OBJET, DATE_DEPART, DATE_ARRIVE, NOMBRE_DE_JOUR, NOMBRE_VEHICULE,DESCRIPTION_TRAJET) VALUES ('$objet', '$dateDepart', '$dateRetour', $nombreJours, $nombreVehicules,'$trajet')";

    if (mysqli_query($conn, $req_insert)) {
      $dernierId = mysqli_insert_id($conn);
      echo "Enregistrement inséré avec succès";
          $query="SELECT DEPARTEMENT FROM personnel WHERE NOM='$nom'";
          $results = mysqli_query($conn, $query);
            if ($results && mysqli_num_rows($results) > 0) {
                $rows = mysqli_fetch_assoc($results);
                $fonction = $rows['DEPARTEMENT'];
            }
      if($fonction=="TECHNIQUE"){
        $req_sel1="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(2000,'TAXI',$dernierId)";
        $req_sel2="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(1000,'COMMUNICATION',$dernierId)";
        $req_sel3="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(5000,'RESTAURATION',$dernierId)";
        $req_sel4="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(12000,'HEBERGEMENT',$dernierId)";
        $req_sel5="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(4000,' Autres',$dernierId)";
        if (mysqli_query($conn, $req_sel1)&&mysqli_query($conn, $req_sel2) && mysqli_query($conn, $req_sel3)&&mysqli_query($conn, $req_sel4)&&mysqli_query($conn, $req_sel5)) {
          echo "Enregistrement inséré avec succès";
        
        } else {
          echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($conn);
        }
      }else{
            $req_sel1="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(2000,'TAXI',$dernierId)";
            $req_sel2="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(2000,'COMMUNICATION',$dernierId)";
            $req_sel3="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(5000,'RESTAURATION',$dernierId)";
            $req_sel4="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(15000,'HEBERGEMENT',$dernierId)";
            $req_sel5="INSERT INTO FRAIS(MONTANT,DESCRIPTIONS,ID_MISSION)value(3000,' Autres',$dernierId)";
      if (mysqli_query($conn, $req_sel1)&&mysqli_query($conn, $req_sel2) && mysqli_query($conn, $req_sel3)&&mysqli_query($conn, $req_sel4)&&mysqli_query($conn, $req_sel5)) {
    echo "Enregistrement inséré avec succès";
  
  } else {
    echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($conn);
  }

      }


}
$req_inform="SELECT MATRICULE FROM personnel WHERE NOM='$nom'";
$result_inform= mysqli_query($conn, $req_inform);
if ($result_inform && mysqli_num_rows($result_inform) > 0) {
  $rowl = mysqli_fetch_assoc($result_inform);
  $mat = $rowl['MATRICULE'];
}

$req_tek = "INSERT INTO technicien (ID_MISSION, MATRICULE) VALUES ($dernierId, '$mat')";
if (mysqli_query($conn, $req_tek)){
  echo "Enregistrement inséré avec succès";
} else {
  echo "Erreur lors de l'insertion de l'enregistrement : " . mysqli_error($conn);
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
    <link rel="stylesheet" href="../Css/mission.css">
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
            <a href="#" >
              <span class="material-icons-outlined">settings</span> Settings
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
  <form method="POST" action="#">
    <div class="form-container">
      <div class="form-section">
        <p class="form-section-title">INFORMATIONS</p>
        <div class="input-container">
          <label for="nom">Nom :</label>
          <select id="nom" name="name" class="text-input" required>
            <option value="">Sélectionnez un nom</option>
            <?php
          
            // Récupérer les noms et fonctions depuis la base de données
            require '../required/db_connect.php';
            $sql = "SELECT NOM, DEPARTEMENT FROM personnel";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<option value=\"" . $row["NOM"] . "\">" . $row["NOM"] . "</option>";
              }
            } else {
              echo "<option value=\"\">Aucun nom disponible</option>";
            }
            ?>
          </select>
          <label for="objet-mission">Objet de la mission :</label>
          <input type="text" id="objet-mission" name="object" class="text-input" required>

          <label for="nombre-vehicules">Nombre de véhicules :</label>
          <input type="number" id="nombre-vehicules" name="vehnum" class="text-input" required>

          <label for="nombre-jours">Nombre de jours :</label>
          <input type="number" id="nombre-jours" name="daynum" class="text-input" required>

          <label for="date-depart">Date et heure de départ effectif :</label>
          <input type="text" id="date-depart" name="ddate" class="text-input" required>

          <label for="date-retour">Date et heure de retour effectif :</label>
          <input type="text" id="date-retour" name="rdate" class="text-input" readonly required>
        </div>
      </div>
    </div>

    <div class="form-container">
      <div class="form-section">
      <label for="nom">Trajet :</label>
      <p></p>
          <select id="trajet" name="trajet" class="text-input" required>
            <option value="">Sélectionnez un trajet</option>
            <?php
          
            // Récupérer les noms et fonctions depuis la base de données
            require '../required/db_connect.php';
            $sql = "SELECT DESCRIPTION_TRAJET FROM trajet";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<option value=\"" . $row["DESCRIPTION_TRAJET"] . "\">" . $row["DESCRIPTION_TRAJET"] . "</option>";
              }
            } else {
              echo "<option value=\"\">Aucun trajet disponible</option>";
            }
            ?>
          </select>
      </div>




<script>

  // Remplissage automatique de la date de retour en fonction de la date de départ et du nombre de jours
  const departureInput = document.getElementById('date-depart');
const returnInput = document.getElementById('date-retour');
const daysInput = document.getElementById('nombre-jours');

departureInput.addEventListener('input', () => {
  const departureDate = new Date(departureInput.value);
  const returnDate = new Date(departureDate.getTime() + (daysInput.value * 24 * 60 * 60 * 1000));

  // Formatage de la date de retour
  const returnDateString = returnDate.toISOString().slice(0, 16).replace('T', ' ');
  returnInput.value = returnDateString;
});

daysInput.addEventListener('input', () => {
  const departureDate = new Date(departureInput.value);
  const returnDate = new Date(departureDate.getTime() + (daysInput.value * 24 * 60 * 60 * 1000));

  // Formatage de la date de retour
  const returnDateString = returnDate.toISOString().slice(0, 16).replace('T', ' ');
  returnInput.value = returnDateString;
});
</script>
      </div>
      
      <div class="form-container">
        <div class="form-section">
          <p class="form-section-title">Montant total F.CFA</p>
          <div class="input-container">
            <p id="montant-total">0</p>
          </div>
        </div>
      </div>
      <div class="input-container">
      <input type="submit" name="submit" class="text-submit" value="ENREGISTRER">
<button class="text-submit"><a href="FILE.php"><span class="material-icons-outlined">print</span> IMPRIMER <a><button>
  
      </div>
      </div>
</form>
      </div>
  </main>
  <!-- End Main -->

    </div>

    <!-- Scripts -->
    <script>
        const nombreEscalesInput = document.getElementById("nombre-escales");
        const tableEscalesBody = document.getElementById("table-escales").getElementsByTagName("tbody")[0];
        const montantTotalOutput = document.getElementById("montant-total");
        const un=document.getElementById("montant");
        const deux=document.getElementById("qte");
        const trois=document.getElementById("otp");
        const quatre=document.getElementById("montants");
        const cinq=document.getElementById("qtes");
        const six=document.getElementById("otps");
        const sept=document.getElementById("montantss");
        const huit=document.getElementById("qtess");
        const neuf=document.getElementById("otpss");
        const dix=document.getElementById("montanst");
        const onze=document.getElementById("qtse");
        const douze=document.getElementById("otsp");
        const deu=document.getElementById("montasnt");
        const troi=document.getElementById("qste");
        const quat=document.getElementById("ostp");

      const uns=parseInt(un.value);
      const deuxs=parseInt(deux.value);
        const somm=un*deux;
    
        nombreEscalesInput.addEventListener("input", function () {
          const nombreEscales = parseInt(nombreEscalesInput.value, 10);
          let total = 0;
    
          // Réinitialiser le contenu du corps du tableau
          tableEscalesBody.innerHTML = "";
    
          // Générer les lignes du tableau en fonction du nombre d'escales
          for (let i = 1; i <= nombreEscales; i++) {
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
              <td><input type="text" class="text-input" required></td>
              <td><input type="number" class="text-input" required></td>
              <td><input type="number" class="text-input" required></td>
              <td><input type="number" class="text-input" disabled></td>
              <td><input type="text" class="text-input"></td>
            `;
            tableEscalesBody.appendChild(newRow);
          }
        });
    
        tableEscalesBody.addEventListener("input", function () {
          let total = 0;
          const rows = tableEscalesBody.getElementsByTagName("tr");
          trois.value=un.value+deux.value;
          for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const montantInput = row.querySelector("td:nth-child(2) input");
            const quantiteInput = row.querySelector("td:nth-child(3) input");
            const montantTotalInput = row.querySelector("td:nth-child(4) input");
    
            const montant = parseInt(montantInput.value, 10);
            const quantite = parseInt(quantiteInput.value, 10);
            const montantTotal = montant * quantite;
    
            if (!isNaN(montantTotal)) {
              montantTotalInput.value = montantTotal;
              total += montantTotal;
            } else {
              montantTotalInput.value = "";
            }
          }
    
          montantTotalOutput.textContent = total;
        });
      </script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>