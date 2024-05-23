<?php
require '../required/db_connect.php';

$query="SELECT * FROM base_sonde";

$result = mysqli_query($conn, $query);
if (
  isset($_POST['MO']) &&
  isset($_POST['FA']) &&
  isset($_POST['NS']) &&
  isset($_POST['DR']) &&
  isset($_POST['ST']) 

) {
  $MO=$_POST['MO']; 
  $FA=$_POST['FA']; 
  $NS=$_POST['NS']; 
  $DR=$_POST['DR']; 
  $ST=$_POST['ST']; 
$queryt="INSERT INTO base_sonde
VALUES
  ('$MO','$FA','$NS','$DR','$ST')";
   if (mysqli_query($conn, $queryt)) {
    echo "Enregistrement inséré avec succès";
}else{
  echo "No Enregistrement inséré avec succès";
}
}
if(isset($_POST['search'])){
  $search = $_POST['search'];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>BASE SONDE</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../Boostrap/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="../Css/base_sim.css">
		
		
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
		<!--google fonts -->
	
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
	<!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  

<div class="wrapper">


        <div class="body-overlay"></div>
		
		<!-------------------------sidebar------------>
		     <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
              <h3><span class="material-icons-outlined">build</span> OPTech</h3>
            </div>
            <ul class="list-unstyled components">
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

           
        </nav>
		
		
		
		
		<!--------page-content---------------->
		
		<div id="content">
		   
		   <!--top--navbar----design--------->
		   
		   <div class="top-navbar">
		      <div class="xp-topbar">

                <!-- Start XP Row -->
                <div class="row"> 
                    <!-- Start XP Col -->
                    <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                        <div class="xp-menubar">
                               <span class="material-icons text-white">signal_cellular_alt
							   </span>
                         </div>
                    </div> 
                    <!-- End XP Col -->

                    <!-- Start XP Col -->
                    <div class="col-md-5 col-lg-3 order-3 order-md-2">
                        <div class="xp-searchbar">
                        <form method="POST" action="#">
                                <div class="input-group">
                                  <input type="search" name="search" class="form-control" 
								  placeholder="Search">
                                  <div class="input-group-append">
                                    <button class="btn" type="submit" 
									id="button-addon2">SEARCH</button>
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End XP Col -->

                    <!-- Start XP Col -->
                    <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                        <div class="xp-profilebar text-right">
							 <nav class="navbar p-0">
                        <ul class="nav navbar-nav flex-row ml-auto">   
                           
                               </a>
                               
                            </li>   
            </nav>
							
                        </div>
                    </div>
                    <!-- End XP Col -->

                </div> 
                <!-- End XP Row -->

            </div>
		     <div class="xp-breadcrumbbar text-center">
                <h4 class="page-title">BASE SONDE</h4>               
            </div>
			
		   </div>
		   
		   
		   
		   <!--------main-content------------->
		   
		   <div class="main-content">
        <div class="form-container">
			  <div class="row">
			    
				<div class="col-md-12">
				<div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
          <h2 class="ml-lg-2">SONDE </h2>
        </div>
        <div class="col-sm-6 p-0 d-flex justify-content-lg-end justify-content-center">
          <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
		  <i class="material-icons">&#xE147;</i> <span>Add SONDE</span></a>
          <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
		  <i class="material-icons">&#xE15C;</i> <span>Remove</span></a>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>
            <span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
          </th>
          <th>Fabricant</th>
          <th>Modele</th>
          <th>N° Serie</th>
          <th>Date reception</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <tbody>
              <?php
// Assurez-vous d'avoir exécuté votre requête SQL et stocké le résultat dans la variable $result
if(empty($search)){
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $FA=$row['Fabricant']; 
      $MOD=$row['MODELE']; 
      $NUMS=$row['NUM_SERIE']; 
      $Date_Reception=$row['Date_Reception']; 
      $Statut=$row['Statut']; 
        echo '<tr>';
        echo '<td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                </span>
            </td>';
        echo '<td>' . $FA . '</td>';
        echo '<td>' . $MOD . '</td>';
        echo '<td>' . $NUMS . '</td>';
        echo '<td>' . $Date_Reception . '</td>';
        echo '<td>' . $Statut . '</td>';
        echo '<td>
                <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                </a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                </a>
            </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">Aucune donnée trouvée</td></tr>';
}
}else{
$requete = "SELECT * FROM base_sonde WHERE MODELE LIKE '%$search%' OR Fabricant LIKE '%$search%' OR NUM_SERIE LIKE '%$search%' OR Date_Reception LIKE '%$search%' OR Statut LIKE '%$search%'";
$resultat = mysqli_query($conn, $requete);
  if ($resultat && mysqli_num_rows($resultat) > 0) {
    while ($rows = mysqli_fetch_assoc($resultat)) {
        $FA=$rows['Fabricant']; 
        $MOD=$rows['MODELE']; 
        $NUMS=$rows['NUM_SERIE']; 
        $Date_Reception=$rows['Date_Reception']; 
        $Statut=$rows['Statut']; 
        echo '<tr>';
        echo '<td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                </span>
            </td>';
            echo '<td>' . $FA . '</td>';
            echo '<td>' . $MOD . '</td>';
            echo '<td>' . $NUMS . '</td>';
            echo '<td>' . $Date_Reception . '</td>';
            echo '<td>' . $Statut . '</td>';
        echo '<td>
                <a href="#editEmployeeModal" class="edit" data-toggle="modal">
                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                </a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                </a>
            </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">Aucune donnée trouvées</td></tr>';
}


}
?>
            </tbody>
    </table>
    <div class="clearfix">
      <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
      <ul class="pagination">
        <li class="page-item disabled"><a href="#">Previous</a></li>
        <li class="page-item"><a href="#" class="page-link">1</a></li>
        <li class="page-item"><a href="#" class="page-link">2</a></li>
        <li class="page-item active"><a href="#" class="page-link">3</a></li>
        <li class="page-item"><a href="#" class="page-link">4</a></li>
        <li class="page-item"><a href="#" class="page-link">5</a></li>
        <li class="page-item"><a href="#" class="page-link">Next</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" action="#">
        <div class="modal-header">
          <h4 class="modal-title">Add Camera</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
        <div class="form-group">
            <label>FABRICANT</label>
            <input type="text" class="form-control" name="FA" required>
          </div>
          <div class="form-group">
            <label>MODELE</label>
            <input type="text" class="form-control" name="MO" required>
          </div>
          <div class="form-group">
            <label>NUMERO_SERIE</label>
            <input type="text" class="form-control" name="NS" required>
          </div>
          <div class="form-group">
            <label>Date_reception</label>
            <input type="date" class="form-control" name="DR" required>
          </div>
          <div class="form-group">
            <label>STATUS</label>
            <input type="text" class="form-control" name="ST" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-success" value="Add">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h4 class="modal-title">Edit Employee</h4>
          <button type="button" class="close" data-dismiss="modal" 
		  aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nzsame</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Emaijl</label>
            <input type="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-info" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h4 class="modal-title">Delete Employee</h4>
          <button type="button" class="close" data-dismiss="modal" 
		  aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete these Records?</p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-danger" value="Delete">
        </div>
      </form>
    </div>
	</div>
  </div>
				
		   
			  </div>
			 
			 
			 <!---footer---->
			 
			 
		</div>
		
		<footer class="footer">
			    <div class="container-fluid">
				  <div class="footer-in">
                    <p class="mb-0">&copy 2024 SMARTRACK AFRICA - All Rights Reserved.</p>
                </div>
				</div>
			 </footer>
</div>
</div>


<!----------html code compleate----------->








  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="../Js/jquery-3.3.1.slim.min.js"></script>
   <script src="../Js/popper.min.js"></script>
   <script src="../Js/bootstrap.min.js"></script>
   <script src="../Js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
        
		$(document).ready(function(){
		  $(".xp-menubar").on('click',function(){
		    $('#sidebar').toggleClass('active');
			$('#content').toggleClass('active');
		  });
		  
		   $(".xp-menubar,.body-overlay").on('click',function(){
		     $('#sidebar,.body-overlay').toggleClass('show-nav');
		   });
		  
		});
		
</script>
  
  



  </body>
  
  </html>


