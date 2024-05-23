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
$query="SELECT mission.*, frais.*
FROM mission AS mission
JOIN frais AS frais ON mission.ID_MISSION = frais.ID_MISSION
WHERE mission.ID_MISSION = (
    SELECT MAX(ID_MISSION) 
    FROM mission
)
";
$results = mysqli_query($conn, $query);
if ($results && mysqli_num_rows($results) > 0) {
    $rows = mysqli_fetch_assoc($results);
    $intitule = $rows['DESCRIPTIONS'];
    $MONTANT = $rows['MONTANT'];
    $QTE = $rows['NOMBRE_DE_JOUR'];
    $MONTANTT=$MONTANT*$QTE;
    $MISSION=$rows['ID_MISSION'];
}
$queryt="SELECT personnel.*, technicien.*
FROM personnel AS personnel
JOIN technicien AS technicien ON personnel.MATRICULE = technicien.MATRICULE
WHERE technicien.ID_MISSION = (
    SELECT MAX(ID_MISSION) 
    FROM technicien
)";
$resultes = mysqli_query($conn, $queryt);
if ($resultes && mysqli_num_rows($resultes) > 0) {
    $rowst = mysqli_fetch_assoc($resultes);
    $name = $rowst['NOM'];
    $fonction = $rowst['DEPARTEMENT'];
    $surname = $rowst['PRENOM'];
}

$querytr="SELECT MISSION.*, TRAJET.*
FROM MISSION AS MISSION
JOIN TRAJET AS TRAJET ON MISSION.DESCRIPTION_TRAJET = TRAJET.DESCRIPTION_TRAJET
WHERE MISSION.ID_MISSION = (
    SELECT MAX(ID_MISSION) 
    FROM MISSION
)";
$resultr = mysqli_query($conn, $querytr);
if ($resultr && mysqli_num_rows($resultr) > 0) {
    $rowstr = mysqli_fetch_assoc($resultr);

}


