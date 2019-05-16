<?php
global $bdd;
// Remplissez vos identifiants pour vous connecter à votre propre base de donnée.

try {
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}

////////////////////////////////////////////////////////////////////////
/*	  Créer un doodle											   */
////////////////////////////////////////////////////////////////////////

/* Cette fonction crée un code généré aléatoirement
    Vous pouvez l'utiliser sans modification
    pour générer un code pour un doodle.
    Pour simplifier, ne vous embêtez pas à vérifier qu'il est unique */
function randomCode() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}

/* Cette fonction crée un nouveau doodle dans la table des doodles.
    Elle prend en entrée les informations du doodle.
    Elle retourne la manière "cryptée" d'accéder au doodle. */
function creerDoodle($nom_createur, $nom_sondage, $commentaire, $valeur) {
	global $bdd;//	return $doodleCode;
	$id = randomCode();
	$query = $bdd->prepare('INSERT INTO sondage(id, nom_createur, nom_sondage, commentaire, valeur) VALUES (?, ?, ?, ?, ?)');
	$query->execute(array($id, $nom_createur, $nom_sondage, $commentaire, $valeur));
	return $id;
}

////////////////////////////////////////////////////////////////////////
/*	  Créer une réponses pour un doodle							 */
////////////////////////////////////////////////////////////////////////

/* Cette fonction crée une entrée dans la table des réponses
    Elle prend en entrée un pseudo, et un tableau contenant les réponses dans l'ordre
    Elle retourne true si tout a marché, false sinon. */
function creerReponse($id_sondage, $pseudo, $valeur) {
	global $bdd;//	return true;
	$query = $bdd->prepare('INSERT INTO reponse(id_sondage, pseudo, valeur) VALUES (?, ?, ?)');
	$query->execute(array($id_sondage, $pseudo, $valeur));
	return true;
}

////////////////////////////////////////////////////////////////////////
/*	  Récupérer les infos d'un doodle							   */
////////////////////////////////////////////////////////////////////////

/* Cette fonction récupère les informations sur un doodle
    Elle prend en entrée une manière "cryptée" d'identifier le doodle.
    Elle retourne les infos du doodle. */
function recupererDoodle($id) {
	global $bdd;//	return $doodle;
	$query = $bdd->prepare('SELECT * FROM sondage WHERE id = ?');
	$query->execute(array($id));
	$fetch = $query->fetch();
	return $fetch;
}

////////////////////////////////////////////////////////////////////////
/*	  Récupérer les réponses d'un doodle							*/
////////////////////////////////////////////////////////////////////////

/* Cette fonction récupère toutes les réponses à un doodle.
    Elle prend en entrée une manière d'identifier le doodle.
    Elle retourne un tableau contenant les réponses à ce doodle. */
function recupererReponses($id_sondage) {
	global $bdd;//	return $reponses;
	$query = $bdd->prepare('SELECT * FROM reponse WHERE id_sondage = ?');
	$query->execute(array($id_sondage));
	$fetch = $query->fetchAll();
	return $fetch;
}
?>
