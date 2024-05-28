<?php
require '../required/db_connect.php';

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
            <a href="registre.php">
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
    <p class="font-weight-bold"><strong>REPERTOIRE</strong></p>
  </div>


  <div class="form-container">
  <h2 class="form-section-title">FICHIER DES BONS DE COMMANDE</h2>

</div>  
<div class="form-section">
<h5 class="form-section-title">DETAILS DU FICHIER</h5>
<div class="input-container">
    <form method="POST" action="fichier_bons_de_commande.php">
<input type="date"  class="text-input" name="datere">
<input type="text"placeholder="NUMERO DU BON" class="text-input" name="nubo">
<input type="submit" value="Imprimer" class="text-input" name="nom_technicien">
</form>
</div> 
</div> 

<div class="form-container">
<h2 class="form-section-title">FICHIER DES OPERATIONS</h2>
</div>  

<div class="form-section">
<h5 class="form-section-title">DETAILS DU FICHIER</h5>
<div class="input-container">
    <form method="POST" action="#">
<input type="date"  class="text-input" name="nom_technicien">
<input type="text"placeholder="NOM DU CLIENT" class="text-input" name="nom_technicien">
<select id="selection" name="selection" class="text-input" style="height: 40px;
    font-size: 16px; width:200px; margin-right:12px;">
    <option value="">Operation</option>
    <option value="option1">Installation</option>
    <option value="option2">Désinstallation</option>
    <option value="option3">Maintenance</option>
</select>
<input type="submit" value="Imprimer" class="text-input" name="nom_technicien">
</form>
</div> 
</div> 


<div class="form-container">
<h2 class="form-section-title">FICHIER DES BILANS</h2>
</div>   

<div class="form-section">
<h5 class="form-section-title">DETAILS DU FICHIER</h5>
<div class="input-container">
<form method="POST" action="#">
<input type="submit" value="Imprimer" class="text-input" name="nom_technicien" style="height: 40px;
    font-size: 16px; width:200px; margin-right:12px;">
</form>
</div> 
</div> 


<div class="form-container">
<h2 class="form-section-title">FICHIER DES MISSIONS</h2>
</div> 

<div class="form-section">
<h5 class="form-section-title">DETAILS DU FICHIER</h5>
<div class="input-container">
    <form method="POST" action="fichier_odm.php">
<input type="date"  class="text-input" name="datefm">
<input type="text" placeholder="NOM DU MISSIONNAIRE" class="text-input" name="missn">
<input type="submit" value="Imprimer" class="text-input" name="nom_technicien">
</form>
</div> 
</div> 


</div>   
</main>
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