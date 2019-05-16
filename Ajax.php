<?php
include("model.php");

$_POST['doodleCode'] = htmlspecialchars($_POST['doodleCode']);

$dood = recupererDoodle($_POST['doodleCode']);
$dood['valeur'] = json_decode($dood['valeur']);
$rep = recupererReponses($_POST['doodleCode']);
for ($i = 0; $i < sizeof($rep); $i += 1) { 
	$rep[$i]['valeur'] = json_decode($rep[$i]['valeur']);
}

echo '<tr>';
echo '<th> Pseudo </th>';
foreach ($dood['valeur'] as $value)
	echo '<th>'.$value.'</th>';
echo '</tr>';
foreach ($rep as $value) {
	echo '<tr>';
	echo '<td>'.$value['pseudo'].'</td>';
	foreach ($value['valeur'] as $value1)
		echo '<td>'.$value1.'</td>';
	echo '</tr>';
}
echo '<tr class="newAnswer">';
echo '<form method="post">';
echo '<td><input name="pseudo" type="text"/></td>';
for ($i = 0; $i < sizeof($dood['valeur']); $i += 1) {
	echo '<td><select name="val-'.$i.'"><option value="oui">Oui</option><option value="oui mais">Oui Mais</option><option value="non">Non</option></select></td>';
}
echo '<td><input type="submit" name="submit"></td>';
echo '</form>';
echo '</tr>';
?>
