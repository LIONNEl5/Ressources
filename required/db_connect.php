<?php
// Connexion à la base de données MySQL
$serveur="localhost";
$users="root";
$password="";
$db_name="smarterp";
$conn = mysqli_connect($serveur,$users,$password,$db_name);

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
?>