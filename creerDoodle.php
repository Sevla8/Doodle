<?php
include("header.php");

if (isset($_POST['createurName']) &&
	isset($_POST['sondageName']) &&
    isset($_POST['val-0'])) {

	$_POST['createurName'] = htmlspecialchars($_POST['createurName']);
	$_POST['sondageName'] = htmlspecialchars($_POST['sondageName']);
	if (isset($_POST['commentaire']))
		$_POST['commentaire'] = htmlspecialchars($_POST['commentaire']);
	else
		$_POST['commentaire'] = '';

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
// echo $_POST['createurName'].'<br>';
// echo $_POST['sondageName'].'<br>';
// echo $_POST['commentaire'].'<br>'; 
// echo $val;
	$_SESSION['doodleCode'] = creerDoodle($_POST['createurName'], $_POST['sondageName'], $_POST['commentaire'], $val);
}
?>
<div class="newDoodle">
Votre doodle a bien été créé, il peut être rempli à l'adresse : <a href="afficherDoodle.php?doodleCode=<?php if (isset($_SESSION['doodleCode'])) echo $_SESSION['doodleCode']; ?>">afficherDoodle.php?doodleCode=<?php if (isset($_SESSION['doodleCode'])) echo $_SESSION['doodleCode']; ?></a>. Envoyez ce lien à vos amis.
</div>
Créer un nouveau doodle :
<form method="post" action="creerDoodle.php">
	<fieldset>
	<legend>Informations du sondage</legend>
	Nom du créateur : <input type="text" name="createurName"><br>
	Nom du sondage : <input type="text" name="sondageName"><br>
	<textarea placeholder="Commentaires sur le sondage" name="commentaire"></textarea>
	</fieldset>
	<fieldset id="contenu">
	<legend>Contenu du sondage</legend>
	<div class="valeurWrapper">
	</div>
	<a onclick="addValue()" href=#>Ajouter une valeur</a>
	</fieldset>
	<input type="submit">
</form>
<a href="index.php">Retour</a> à la page d'accueil.
<script>
	let valeurWrapper = document.querySelector("#contenu .valeurWrapper");

	function addValue() {
    	let nValeur = valeurWrapper.querySelectorAll(".valeur").length;
    	let newValeur = document.createElement("div");
    	newValeur.innerHTML = "Valeur "+nValeur+" : <input name=\"val-"+nValeur+"\" type=\"text\"/><a onclick=\"removeValeur("+nValeur+")\" href=\"#\">❌</a></div>";
    	newValeur.classList.add("valeur");
    	valeurWrapper.appendChild(newValeur);
	}
	function removeValeur(i) {
    	console.log("test", i);
    	let valeurListe = valeurWrapper.querySelectorAll(".valeur");
    	valeurListe.forEach((elem, index) => {
        	if(index>i){
        	    elem.firstChild.data = "Valeur "+(index-1)+" : ";
        	    elem.querySelector("input").name="val-"+(index-1);
        	    elem.querySelector("a").onclick = () => {removeValeur(index-1);};
        	    console.log(elem);
    	    }
        })
	    valeurWrapper.removeChild(valeurListe[i]);
	}
	addValue();
</script>
<?php
include("footer.php");
?>