// Ajouter du contenu HTML
$html = '<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:60px;">
<div style="margin-top:20px;">
<p style="text-align: right;">Date '.$rows['DATE_DEPART'].'</p>
<h4 style="text-align: center; font-family:times new roman;">ORDRE DE MISSION POUR:' . $rowstr['LIEU_ARRIVER'] .'</h4>
<br>
<p style="margin-bottom: 2px; line-height: 1; font-family:times new roman;">Nom et prénom : <strong><em><label style="font-size: 13px"; >'.$name.'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">Fonction : <strong><em><label style="font-size: 13px"; >'.$fonction.';</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">Objet de la mission : <strong><em><label style="font-size: 13px"; >'.$rows['OBJET'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">Nombre de véhicule :<strong><em><label style="font-size: 13px"; >'.$rows['NOMBRE_VEHICULE'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">Nombre de jours : <strong><em><label style="font-size: 13px"; >'.$rows['NOMBRE_DE_JOUR'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1x; line-height: 0.6; font-family:times new roman;">Date et heure départ effectif :<strong><em><label style="font-size: 13px"; >'.$rows['DATE_DEPART'].'</label></em></strong></p>
<p style="margin-top: 0; margin-bottom: 1px; line-height: 0.6; font-family:times new roman;">Date et heure retour effectif :<strong><em><label style="font-size: 13px"; >'.$rows['DATE_ARRIVE'].'</label></em></strong></p>

';
$html .= '<p></p>';
$html .= '<table border="1" style="margin-top: 160px; width: 100%;">';
$html .= '<tr>';
$html .= '<th style="width: 32%; height: 25px; text-align: center; font-family: \'Times New Roman\';">INTITULE</th>';
$html .= '<th style="width: 15%; height: 25px; text-align: center; font-family: \'Times New Roman\';">MONTANT</th>';
$html .= '<th style="width: 20%; height: 25px; text-align: center; font-family: \'Times New Roman\';">QUANTITE</th>';
$html .= '<th style="width: 16%; height: 25px; text-align: center; font-family: \'Times New Roman\';">MONTANT T</th>';
$html .= '<th style="width: 15%; height: 25px; text-align: center; font-family: \'Times New Roman\';">OBS</th>';
$html .= '</tr>';

while ($rows = mysqli_fetch_assoc($results)) {
    $html .= '<tr>';
    $html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rows['DESCRIPTIONS']  . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rows['MONTANT'] . '</td>';
    $html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">' . $rows['NOMBRE_DE_JOUR'] . '</td>';
    $html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rows['MONTANT'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">NOTHING</td>';
    $html .= '</tr>';
}
if( $rowstr['NBRE_ESCALE']==1){
    $html .= '<tr>';
    $html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['LIEU_DEPART']  .'-' . $rowstr['LIEU_ARRIVER'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['COUT'] .'</td>';
    $html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">2</td>';
    $html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rowstr['COUT'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">DIRECT</td>';
    $html .= '</tr>';
    }
if( $rowstr['NBRE_ESCALE']==2){
$html .= '<tr>';
$html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['LIEU_DEPART']  .'-' . $rowstr['ESCALE_1'] . '</td>';
$html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['PRIX_ES_2'] .'</td>';
$html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">2</td>';
$html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rowstr['PRIX_ES_2'] . '</td>';
$html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">ESCALE</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['ESCALE_1']  .'-' . $rowstr['LIEU_ARRIVER'] . '</td>';
$html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['PRIX_ES_1'] .'</td>';
$html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">2</td>';
$html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rowstr['PRIX_ES_1'] . '</td>';
$html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">ESCALE</td>';
$html .= '</tr>';
}
if( $rowstr['NBRE_ESCALE']==3){
    $html .= '<tr>';
    $html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['LIEU_DEPART']  .'-' . $rowstr['ESCALE_1'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['PRIX_ES_1'] .'</td>';
    $html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">2</td>';
    $html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rowstr['PRIX_ES_1'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">ESCALE</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['ESCALE_1']  .'-' . $rowstr['ESCALE_2'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['PRIX_ES_2'] .'</td>';
    $html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">2</td>';
    $html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rowstr['PRIX_ES_2'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">ESCALE</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width: 32%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['ESCALE_2']  .'-' . $rowstr['ESCALE_3'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">' . $rowstr['PRIX_ES_3'] .'</td>';
    $html .= '<td style="width: 20%; text-align: center; font-family: \'Times New Roman\';">2</td>';
    $html .= '<td style="width: 16%; text-align: center; font-family: \'Times New Roman\';">' . 2*$rowstr['PRIX_ES_3'] . '</td>';
    $html .= '<td style="width: 15%; text-align: center; font-family: \'Times New Roman\';">ESCALE</td>';
    $html .= '</tr>';
    }
$html .= '<tr>';
$html .= '<td colspan="2" style=" height: 25px; text-align: center; Valign:middle; font-family: \'Times New Roman\';">Montant Total</td>
<td></td>
<td></td>
';
$html .= '<td></td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '<p></p>';
$html .= '<p></p>';
$html .= '<table border="1" style="margin-top:60px; width: 100%;">';
$html .= '<tr>';
$html .= '<th style="width: 22%; height: 25px; text-align: center; font-family: \'Times New Roman\';">Resp. Logistique</th>';
$html .= '<th style="width: 25%; height: 25px; text-align: center; font-family: \'Times New Roman\';">Tecnicien/ingenieur</th>';
$html .= '<th style="width: 30%; height: 25px; text-align: center; font-family: \'Times New Roman\';">Controleur de gestion</th>';
$html .= '</tr>';
$html .= '<tr>
<td style="width: 22%; height: 35px; ></td>
<td style="width: 25%; height: 35px;></td>
<td></td>
 </tr>';




$html .= '</table>';
$pdf->writeHTML($html);

// Afficher le PDF dans le navigateur
$pdf->Output('fichier.pdf', 'I');
?>