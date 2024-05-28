<?php
require_once('../PDF/TCPDF-main/tcpdf.php');
require_once('../PDF/FPDI/src/autoload.php');


$pdf = new \setasign\Fpdi\Tcpdf\Fpdi();
$pdf->setSourceFile('../PDF/po.pdf');

$templateId = $pdf->importPage(1);

// Ajouter une nouvelle page
$pdf->AddPage();

// Utiliser le modèle importé
$pdf->useTemplate($templateId);

// Connexion à la base de données MySQL
$conn = mysqli_connect("localhost", "root", "", "smarterp");

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Récupérer la donnée depuis la base de données
$datere = $_POST['datere'];
$numbo = $_POST['nubo'];
$query="SELECT entreprise.*, commande.*
FROM entreprise
JOIN commande ON entreprise.Numero_Bon = commande.Numero_Bon
WHERE commande.Date_reception = '$datere' AND entreprise.Numero_Bon = $numbo";

$results = mysqli_query($conn, $query);
if ($results && mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $Date_reception = $rows['Date_reception'];
    $Numero_Bon = $rows['Numero_Bon'];
    $NOM = $rows['NOM'];
    $Nombre_vehicule=$rows['Nombre_vehicule'];
    $Marque_vehicule=$rows['Marque_vehicule'];
    $Reference=$rows['Reference'];

}
// Ajouter du contenu HTML
$html = '<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:20px;">
<div style="margin-top:20px;">
<h4 style="text-align: center; font-family:times new roman;">BONS DES COMMANDES</h4>




<p style="margin-bottom: 2px; line-height: 1; font-family:times new roman;">DATE DE RECEPTION : <strong><em><label style="font-size: 13px"; >'.$Date_reception.'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">NUMERO DU BON : <strong><em><label style="font-size: 13px"; >'.$Numero_Bon.';</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">ENTREPRISE(client) : <strong><em><label style="font-size: 13px"; >'.$NOM.'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">NOMBRE DE VEHICULE :<strong><em><label style="font-size: 13px"; >'.$rows['Nombre_vehicule'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">MARQUE DU VEHICULE : <strong><em><label style="font-size: 13px"; >'.$rows['Marque_vehicule'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1x; line-height: 0.6; font-family:times new roman;"> REFERENCE :<strong><em><label style="font-size: 13px"; >'.$rows['Reference'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1x; line-height: 0.6; font-family:times new roman;"> DESIGNATION :<strong><em><label style="font-size: 13px"; >'.$rows['Designation'].'</label></em></strong></p>

';


$pdf->writeHTML($html);

// Afficher le PDF dans le navigateur
$pdf->Output('fichier.pdf', 'I');
?>