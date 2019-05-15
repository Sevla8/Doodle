<?php
include("model.php");

$_POST['doodleCode'] = htmlspecialchars($_POST['doodleCode']);

$dood = recupererDoodle($_POST['doodleCode']);
$dood['valeur'] = json_decode($dood['valeur']);
$rep = recupererReponses($_POST['doodleCode']);
$rep['reponse'] = json_decode($rep['reponse']);

$return = '<tr><th> Pseudo </th>';
foreach ($dood['valeur'] as $key => $value)
	$return .= '<th>'.$value.'</th>';
$return .= '</tr>';

foreach ($rep as $key => $value) {
	$retrun .= '<tr>';
	$return .= '<td>'.$value['pseudo'].'</td>';
	foreach ($value['reponse'] as $key => $value1)
		$return .= '<td>'.$value1.'</td>';
	$return .= '</tr>';
}

echo $return;
?>
