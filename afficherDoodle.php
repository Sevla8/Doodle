<?php
include("header.php");

if (isset($_POST['submit']) && (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) == 0) ||
	sizeof(recupererDoodle($_GET['doodleCode'])) == 0) {
	echo 'erreur';
	exit();
}

if (isset($_POST['pseudo']) && isset($_POST['submit'])) {
	$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
	$i = 0;
	$tmp = array();
	while(true) {
		if (!isset($_POST['val-'.$i]) || strlen($_POST['val-'.$i]) == 0)
			break;
		$_POST['val-'.$i] = htmlspecialchars($_POST['val-'.$i]);
		$tmp[$i] = $_POST['val-'.$i];
		$i += 1;
	}
	$val = json_encode($tmp);
	creerReponse($_GET['id'], $_POST['pseudo'], $val);
}

$dood = recupererDoodle($_GET['doodleCode']);
$dood['valeur'] = json_decode($dood['valeur']);
$rep = recupererReponses($_GET['doodleCode']);

$rep['reponse'] = json_decode($rep['reponse']);
?>
<h1>Bienvenue sur le doodle "<?php if (isset($dood['nom_sondage'])) echo $dood['nom_sondage'] ?>" créé par "<?php if(isset($dood['nom_createur'])) echo $dood['nom_createur'] ?>" !</h1>
<div>Description : </div>
<table id="reponses">
	<tr>
		<th> Pseudo </th>
		<?php
		foreach ($dood['valeur'] as $key => $value)
			echo '<th>'.$value.'</th>';
		?>
	</tr>
	<?php
	foreach ($rep as $key => $value) {
		echo '<tr>';
		echo '<td>'.$value['pseudo'].'</td>';
		foreach ($value['reponse'] as $key => $value1)
			echo '<td>'.$value1.'</td>';
		echo '</tr>';
	}
	?>

	<tr class="newAnswer">
	<form method="post">  
	<td><input name="pseudo" type="text"/></td>
	<?php for ($i = 0; $i < sizeof(explode('|', $dood['valeur'])) - 1; $i += 1) { ?>
		<td><select name="val-<?php echo $i ?>"><option value="oui">Oui</option><option value="mais">Oui Mais</option><option value="non">Non</option></select></td>
	<?php } ?>
	<td><input type="submit" name="submit"></td>
	</form>
	</tr>
</table>

<script>
	<?php echo 'x = '.$_GET['doodleCode']; ?>

	function get() {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'Ajax.php', true);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				document.querySelector("#reponses").innerHTML=xhr.responseText;
			}
		});
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('id='+x);
	}
	setInterval(get, 60000);
</script>
<a href="index.php">Retour</a> à la page d'accueil.
<?php
include("footer.php");
?>
