<?php
include("header.php");
?>
Choisissez le style graphique du site web :
<form method="post">
	<select name="style">
	<option value="style1">
		Style Clair
	</option>
	<option value="style2">
		Style Sombre
	</option>
	</select>
	<input type="submit"/>
</form>
<a href="index.php">Retour</a> à la page d'accueil.
<?php
include("footer.php");
?>
